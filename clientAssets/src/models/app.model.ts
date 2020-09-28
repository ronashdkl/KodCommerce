import {Render} from "../render";
import {VariationEvents} from "../variationEvent";

export interface Selector {
    listSelector?: string;
    summarySelector?: string;
    addToCartButtonSelector: string;
    totalCartItemSelector: string;
    sampleProductSelector?: string;
    priceSelector?:string
}

export class App {
    constructor(
       // private variationEvent = new VariationEvents()
    ) {
        const renderer = new Render();
        const observable = renderer.cartEvents.cartItem.subscribe((x) =>
            renderer.render(x)
        );
        window.onbeforeunload = () => observable.unsubscribe();
    }
}
