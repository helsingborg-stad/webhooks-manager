<?php

namespace WebhookDispatcher\Test;

use PHPUnit\Framework\MockObject\MockObject;
use WebhooksManager\WebhookDispatcher;
use WebhooksManager\WebhookInterface;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class WebhookDispatcherTest extends TestCase
{
    public function testDispatchMakesGetRequestIfHttpMethodIsGet()
    {
        WP_Mock::userFunction('wp_remote_get', [
            'times' => 1,
            'args'  => ['https://example.com?foo=bar', ['blocking' => false]],
        ]);

        $webhook = $this->getWebhookMock();
        $webhook->method('getHttpMethod')->willReturn('GET');
        $webhook->method('getPayloadUrl')->willReturn('https://example.com');
        $webhook->method('shouldSendPayload')->willReturn(true);

        $webhookDispatcher = new WebhookDispatcher();
        $webhookDispatcher->dispatch($webhook, ['foo' => 'bar']);

        $this->assertConditionsMet();
    }

    public function testDispatchMakesPostRequestIfHttpMethodIsPost()
    {
        $actionArguments = ['foo' => 'bar'];
        $body            = json_encode($actionArguments);
        WP_Mock::userFunction('wp_remote_post', [
            'times' => 1,
            'args'  => ['https://example.com', ['blocking' => false, 'data_format' => 'body', 'body' => $body]],
        ]);

        $webhook = $this->getWebhookMock();
        $webhook->method('getHttpMethod')->willReturn('POST');
        $webhook->method('getPayloadUrl')->willReturn('https://example.com');
        $webhook->method('shouldSendPayload')->willReturn(true);

        $webhookDispatcher = new WebhookDispatcher();
        $webhookDispatcher->dispatch($webhook, $actionArguments);

        $this->assertConditionsMet();
    }

    private function getWebhookMock(): MockObject|WebhookInterface
    {
        return $this->createMock(WebhookInterface::class);
    }
}
