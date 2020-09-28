import {Cart, CartItem} from './models/cart.model';
import {Product} from "./models/product.model";
import {animateAddToCart} from "./functions/animateCart";
import {Selector} from "./models/app.model";
import {BehaviorSubject, Observable} from "rxjs";

declare let PRODUCT_VARIATIONS: any[];
declare let cartJsConfig: Selector;
declare var $: any;

export class VariationEvents {
    variationList: any = {};
    productId: number;
    private variations: BehaviorSubject<any[]> = new BehaviorSubject([]);
    totalVariations: number;

    constructor() {
        this.listenVariationClick();
    }

    detachEvents() {
        $("body").off("click");
    }

    get SelectedVariation(): Observable<any[]> {
        return this.variations.asObservable();
    }

    listenVariationClick() {
        const $product = $('.product-variations');
        this.totalVariations = $product.data('variations');
        this.productId = $product.data('product');
        $('.options-item > div').on('click', (e: any) => {
            const target = $(e.target);
            const parent = $(target.parent());
            const attributeName = $(parent.parent()).data('attribute');

            const attributeValue = target.data('value');
            const parentClass = parent.attr('class').split(' ')[1];
            if(target.hasClass('active')){
                //target.removeClass('active');
               // this.variationList = null;
                return;
            }
            $('.options-item.' + parentClass + ' > div').removeClass('active');
            target.addClass('active');
            this.variationList[attributeName] = attributeValue;
            let array = Object.keys(this.variationList).map(item => this.variationList[item]);
            if (array.length == this.totalVariations) {
                $('#kodCms-loading').show();
                $.ajax({
                    type: "POST",
                    url: "/en/commerce/product/variation?id=" + this.productId,
                    data: this.variationList,
                    success: (res: any) => {
                        $('#kodCms-loading').hide();
                        this.variations.next(res)
                    },
                    dataType: 'json'
                });

            }
        });
    }
}
