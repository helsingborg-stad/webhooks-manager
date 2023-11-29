<?php

namespace WebhooksManager;

use WebhooksManager\AcfFields\FieldOptionsModifier;
use WebhooksManager\WebhookActionBinder\WebhookActionBinder;
use WebhooksManager\WebhookDispatcher\WebhookDispatcher;
use WebhooksManager\Options\Options;
use WebhooksManager\WebhooksRegistry\WebhooksRegistry;

class Plugin
{
    public function initialize()
    {
        $options                 = new Options();
        $settingsPage            = new SettingsPage();
        $acfFieldOptionsModifier = new FieldOptionsModifier($options);
        $webhooksRegistry        = new WebhooksRegistry();

        add_action('init', [$settingsPage, 'addPage']);
        add_action('plugins_loaded', [$webhooksRegistry, 'registerWebhooks'], 10);
        add_filter('acf/load_field/name=action', [$acfFieldOptionsModifier, 'getActionFieldOptions']);
        add_filter('acf/load_field/name=http_method', [$acfFieldOptionsModifier, 'getHttpMethodFieldOptions']);

        add_action('plugins_loaded', function () use ($webhooksRegistry) {
            foreach ($webhooksRegistry->getWebhooks() as $webhook) {
                $dispatcher          = new WebhookDispatcher();
                $webhookActionBinder = new WebhookActionBinder($webhook, $dispatcher);
                $webhookActionBinder->bindWebhookToAction();
            }
        }, 20);
    }
}
