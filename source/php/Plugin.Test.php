<?php

declare(strict_types=1);

namespace WebhooksManager {
    function add_action(string $hook, $callback, int $priority = 10, int $acceptedArgs = 1): bool
    {
        \WebhooksManager\Test\PluginHookRecorder::$registeredActions[] = [
            'hook' => $hook,
            'callback' => $callback,
            'priority' => $priority,
            'accepted_args' => $acceptedArgs,
        ];

        return true;
    }

    function add_filter(string $hook, $callback, int $priority = 10, int $acceptedArgs = 1): bool
    {
        \WebhooksManager\Test\PluginHookRecorder::$registeredFilters[] = [
            'hook' => $hook,
            'callback' => $callback,
            'priority' => $priority,
            'accepted_args' => $acceptedArgs,
        ];

        return true;
    }
}

namespace WebhooksManager\Test {

    use WP_Mock\Tools\TestCase;

    class PluginHookRecorder
    {
        public static array $registeredActions = [];
        public static array $registeredFilters = [];
    }

    class PluginTest extends TestCase
    {
        protected function setUp(): void
        {
            parent::setUp();

            PluginHookRecorder::$registeredActions = [];
            PluginHookRecorder::$registeredFilters = [];
        }

        public function testInitializeRegistersWebhookSetupOnAcfInit(): void
        {
            $plugin = new \WebhooksManager\Plugin();

            $plugin->initialize();

            $registerWebhookCallbacks = array_values(array_filter(
                PluginHookRecorder::$registeredActions,
                static fn(array $hook): bool => $hook['hook'] === 'acf/init'
                    && is_array($hook['callback'])
                    && $hook['callback'][1] === 'registerWebhooks'
                    && $hook['priority'] === 10
                    && $hook['accepted_args'] === 1
            ));

            $this->assertCount(1, $registerWebhookCallbacks);

            $this->assertCount(
                1,
                array_values(array_filter(
                    PluginHookRecorder::$registeredActions,
                    static fn(array $hook): bool => $hook['hook'] === 'init'
                        && $hook['callback'] instanceof \Closure
                        && $hook['priority'] === 6
                        && $hook['accepted_args'] === 1
                ))
            );
            $this->assertNotContains(
                'plugins_loaded',
                array_column(PluginHookRecorder::$registeredActions, 'hook')
            );
        }
    }
}
