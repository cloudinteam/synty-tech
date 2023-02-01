<?php


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'stor_woocommerce_header_add_to_cart_fragment');

function stor_woocommerce_header_add_to_cart_fragment($fragments)
{

    ob_start();

?>
     <span class="cart-contents"><?php if ( !is_null(WC()->cart) ) {
         echo WC()->cart->get_cart_contents_count();
     } ?></span>

<?php
    $fragments['.cart-contents'] = ob_get_clean();
    return $fragments;
}














