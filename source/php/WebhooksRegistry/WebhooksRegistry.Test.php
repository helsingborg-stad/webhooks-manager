<?php

namespace WebhooksManager\WebhooksRegistry\Test;

use WP_Mock;
use WP_Mock\Tools\TestCase;

class WebhooksRegistryTest extends TestCase
{
    public function testThatWebhooksGetsCreated()
    {
        WP_Mock::userFunction('get_field')->andReturn([
            [
                'payload_url'         => 'https://example.com',
                'http_method'         => 'GET',
                'action'              => 'my_action',
                'action_priority'     => 10,
                'should_send_payload' => true,
                'is_active'           => true,
                'headers'             => ['Content-Type: application/json']
            ]
        ]);

        $webhooksRegistry = new \WebhooksManager\WebhooksRegistry\WebhooksRegistry();
        $webhooksRegistry->registerWebhooks();

        $webhooks = $webhooksRegistry->getWebhooks();
        $this->assertCount(1, $webhooks);
        $this->assertInstanceOf(\WebhooksManager\Webhook\WebhookInterface::class, $webhooks[0]);

        $webhook = $webhooks[0];
        $this->assertEquals('https://example.com', $webhook->getPayloadUrl());
        $this->assertEquals('GET', $webhook->getHttpMethod());
        $this->assertEquals('my_action', $webhook->getAction());
        $this->assertEquals(10, $webhook->getActionPriority());
        $this->assertTrue($webhook->shouldSendPayload());
        $this->assertTrue($webhook->isActive());
        $this->assertEquals(['Content-Type' => 'application/json'], $webhook->getHeaders());
    }
}
