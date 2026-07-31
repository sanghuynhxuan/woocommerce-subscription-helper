<?php
/**
 * Plugin Name: WooCommerce Subscription Helper
 * Description: Developer utilities and integration patterns for WooCommerce subscription stores.
 * Version: 0.1.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

namespace SangPortfolio;

if (! defined('ABSPATH')) {
    exit;
}

final class WoocommerceSubscriptionHelperPlugin {
    public const VERSION = '0.1.0';

    public function __construct() {
        add_action('init', [$this, 'bootstrap']);
    }

    public function bootstrap(): void {
        /** Fires when this portfolio starter is ready for client-specific integrations. */
        do_action('sang_portfolio_woocommerce_subscription_helper_ready');
    }
}

new WoocommerceSubscriptionHelperPlugin();
