<?php

namespace WebhooksManager;

/**
 * Class SettingsPage
 *
 * Represents the settings page for the Webhooks Manager plugin.
 */
class SettingsPage
{
    public const SLUG        = 'webhooks-manager';
    public const PARENT_SLUG = 'tools.php';
    public const CAPABILITY  = 'manage_options';

    /**
     * Adds the settings page to the WordPress admin menu.
     */
    public function addPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __('Webhooks Manager', 'webhooks-manager'),
                'menu_title'  => __('Webhooks Manager', 'webhooks-manager'),
                'menu_slug'   => self::SLUG,
                'parent_slug' => self::PARENT_SLUG,
                'capability'  => self::CAPABILITY,
                'position'    => false,
                'icon_url'    => false,
                'redirect'    => false
            ));
        }
    }
}
