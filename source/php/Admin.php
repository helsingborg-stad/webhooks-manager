<?php

namespace WebhooksManager;

class Admin
{
    public function addHooks()
    {
        add_action('init', array($this, 'addOptionsPage'));
    }

    /**
     * Registers option page
     * @return void
     */
    public function addOptionsPage(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __('Webhooks Manager', 'webhooks-manager'),
                'menu_title'  => __('Webhooks Manager', 'webhooks-manager'),
                'menu_slug'   => 'webhooks-manager',
                'parent_slug' => 'tools.php',
                'capability'  => 'manage_options',
                'position'    => false,
                'icon_url'    => false,
                'redirect'    => false
            ));
        }
    }
}
