/**
 * (c) Ronash Dhakal
 * @type {{init: init}}
 */
export default  (function (kodObject) {
        var config = {
            key: "cart",
            priceFormatter:{
                locale:'en',
               currency:"NPR",
               thousandSeparator:",",
                decimalSeparator:'.'

            },
            apiRoute: {
                controller: "/commerce/cart-api",
                indexAction: "",
                addAction: "add",
                removeAction: "delete",
                clearAction: "clear",
            }, //must  add / at the end of url

            errorMessage: {
                contentError: "Oops, we haven't got JSON!",

            }
        }


        var UIController = (function () {
            var DOMSelector = {
                inputs: {
                    quantity: '.commerce--quantity-input',
                },
                cartButtonsContainer: '.commerce--buttons',
                container: {
                    priceFormatter:'.format-price',
                    cart: {
                        item: {
                            list: '.cart-list',
                            total: '.cart--item-total'
                        },
                        total: '.cart--total',
                        totalItems: '.cart-total-items',
                        emptyText: '.cart--empty-text',
                        summaryAction: '.cart--summary .actions',
                    },
                },
                buttons: {
                    quantityIncDec: '.commerce--quantity-inc-dec > i',
                    addToCart: '.commerce--add-to-cart-btn',
                    cartRemoveBtn: '.cart--remove-btn',
                    cartSaveBtn: '.cart--save-btn',
                    cartClearBtn: '.cart--clear-btn',
                    cartCheckOutBtn: '.cart--checkout-btn'
                },
            }

            /**
             * UPdate Quantity
             * @param value
             * @param id
             */
            var updateQuantity = function (value, id) {


                $(id).val(value);
            }
            /**
             * Get quantity
             * @param id
             * @return {number}
             */
            var getQuantity = function (id) {
                var value = $(id).val();

                value = parseInt(value)
                if (value < 2) {
                    updateQuantity(1, id);
                    return 1;
                }
                return value;

            }

            var disableButton = function (selector, value) {
                $(selector).attr('disabled', value);
            }

            var displayTotals = function (value) {
                $(DOMSelector.container.cart.totalItems).html(value);
            }

            var formatPrice = function(price){

                 var cfg = config.priceFormatter;

                return new Intl.NumberFormat(cfg.locale,{
                    style:'currency',
                    currency:cfg.currency
                }).format(price);
            }

            var hideEmptyCartText = function (active = true) {
                var ele = $(DOMSelector.container.cart.emptyText)
                if (!active) {
                    ele.fadeOut('Slow')
                } else {
                    ele.fadeIn('Slow')
                }


            }
            var hideCartActions = function (active) {
                var ele = $(DOMSelector.container.cart.summaryAction);
                console.log(ele)
                if (active) {
                    ele.hide()
                } else {
                    ele.show();
                }
            }

            var init = function (userSelector) {
                Object.assign(DOMSelector, userSelector);
            }


            /**
             * Get Sku and quantiy from cart item, listen from save button
             * @param event
             * @return {{quantity: number, sku: *}}
             */
            var getCartItemData = function (event) {
                var target, sku, quantity;

                if (event.target.tagName.toLowerCase() === 'button') {
                    target = $(event.target);
                } else {
                    target = $(event.target).parent();
                }
                var parent = target.parent().parent();
                sku = parent.data('sku');
                var quantityEle = parent.find('input');
                quantity = getQuantity(quantityEle)
                var totalEle = parent.find(DOMSelector.container.cart.item.total)

                return {sku, quantity, parent, totalEle};

            }
            var renderCartItem = function (item) {

                var variation = Object.entries(item.variation.name);
                var variationText = ""
                for (let i = 0; i <variation.length ; i++) {
                    variationText +=variation[i][0]+" : "+variation[i][1]+", "

                }
                var html = `<div class="cart-item" data-sku="${item.sku}">
                             <div class="cart--id"><i class="fa fa-shopping-basket"></i></div>
                            <img class="cart--item-image" src="${item.image}" alt="">
                            <div class="cart--item-label">
                                <strong>${item.label}</strong>
                          
                                <p class="cart--item-variation">${variationText} </p>
                                       <p class="cart--item-unit-price format-price"> ${formatPrice(item.price)}</p>

                            </div>
                            <div class="cart--item-quantity commerce-quantity">
                                <div class="commerce--quantity">
                                    <div class="commerce--quantity-inc-dec "><i class="fa fa-plus-circle inc"></i></div>
                                    <input class="commerce--quantity-input" type="number" min="1"
                                           value="${item.quantity}">
                                    <div class="commerce--quantity-inc-dec dec"><i class="fa fa-minus-circle dec"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="cart--item-price"><span class="cart--item-total format-price">${formatPrice(item.calculatePrice())} </span>
                           
                               </div>
                            <div class="actions">
                                <button title="save" 
                                        class="btn btn-info cart--save-btn"><i class="fa fa-save"></i></button>
                                <button title="Remove From cart" data-toggle="tooltip"
                                        class="btn btn-danger cart--remove-btn"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>`;

                $(DOMSelector.container.cart.item.list).append(html);

            }


            return {
                getSelector: DOMSelector,
                hideEmptyCartText,
                hideCartActions,
                updateQuantity,
                getQuantity,
                disableButton,
                displayTotals,
                /**
                 * Update button text
                 * @param selector
                 * @param text
                 */
                updateButtonText: function (selector, text) {
                    $(selector).html(text)
                },
                setCartTotal: function (total) {
                     $(DOMSelector.container.cart.total).html(formatPrice(total))

                },
                getCartTotal: function () {
                    return parseInt($(DOMSelector.container.cart.total).html())
                },
                removeCartItemUI: function (selector) {
                    $(selector).remove();
                },
                clearCartItem: function () {
                    $('.cart-list').remove();
                },
                getCartItemData,
                updateCartItemTotal: function (selector, total) {
                    $(selector).html(formatPrice(total))
                },
                renderCartItem
            }
        })();

        var cartController = (function () {

            var loaded = false;
            /**
             * Store cart items
             * @type {*[]}
             */
            var cart = {}

            /**
             * Cart Item Model
             * @param sku
             * @param quantity
             * @constructor
             */
            var Item = function (sku, quantity = 1) {

                this.sku = sku;
                this.quantity = quantity;
                this.price = null;
                this.label = null;
                this.variation = {
                    name: {},
                    price: 0
                }
                this.image = null;
                this.product_id = null;
            }

            Item.prototype.calculatePrice = function () {
                return this.price * this.quantity;
            }
            Item.prototype.productPrice = function () {
                return this.price - this.variation.price;
            }
            Item.prototype.build = function (obj) {
                Object.assign(this, obj);
                return this;
            }

            /**
             *
             * @param sku
             */
            var increaseQuantity = function (sku) {
                cart[sku].quantity++

            }

            /**
             * Decrease Quantity
             * @param sku
             */
            var decreaseQuantity = function (sku) {
                cart[sku].quantity--
            }
            /**
             * Local and server save;
             */
            var save = function () {
                localStorage.setItem(config.key, JSON.stringify(cart))
            }

            /**
             * Load carts from localstorage or from server
             */
            var load = function () {
                //fetch cart from server and save it. if cart does not exists on server check on localstorage and assign it.

                if (!loaded) {
                    var data = JSON.parse(localStorage.getItem(config.key));
                    if (data != null) {
                        mapCartItems(data)
                        loaded = !loaded;
                    } else {
                        fetchCartFromServer()
                    }

                }
            }

            /**
             *
             * @returns {{amount: number, items: number}}
             */
            var getTotal = function () {
                // load();
                var total = 0;
                var count = 0;
                getItems().forEach(function (item) {
                    total += item.calculatePrice()
                    count += item.quantity
                })
                return {
                    items: count,
                    amount: total
                }
            };

            /**
             * @return []
             */
            var getItems = function () {
                if (typeof cart == null || typeof cart == "undefined") {
                    cart = {};
                }
                return Object.values(cart);
            }

            /**
             * Add to server
             * @param item
             * @return {Promise<T>}
             */
            function addItem(item) {
                return kodObject.client(config.apiRoute.addAction, {sku: item.sku, quantity: item.quantity})
                    .then(data => {
                        cart[item.sku] = item.build(data)
                        save();
                        return cart[item.sku];
                    }).catch(function(e){
                       kodObject.Notification.notify.error(e.message)
                })
            }


            /**
             * Remove item from server
             * @param sku
             * @return {Promise<T>}
             */
            function removeItem(sku) {
                return kodObject.client(config.apiRoute.removeAction, {sku})
                    .then(x => {
                        delete cart[sku];
                        save();
                        return x;
                    })
                    .catch(e => {
                        //display in toast
                        console.error(e)
                        kodObject.Notification.notify.error(e.message);
                        kodObject.Notification.notify.warning("Problem processing the cart. Clearing all items");
                        setTimeout(function(){
                            clear()
                        },1000)

                    })
            }

            function initializeCart() {
                if (typeof cart == null || typeof cart == "undefined") {
                    cart = {}
                }
            }

            /**
             * Initialize Controller
             */
            var init = function () {

                load();
            }


            function mapCartItems(data) {

                var items = Object.values(data)

                initializeCart();

                for (let i = 0; i < items.length; i++) {

                    cart[items[i].sku] = new Item(items[i].sku).build(items[i]);

                }
            }

            /**
             *
             */
            function fetchCartFromServer() {

                kodObject.client(config.apiRoute.indexAction)
                    .then(data => {
                        if (data) {
                            mapCartItems(data);
                            save();
                        } else {
                            clear(false);
                        }

                    })
                    .catch(e => {
                        console.log(e)
                    }).finally()


            }

            var clear = function (fromServer = true, onClear = null) {
                if (!fromServer) {
                    cart = null
                    save();
                    return;
                }
                kodObject.client(config.apiRoute.clearAction)
                    .then(x => {
                        cart = null;
                        save();
                        if (onClear) {
                            onClear(x);
                        }

                    })
                    .catch(e => {
                        console.error(e)
                    })
            }
            var isEmptyCart = function () {
                return getItems().length < 1

            }

            /**
             *
             */
            return {
                Item,
                init,
                getTotal,
                getItems,
                isEmptyCart,
                /**
                 *
                 * @param sku
                 * @return {*}
                 */
                getCartItem: function (sku) {
                    return cart[sku];
                },
                /**
                 *
                 * @returns {Promise<T>}
                 */
                fetchCart: fetchCartFromServer,
                /**
                 *
                 * @param sku
                 * @param quantity
                 * @return {Promise<T>}
                 */
                add: function (sku, quantity) {
                    // load();
                    var item = new Item(sku, quantity)
                    //send to server
                    return addItem(item);


                },
                /**
                 *
                 * @param sku
                 */
                remove: function (sku) {
                    // load();
                    return removeItem(sku);


                },
                /**
                 * cart
                 */
                clear,
                increaseQuantity,
                decreaseQuantity

            }

        })();


        /**
         * Main Controller
         * @type {{init: init}}
         */
        var AppController = (function (UICtrl, cartCtrl) {
            var DOMSelector = UICtrl.getSelector;
            var noty = kodObject.Notification;

            /**
             * common methods
             * @type {{addToCart: addToCart}}
             */
            var methods = {
                clearUI: function () {
                    hideCartElement(true)
                    UICtrl.clearCartItem()
                    UICtrl.displayTotals(0);
                    UICtrl.setCartTotal(0);
                },
                addToCart: function (sku, quantity, disableButton, onSuccess = null) {
                    cartCtrl.add(sku, quantity).then(function (e) {
                        disableButton(false);
                        var totals = cartCtrl.getTotal();
                        UICtrl.setCartTotal(totals.amount);
                        UICtrl.displayTotals(totals.items);
                        if (onSuccess) {
                            onSuccess(e);
                        }
                    }).catch(function(e){
                        noty.notify.error(e.message)
                    })
                }
            }


            var actions = {
                /**
                 * Inc Dec quantity
                 * @param event
                 */
                updateQuantity: function (event) {

                    var target = $(event.target);
                    var inputEle = target.parent().parent().find('input');
                    var value = UICtrl.getQuantity(inputEle);

                    if (target.hasClass('inc')) {
                        value += 1;
                    } else {
                        if (value < 2) {
                            value = 1
                        } else {
                            value -= 1;
                        }

                    }

                    UICtrl.updateQuantity(value, inputEle);
                },
                addToCart: function (event) {

                    var target = $(event.target);
                    var sku = target.data('sku');
                    var product_type = parseInt(target.data('product_type'));
                    var quantity = UICtrl.getQuantity(DOMSelector.inputs.quantity)

                    if (product_type && target.data('sku') === '') {
                       noty.notify.warning('Please select Product Variation')
                    }

                    function disableButton(toggle) {
                        UICtrl.disableButton(DOMSelector.buttons.addToCart, toggle)
                    }

                    disableButton(true);
                    UICtrl.updateButtonText(DOMSelector.buttons.addToCart, "Update")
                    //add to cart
                    methods.addToCart(sku, quantity, disableButton, function (item) {
                        noty.notify.success(item.label + " Added to the card")
                    });


                },


                updateToCart: function (event) {

                    var {sku, quantity, totalEle} = UICtrl.getCartItemData(event);

                    function disableButton(toggle) {
                        UICtrl.disableButton(DOMSelector.buttons.cartSaveBtn, toggle)
                    }

                    disableButton(true);
                    //add to cart
                    methods.addToCart(sku, quantity, disableButton, function (item) {
                        noty.notify.success(item.label + " updated")
                        UICtrl.updateCartItemTotal(totalEle, cartCtrl.getCartItem(sku).calculatePrice())
                    });
                },

                removeFromCart: function (event) {
                    var {sku, parent} = UICtrl.getCartItemData(event);

                    noty.confirm('Are you sure',
                        function () {
                            cartCtrl.remove(sku).then(function (data) {
                                noty.notify.success("Item Removed")
                                UICtrl.removeCartItemUI(parent);
                                var {amount, items} = cartCtrl.getTotal();
                                if (items === 0) {
                                    methods.clearUI();
                                    return;
                                }
                                UICtrl.setCartTotal(amount);
                                UICtrl.displayTotals(items)
                                var isEmpty = cartCtrl.isEmptyCart();
                                hideCartElement(isEmpty);
                            })
                        },
                        function () {
                            noty.notify.warning("Action Aborted")
                        }
                    )

                },

                clearCart: function (event) {
                    noty.confirm('Are you sure?', function () {
                        cartCtrl.clear(true, function () {
                            noty.notify.success("Cart items has been cleared!");
                            methods.clearUI();
                        })
                    })

                }
            }


            function hideCartElement(isEmpty) {
                UICtrl.hideEmptyCartText(isEmpty);
                UICtrl.hideCartActions(isEmpty)
            }

            /**
             * Events
             */
            var setupEvents = function () {
                //incDec Quantity
                $(DOMSelector.buttons.quantityIncDec).on('click', actions.updateQuantity)
                $(DOMSelector.buttons.addToCart).on('click', actions.addToCart)
                $(DOMSelector.buttons.cartSaveBtn).on('click', actions.updateToCart)
                $(DOMSelector.buttons.cartRemoveBtn).on('click', actions.removeFromCart)
                $(DOMSelector.buttons.cartClearBtn).on('click', actions.clearCart)
            }


            var loadCartToUI = function () {
                function getActionType() {
                    var str = location.href;
                    var n = str.lastIndexOf('/');
                    return str.substring(n + 1);
                }

                var {amount, items} = cartCtrl.getTotal();

                UICtrl.displayTotals(items)
                var cartItems = cartCtrl.getItems();

                function renderCartItems() {
                    if (getActionType() === config.key) {

                        if (cartItems.length < 1) {
                            methods.clearUI();
                            return;
                        }

                        UICtrl.setCartTotal(amount);
                        var item;
                        for (let i = 0; i < cartItems.length; i++) {
                            item = new cartCtrl.Item('new').build(cartItems[i]);

                            UICtrl.renderCartItem(item);
                        }

                    }
                }

                renderCartItems();

            }

            var init = function () {
                cartCtrl.init();
                loadCartToUI();
                setupEvents();

            }
            return {
                init
            }
        })(UIController, cartController);


        /**
         * Initialize
         */
        return {
            init : function(userConfig = null){
                if(userConfig){
                    Object.assign(config,userConfig);
                }
                kodObject.init(config.apiRoute);
                AppController.init();
            }
        }

    }
);

