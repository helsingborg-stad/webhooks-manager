<?php

namespace WebhooksManager\Webhook;

class WebhookTest extends \PHPUnit\Framework\TestCase
{
    public function testGetHeadersReturnsArray()
    {
        $webhook = new Webhook('https://example.com', 'POST', 'test', 1, true, true);
        $this->assertIsArray($webhook->getHeaders());
    }

    public function testHeadersOnlyAcceptsValidHeaderStrings()
    {
        $headers = [123, 'Authorization: value', ['value'], true, null, new \stdClass()];

        $webhook = new Webhook('https://example.com', 'POST', 'test', 1, true, true, $headers);

        $resultingHeaders = $webhook->getHeaders();

        $this->assertIsArray($resultingHeaders);
        $this->assertCount(1, $resultingHeaders);
        $this->assertEquals('value', $resultingHeaders['Authorization']);
    }

    public function testHeadersArePreparedForRequest()
    {
        $headers = [ 'Authorization: Basic 123' ];
        $webhook = new Webhook('https://example.com', 'POST', 'test', 1, true, true, $headers);

        $this->assertEquals(['Authorization' => 'Basic 123'], $webhook->getHeaders());
    }
}
