<?php

namespace WebhooksManager\UrlDecorator;

interface UrlDecoratorInterface
{
    /**
     * Decorates the given URL with the given arguments.
     *
     * @param string $url The URL to be decorated.
     * @param mixed $arguments The arguments to be included in the URL.
     * @return string The decorated URL.
     */
    public function decorateUrlWith(string $url, ?array $arguments): string;
}
