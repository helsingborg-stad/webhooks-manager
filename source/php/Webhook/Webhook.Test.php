<?php

namespace WebhooksManager\Webhook;

class WebhookTest extends \PHPUnit\Framework\TestCase
{
    public function testGetHeadersReturnsArray()
    {
        $webhook = new Webhook('https://example.com', 'POST', 'test', 1, true, true);
        $this->assertIsArray($webhook->getHeaders());
    }

    public function testHeadersOnlyAcceptsArrayOfStringsAndNumbers()
    {
        $headers = [
            'acceptedHeaderOne'      => 'value',
            'acceptedHeaderTwo'      => 123,
            'notAcceptedHeaderOne'   => ['value'],
            'notAcceptedHeaderTwo'   => true,
            'notAcceptedHeaderThree' => null,
            'notAcceptedHeaderFour'  => new \stdClass(),
        ];

        $webhook = new Webhook('https://example.com', 'POST', 'test', 1, true, true, $headers);

        $this->assertArrayHasKey('acceptedHeaderOne', $webhook->getHeaders());
        $this->assertArrayHasKey('acceptedHeaderTwo', $webhook->getHeaders());
        $this->assertArrayNotHasKey('notAcceptedHeaderOne', $webhook->getHeaders());
        $this->assertArrayNotHasKey('notAcceptedHeaderTwo', $webhook->getHeaders());
        $this->assertArrayNotHasKey('notAcceptedHeaderThree', $webhook->getHeaders());
        $this->assertArrayNotHasKey('notAcceptedHeaderFour', $webhook->getHeaders());
    }
}
