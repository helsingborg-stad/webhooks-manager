<?php

namespace WebhooksManager;

use WebhooksManager\AcfFields\FieldOptionsModifier;
use WebhooksManager\WebhookActionBinder\WebhookActionBinder;
use WebhooksManager\WebhookDispatcher\WebhookDispatcher;
use WebhooksManager\Options\Options;
use WebhooksManager\UrlDecorator\UrlDecorator;
use WebhooksManager\WebhooksRegistry\WebhooksRegistry;

/**
 * Class Plugin
 *
 * This class represents the main plugin class for the Webhooks Manager plugin.
 * It is responsible for initializing the plugin and setting up the necessary hooks and actions.
 */
class Plugin
{
    /**
     * Initializes the plugin by setting up the necessary hooks and actions.
     */
    public function initialize()
    {
        $options                 = new Options();
        $settingsPage            = new SettingsPage();
        $acfFieldOptionsModifier = new FieldOptionsModifier($options);
        $webhooksRegistry        = new WebhooksRegistry();

        // Add settings page on plugin initialization
        add_action('init', [$settingsPage, 'addPage']);

        // Register webhooks on plugins loaded
        add_action('plugins_loaded', [$webhooksRegistry, 'registerWebhooks'], 10);

        // Modify ACF field options for 'action' and 'http_method' fields
        add_filter('acf/load_field/name=action', [$acfFieldOptionsModifier, 'getActionFieldOptions']);
        add_filter('acf/load_field/name=http_method', [$acfFieldOptionsModifier, 'getHttpMethodFieldOptions']);

        // Bind webhooks to actions on plugins loaded
        add_action('plugins_loaded', function () use ($webhooksRegistry) {
            foreach ($webhooksRegistry->getWebhooks() as $webhook) {
                $urlDecorator        = new UrlDecorator();
                $dispatcher          = new WebhookDispatcher($urlDecorator);
                $webhookActionBinder = new WebhookActionBinder($webhook, $dispatcher);
                $webhookActionBinder->bindWebhookToAction();
            }
        }, 20);
    }
}
