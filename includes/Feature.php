<?php
declare(strict_types=1);
namespace SangPortfolio\WoocommerceSubscriptionHelper;
if (! defined('ABSPATH')) { exit; }
final class Feature {
    private const OPTION = 'woocommerce_subscription_helper_enabled';
    private const SLUG = 'woocommerce-subscription-helper';
    private const TITLE = 'WooCommerce Subscription Helper';
    public function register(): void {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_menu', [$this, 'registerPage']);
        if (Support::enabled(self::OPTION)) { $this->registerFeature(); }
    }
    public function registerSettings(): void { register_setting(self::SLUG, self::OPTION, ['sanitize_callback' => static fn($value): string => empty($value) ? '0' : '1']); }
    public function registerPage(): void { add_options_page(self::TITLE, self::TITLE, 'manage_options', self::SLUG, [$this, 'renderPage']); }
    public function renderPage(): void { if (! current_user_can('manage_options')) { return; } echo '<div class="wrap"><h1>' . esc_html(self::TITLE) . '</h1><form method="post" action="options.php">'; settings_fields(self::SLUG); echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION) . '" value="1" ' . checked(Support::enabled(self::OPTION), true, false) . '> ' . esc_html__('Enable feature', 'sang-portfolio') . '</label>'; submit_button(); echo '</form></div>'; }
    private function registerFeature(): void { add_action('woocommerce_account_dashboard', [$this, 'renderSubscriptionHelp']); }
    public function renderSubscriptionHelp(): void { if (! function_exists('wcs_get_users_subscriptions')) { return; } $subscriptions = wcs_get_users_subscriptions(get_current_user_id()); if ($subscriptions) { echo '<p>' . esc_html__('Manage renewal dates and payment methods from My Account → Subscriptions.', 'sang-portfolio') . '</p>'; } }
}
