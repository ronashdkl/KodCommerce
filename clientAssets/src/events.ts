import { Cart, CartItem } from './models/cart.model';
import { Product } from "./models/product.model";
import { animateAddToCart } from "./functions/animateCart";
import { Selector } from "./models/app.model";
import { Observable } from "rxjs";
import {VariationEvents} from "./variationEvent";

declare let cartJsConfig: Selector;
declare var $: any;
export class CartEvents {
  product:any
  constructor(
    private cart: Cart = new Cart(),
    private selector: Selector = cartJsConfig,
    private variationEvent = new VariationEvents()
  ) {
    this.initializeAddToCartButton();
    variationEvent.SelectedVariation.subscribe((data:any)=>{
      if(data.length<1) return ;
      if(data.stock>0){
        $('.'+this.selector.priceSelector).html(data.formattedPrice);
        this.product = data;
      }
    });
  }
  get cartItem():Observable<CartItem> {
    return this.cart.observable;
  }
  detachEvents(){
    $("body").off("click");
  }
  listenAddToCartButton(event: any) {
    let name, price, sku, id;
    const target = $(event.target);
    const parent = target.parents(".item");
    if(this.product===null){
        name = parent.find(".item-title").text();
       price = target.data('price');
       id=target.data('id');
       sku = target.data('sku');
    }else{
       name = this.product.title
       price = this.product.price;
       id = this.product.id;
       sku = this.product.sku;
    }

    const img = parent
      .find("img")
      .eq(0)
      .attr("src");

    const item = new Product();
    item.id = id;
    item.sku = sku??id;
    item.name = name;
    item.price =price;
    item.quantity = 1;
    item.image = img;
    this.cart.addItem(item);
    animateAddToCart(target, this.selector.totalCartItemSelector);
  }

  listenQuantityButton(event: any) {
    const index = $(event.target).data("index");
    const type = $(event.target).data("type");
    type === "inc"
      ? this.cart.increaseQuantity(index, true)
      : this.cart.decreaseQuantity(index);
  }

  listenRemoveButton(event: any) {
    const index = $(event.target).data("index");
    this.cart.removeItem(index);
  }

  triggerAddToCartButton(){
    $("." + this.selector.addToCartButtonSelector).click((event:any) =>
    this.listenAddToCartButton(event)
  );
  }
   triggerDynamicButton() {
    const incDecButton = $(".inc-dec-button");
    incDecButton.on("click", (event:any) =>
      this.listenQuantityButton(event)
    );
    $(".cart-remove-item-button").on("click", (event:any) =>
      this.listenRemoveButton(event)
    );
  }
  initializeAddToCartButton(){
    const button  = $("." + this.selector.addToCartButtonSelector);
    button.removeAttr('disabled');
    button.click((event:any) =>
        this.listenAddToCartButton(event)
    );
  }
}
