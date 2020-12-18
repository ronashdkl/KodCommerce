export default (function (kodObject) {
        var config = {
            apiRoute: {
                controller: "/commerce/product-api",
                indexAction: "index",
            }, //must  add / at the end of url

            errorMessage: {
                contentError: "Oops, we haven't got JSON!",

            },
        }
        var noty = kodObject.Notification;

        var VariationController = (function (serverCtrl) {
            var selectedVariation = {}

            var getSKU = function(productId){

               return serverCtrl.client(config.apiRoute.indexAction+'?id='+productId,selectedVariation).catch(function(e){
                    console.error(e);
                    noty.notify.error(e);
               });

            }
            return {
                setVariation: function (name, value) {
                    selectedVariation[name] = value;
                    return selectedVariation;
                },
                totalSelected: function () {
                    return Object.entries(selectedVariation).length
                },
                getVariation: function (name = null) {
                    if (name) {
                        return selectedVariation[name];
                    } else {
                        return selectedVariation;
                    }
                },
                getSKU,
            }

        })(kodObject);

        var UIController = (function () {

            var DOMSelector = {

                    variations: '.product-variations',
                    price:'.commerce--product-price',
                    stock:'.commerce--product-stock',
                    addToCartBtn: '.commerce--add-to-cart-btn'

            }
            var price = {
                get:function () {

                    return $(DOMSelector.price).html();
                },
                set:function (price) {
                    $(DOMSelector.price).html(price);
                }
            }

            var getVariationData = function () {
                var $product = $(DOMSelector.variations);
                var totalVariations = $product.data('variations');
                var productId = $product.data('product');
                return {totalVariations, productId};
            }

            var getVariationAttribute = function (e) {
                var target = $(e.target);
                var parent = $(target.parent());
                var attributeName = $(parent.parent()).data('attribute');
                var attributeValue = target.data('value');
                var parentClass = parent.attr('class').split(' ')[1];
                if (target.hasClass('active')) {
                    //target.removeClass('active');
                    // this.variationList = null;
                    return;
                }
                $('.options-item.' + parentClass + ' > div').removeClass('active');
                target.addClass('active');

                return {attributeName, attributeValue}
            }
            var loading = function(active){
                var ele =  $('#kodCms-loading');
                if(active){
                    ele.fadeIn()
                }else{
                    ele.fadeOut();
                }

            }
            var stock = function (msg=null) {
                        return  $(DOMSelector.stock).html(msg)
            }
            var disableButton = function (value) {
                $(DOMSelector.addToCartBtn).attr('disabled', value);
            }

            /**
             * SKU
             * @type {{set: set, remove: remove}}
             */
            var sku = {
                set: function (sku) {
                    var buttonEle =  $(DOMSelector.addToCartBtn);
                    buttonEle.data("sku",sku)
                    buttonEle.attr('disabled', false);
                },
                remove:function(){
                    var buttonEle =  $(DOMSelector.addToCartBtn);
                    buttonEle.data('sku',null)
                    buttonEle.attr('disabled', true);
                }
            }


            return {
                getDomSelector: DOMSelector,
                getVariationData,
                getVariationAttribute,
                price,
                loading,
                stock,
                sku
            }
        })();

        var AppController = (function (variationCtrl, UICtrl) {

            var actions = {
                index: function (e) {
                    var {totalVariations, productId} = UICtrl.getVariationData()
                    var {attributeName, attributeValue} = UICtrl.getVariationAttribute(e);

                    variationCtrl.setVariation(attributeName, attributeValue);

                        console.log(variationCtrl.totalSelected(),variationCtrl.getVariation())
                    if (variationCtrl.totalSelected() === totalVariations) {
                       UICtrl.loading(true)
                      variationCtrl.getSKU(productId)
                          .then(function(res){
                              if(res.stock){
                                  UICtrl.price.set(res.price);
                                  UICtrl.stock("Available");
                                  UICtrl.sku.set(res.sku)
                              }else{
                                  UICtrl.stock("Unavailable");
                                  UICtrl.sku.remove();
                                  UICtrl.price.set(res.price);
                              }
                          })
                          .finally(function(){
                              UICtrl.loading(false)
                      })
                    }

                }
            }

            var setupEvents = function () {

                $('.options-item > div').on('click',actions.index);
            }

            return {
                init: function () {
                    setupEvents();
                }
            }
        })(VariationController, UIController);


        /**
         * Initialize
         */

       return {
           init:function(userConfig=null){
               if(userConfig){
                   Object.assign(config,userConfig);
               }
               kodObject.init(config.apiRoute)
               AppController.init();
           }
       }
    }
);
