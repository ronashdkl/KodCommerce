 import './sass/main.scss'
import alertify from 'alertifyjs';

import kodCommerce from './kodCommerce';
import kodCart from './cart';
import kodVariation from './variation';

    const cart  = kodCart(kodCommerce(alertify)).init(window.kodCommerce.cartConfig)
    const variation = kodVariation(kodCommerce(alertify)).init(window.kodCommerce.variationConfig)







