<?php

namespace WebhooksManager\Options;

/**
 * Class Options
 *
 * Represents the options for the WebhooksManager plugin.
 */
class Options implements OptionsInterface
{
    /**
     * The default webhook actions.
     */
    public const DEFAULT_ACTIONS = [
        'post_updated',
        'post_created',
        'post_deleted',
    ];

    /**
     * An array of HTTP methods supported by the plugin.
     *
     * @return array The supported HTTP methods.
     */
    public function getHttpMethods(): array
    {
        return ['GET', 'POST'];
    }

    /**
     * Retrieves the available webhook actions.
     *
     * @return array The available webhook actions.
     */
    public function getActions(): array
    {
        return apply_filters('WebhooksManager\Options\getActions', self::DEFAULT_ACTIONS);
    }
}
