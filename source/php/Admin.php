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
    }
}
