<?php

namespace WebhooksManager;

class Plugin
{
    public function initialize()
    {
        $admin = new Admin();
        $admin->addHooks();
    }
}
