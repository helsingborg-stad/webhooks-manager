<?php

namespace WebhooksManager\UrlDecorator;

class UrlDecorator implements UrlDecoratorInterface
{
    /**
     * Decorates the given URL with the given arguments.
     *
     * @param string $url The URL to be decorated.
     * Should be formatted with sprintf specifiers. https://www.php.net/manual/en/function.sprintf.php
     * @param mixed $arguments The arguments to be included in the URL.
     * @return string The decorated URL.
     */
    public function decorateUrlWith(string $url, ?array $arguments): string
    {
        if (empty($arguments)) {
            return $url;
        }

        foreach ($arguments as $key => $value) {
            if (!is_string($value) && !is_numeric($value)) {
                continue;
            }

            $url = str_replace('$' . $key + 1, urlencode($value), $url);
        }

        return $url;
    }
}
