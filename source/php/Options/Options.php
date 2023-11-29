<?php

namespace WebhooksManager\Options;

class Options implements OptionsInterface
{
    public const DEFAULT_ACTIONS = [
        'post_updated',
        'post_created',
        'post_deleted',
    ];

    public function getHttpMethods(): array
    {
        return ['GET', 'POST'];
    }

    public function getActions(): array
    {
        return apply_filters('WebhooksManager\Options\getActions', self::DEFAULT_ACTIONS);
    }
}
