<?php

/**
 * Plugin Name: People Bought Together
 * Description: Implement People Brought Together Products deals for WooCommerce products.
 * Version: 1.0.0
 * Author: Woo Commerce
 */

if (!defined('ABSPATH')) exit();

if (!file_exists(WP_PLUGIN_DIR . '/people-bought-together/vendor/autoload.php')) return;

require_once WP_PLUGIN_DIR . '/people-bought-together/vendor/autoload.php';

if (!class_exists('App\Routes')) return;

$routes = new App\Routes();
$routes->init();
