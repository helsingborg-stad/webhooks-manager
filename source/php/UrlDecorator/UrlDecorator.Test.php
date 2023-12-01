<?php

namespace WebhooksManager\UrlDecorator\Test;

use PHPUnit\Framework\TestCase;
use WebhooksManager\UrlDecorator\UrlDecorator;

class UrlDecoratorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testDecorateUrlWithReplacesSpecifiersWithArguments($url, $arguments, $expected)
    {
        $urlDecorator = new UrlDecorator();
        $actual       = $urlDecorator->decorateUrlWith($url, $arguments);

        $this->assertEquals($expected, $actual);
    }

    public function dataProvider()
    {
        return [
            ['https://example.com/$1', [1], 'https://example.com/1'],
            ['https://example.com/$1', ['foo'], 'https://example.com/foo'],
            ['https://example.com/$1/$2', [1, 'foo'], 'https://example.com/1/foo']
        ];
    }

    public function testDecorateUrlWithReturnsUrlWhenArgumentsIsEmptyArray()
    {
        $urlDecorator = new UrlDecorator();
        $result       = $urlDecorator->decorateUrlWith('https://example.com', []);

        $this->assertEquals('https://example.com', $result);
    }

    public function testDecorateUrlWithReturnsUrlWhenArgumentsAreNull()
    {
        $urlDecorator = new UrlDecorator();
        $result       = $urlDecorator->decorateUrlWith('https://example.com', null);

        $this->assertEquals('https://example.com', $result);
    }

    // Test that arguments that are not strings or numbers are not included in the URL.
    public function testDecorateUrlWithDoesNotIncludeArgumentsThatAreNotStringsOrNumbers()
    {
        $urlDecorator = new UrlDecorator();
        $result       = $urlDecorator->decorateUrlWith('https://example.com/$1/$2', [1, 'foo', ['bar']]);

        $this->assertEquals('https://example.com/1/foo', $result);
    }
}
