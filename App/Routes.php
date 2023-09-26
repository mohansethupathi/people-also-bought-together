<?php

namespace App;

if (!defined('ABSPATH')) exit();

class Routes
{
    private static $related_products;
    private static $enqueue;

    public function init()
    {
        self::$related_products = empty(self::$related_products) ? new \App\Controller\RelatedProducts() : self::$related_products;
        self::$enqueue = empty(self::$enqueue) ? new \App\Controller\Enqueue() : self::$enqueue;
        add_action('init', array(self::$related_products, 'addAllRelatedProductsToCart'));
        add_action('admin_enqueue_scripts', array(self::$enqueue, 'enqueueScripts'));
        add_action('add_meta_boxes', array(self::$related_products, 'addRelatedProductsFields'));
        add_action('save_post_product', array(self::$related_products, 'saveRelatedProductsData'));
        add_action('woocommerce_after_single_product_summary', array(self::$related_products, 'displayRelatedProducts'));

    }

}
