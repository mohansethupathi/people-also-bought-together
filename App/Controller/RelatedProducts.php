<?php

namespace App\Controller;

if (!defined('ABSPATH')) exit();

class RelatedProducts
{

    public function addRelatedProductsFields()
    {
        if (!is_admin()) return false;
        global $post;

        add_meta_box(
            'related-products-meta-box',
            'Related Products',
            array($this, 'renderFields'),
            'product',
            'normal',
            'low'
        );
    }

    public function renderFields()
    {
        if (!is_admin()) return false;
        global $post;

        if ($post) {

            $related_products = get_post_meta($post->ID, 'relatedproducts', true);

            include(WP_PLUGIN_DIR . "/people-bought-together/App/View/relatedproducts.php");
        }
    }

    public function saveRelatedProductsData($post_id)
    {
        if (!is_admin()) return false;
        $related_products = isset($_POST['relatedproducts']) ? implode(" , ", $_POST['relatedproducts']) : '';
        $related_products = sanitize_text_field($related_products);
        update_post_meta($post_id, 'relatedproducts', $related_products);

    }

    public function displayRelatedProducts()
    {
        global $product;
        if (!$product) return false;

        $related_product_ids = get_post_meta($product->get_id(), 'relatedproducts', true);

        if (!file_exists(WP_PLUGIN_DIR . '/people-bought-together/App/View/productsummary.php')) return;

        include(WP_PLUGIN_DIR . "/people-bought-together/App/View/productsummary.php");
    }

    public function addAllRelatedProductsToCart()
    {

        if (isset($_POST['add_all_related_products'])) {
            $product_id = $_POST['add_all_related_products']; // Get the current product's ID
            $related_product_ids = get_post_meta($product_id, 'relatedproducts', true);
            $related_products = explode(' , ', $related_product_ids);

            if (!empty($related_product_ids)) {
                WC()->cart->add_to_cart($product_id);
                foreach ($related_products as $related_product_id) {
                    // Add each related product to the cart
                    WC()->cart->add_to_cart($related_product_id);
                }

                // Redirect to the cart page after adding products
                wp_safe_redirect(wc_get_cart_url());
                exit;
            }
        }
    }

}
