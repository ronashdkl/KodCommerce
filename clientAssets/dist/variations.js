(function ($) {

    "use strict";
    var BASEURL = '/';


    var OptionManager = (function () {
        var objToReturn = {};

        var defaultOptions = {
            selector: 'product-variations',
        };


        var getOptions = function (customOptions) {
            var options = $.extend({}, defaultOptions);
            if (typeof customOptions === 'object') {
                $.extend(options, customOptions);
            }
            return options;
        }

        objToReturn.getOptions = getOptions;
        return objToReturn;
    }());



    var ProductVariation = function (target, userOptions) {
        /*
        PRIVATE
        */
        var $target = $(target);
        var options = OptionManager.getOptions(userOptions);

        /*
        EVENT
        */

        var resetVariation = function () {
            $('#product-qty').val("");
            $ProductVariation = [];
            $('.variant-select a').removeClass('active');
            $('.color-select a').removeClass('active');


        }

        $target.click(function () {
            let r = Math.random().toString(36).substring(7);
            var id = $target.data('id');
            var sku = $target.data('sku') + '-' + r;
            var name = $target.data('name');
            var color = $productColor;
            var summary = $target.data('summary');
            var price = $target.attr('data-price');
            var quantity = $('#product-qty').val();
            var image = $target.attr('data-image');
            var valid = false;

            //validation
            /*  if (productConfig.required_color === "1" && $productColor === null) {
                  new Noty({type: "error", text: "Please Choose Color"}).setTimeout(2000).show();
                  return false;
              }*/


            if (typeof Variations !== 'undefined') {

                $.each(Variations, function (i, k) {

                    var foundValue = $ProductVariation.filter(obj => obj.key === k.key);

                    // console.log(i+" Key "+k.key+" Selected Variations "+$ProductVariation[i].name);


                    if (k.required === 1 && foundValue.length === 0) {
                        new Noty({type: "error", text:  "VÃ¤nligen vÃ¤lj"+ k.name }).setTimeout(2000).show();
                        valid = false;
                        return false;
                    }
                    valid = true;

                });


            } else {
                valid = true;
            }

            if (!valid) {
                return false;
            }

            if (quantity < 1) {
                quantity = 1;
            }

            options.clickOnAddToCart($target);
            ProductManager.setProduct(sku, id, name, color, summary, price, quantity, image, $ProductVariation);

            console.log(ProductManager.getTotalQuantityOfProduct());
            $OldProductVariation = $ProductVariation;
            if ($OldProductVariation.length > 0) {
                resetVariation();
            }


        });

    }


    $.fn.productVariation = function (userOptions) {
        loadMyCartEvent(userOptions);

        return $.each(this, function () {
            new MyCart(this, userOptions);
        });
    }


})(jQuery);


