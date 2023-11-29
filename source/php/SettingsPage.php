<?php

namespace WebhooksManager;

class SettingsPage
{
    public const SLUG        = 'webhooks-manager';
    public const PARENT_SLUG = 'tools.php';
    public const CAPABILITY  = 'manage_options';

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
