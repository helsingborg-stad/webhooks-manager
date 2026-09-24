<?php

declare(strict_types=1);

namespace WebhooksManager\Test;

use WP_Mock;
use WP_Mock\Tools\TestCase;

class PluginTest extends TestCase
{
    public function testInitializeRegistersWebhookSetupOnAcfInit(): void
    {
        $registeredHooks = [];

        WP_Mock::userFunction('add_action', [
            'return' => static function (
                string $hook,
                $callback,
                int $priority = 10,
                int $acceptedArgs = 1
            ) use (&$registeredHooks) {
                $registeredHooks[] = [
                    'hook' => $hook,
                    'callback' => $callback,
                    'priority' => $priority,
                    'accepted_args' => $acceptedArgs,
                ];

                return true;
            },
        ]);

        WP_Mock::userFunction('add_filter', ['return' => true]);

        $plugin = new \WebhooksManager\Plugin();

        $plugin->initialize();

        $registerWebhookCallbacks = array_values(array_filter(
            $registeredHooks,
            static fn(array $hook): bool => $hook['hook'] === 'acf/init'
                && is_array($hook['callback'])
                && $hook['callback'][1] === 'registerWebhooks'
                && $hook['priority'] === 10
                && $hook['accepted_args'] === 1
        ));

        $this->assertCount(
            1,
            $registerWebhookCallbacks
        );

        $acfInitBindings = array_values(array_filter(
            $registeredHooks,
            static fn(array $hook): bool => $hook['hook'] === 'acf/init'
        ));

        $this->assertCount(2, $acfInitBindings);
        $this->assertNotContains(
            'plugins_loaded',
            array_column($registeredHooks, 'hook')
        );
    }
}
