<?php
if (!empty($related_product_ids)) {
    $related_products = explode(' , ', $related_product_ids);
    echo '<form method="post">';
    echo '<div class="related-products">';
    echo '<h5>' . esc_html__("People Also Bought This Together", "woocommerce") . '</h5>';
    echo '<ul class="is-flex-container columns-5 products-block-post-template wp-block-post-template is-layout-flow wp-block-post-template-is-layout-flow">';

    foreach ($related_products as $related_product_id) {
        $related_product = wc_get_product($related_product_id);

        if ($related_product) {
            $product_image_url = get_the_post_thumbnail_url($related_product_id, 'thumbnail');
            echo '<li>';
            echo '<a href="' . esc_url(get_permalink($related_product_id)) . '"><img src="' . esc_url($product_image_url) . '" alt="' . esc_attr($related_product) . '" />' . esc_html__($related_product->get_name()) . '</a>';
            echo '<p>' . $related_product->get_price_html() . '</p>';
            echo '</li>';
        }
    }

    echo '</ul>';
    $product_id = get_the_ID();
    echo '<input type="hidden" name="add_all_related_products" value="' . $product_id . '" />';
    echo '<button type="submit" class="add-to-cart-all single_add_to_cart_button button alt wp-element-button">' . esc_html__("Add All to Cart", "woocommerce") . '</button>'; // Single "Add to Cart" button for all related products
    echo '</div>';
    echo '</form>';
}
