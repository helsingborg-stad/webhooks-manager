<?php

namespace WebhooksManager\WebhookActionBinder\Test;

use PHPUnit\Framework\MockObject\MockObject;
use WebhooksManager\Webhook\WebhookInterface;
use WebhooksManager\WebhookActionBinder\WebhookActionBinder;
use WebhooksManager\WebhookDispatcher\WebhookDispatcherInterface;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class WebhookActionBinderTest extends TestCase
{
    public function testThatItBindsWebhookToExpectedAction()
    {
        // Given
        $actionName = 'test_action';
        $webhook    = $this->getWebhookMock();
        $webhook->method('getAction')->willReturn($actionName);
        $webhook->method('getActionPriority')->willReturn(10);
        $webhookDispatcher   = $this->getWebhookDispatcherMock();
        $webhookActionBinder = new WebhookActionBinder($webhook, $webhookDispatcher);
        WP_Mock::expectActionAdded($actionName, [$webhookActionBinder, 'actionCallback'], 10, 100);

        // When
        $webhookActionBinder->bindWebhookToAction();

        // Then
        $this->assertConditionsMet();
    }

    public function testThatWebhookDispatcherDispatchIsCalled()
    {
        // Given
        $webhook = $this->getWebhookMock();
        $webhook->method('getAction')->willReturn('test_action');
        $webhook->method('isActive')->willReturn(true);
        $webhookDispatcher   = $this->getWebhookDispatcherMock();
        $webhookActionBinder = new WebhookActionBinder($webhook, $webhookDispatcher);
        $webhookDispatcher->expects($this->once())->method('dispatch')->with($webhook, [['test' => 'test']]);

        // When
        $webhookActionBinder->actionCallback(['test' => 'test']);

        // Then
        $this->assertConditionsMet();
    }

    public function testThatWebhookDispatcherDispatchIsNotCalledIsWebhookInactive()
    {
        // Given
        $webhook = $this->getWebhookMock();
        $webhook->method('getAction')->willReturn('test_action');
        $webhook->method('isActive')->willReturn(false);
        $webhookDispatcher   = $this->getWebhookDispatcherMock();
        $webhookActionBinder = new WebhookActionBinder($webhook, $webhookDispatcher);
        $webhookDispatcher->expects($this->never())->method('dispatch');

        // When
        $webhookActionBinder->actionCallback([]);

        // Then
        $this->assertConditionsMet();
    }

    private function getWebhookMock(): MockObject|WebhookInterface
    {
        return $this->createMock(WebhookInterface::class);
    }

    private function getWebhookDispatcherMock(): MockObject|WebhookDispatcherInterface
    {
        return $this->createMock(WebhookDispatcherInterface::class);
    }
}
