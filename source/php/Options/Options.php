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
        return apply_filters('WebhooksManager\Options\getActions', array_merge(
                $this->getPostActions(),
                $this->getCronActions()
            )
        );
    }

    /**
     * Retrieves the available post actions.
     *
     * @return array The available post actions.
     */
    private function getPostActions(): array
    {
        return apply_filters('WebhooksManager\Options\getPostActions', 
            self::DEFAULT_ACTIONS
        );
    }

    /**
     * Retrieves the available cron actions.
     *
     * @return array The available cron actions.
     */
    private function getCronActions(): array
    {
        return apply_filters('WebhooksManager\Options\getCronActions', 
            []
        );
    }
}
