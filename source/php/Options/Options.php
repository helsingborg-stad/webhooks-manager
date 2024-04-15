<?php

namespace WebhooksManager\Options;

use stdClass;

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
    public const DEFAULT_POST_ACTIONS = [
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
        ));
    }

    /**
     * An array of HTTP methods supported by the plugin.
     *
     * @return object The supported HTTP methods.
     */
    public function getTypeLabels(): object
    {
        $typeLabels       = new stdClass();
        $typeLabels->cron = __("Cron:");
        $typeLabels->post = __("Post:");
        return $typeLabels;
    }

    /**
     * Retrieves the available post actions.
     *
     * @return array The available post actions.
     */
    public function getPostActions(): array
    {
        $availablePostActions = [];

        foreach (self::DEFAULT_POST_ACTIONS as $action) {
            $availablePostActions[$action] = $this->getTypeLabels()->post . " " . $action;
        }

        return apply_filters('WebhooksManager\Options\getPostActions', $availablePostActions);
    }

    /**
     * Retrieves the available cron actions.
     *
     * @return array The available cron actions.
     */
    public function getCronActions(): array
    {
        $cron               = get_option('cron', []);
        $avabileCronActions = [];

        if (!empty($cron) && is_countable($cron)) {
            foreach ($cron as $value) {
                if (!is_countable($value)) {
                    continue;
                }
                foreach ($value as $action => $cronItem) {
                    $cronItem = array_pop($cronItem);
                    if ($cronItem['schedule'] !== false) {
                        $avabileCronActions[$action] = $this->getTypeLabels()->cron . " " . $action;
                    }
                }
            }
        }

        return apply_filters(
            'WebhooksManager\Options\getCronActions',
            $avabileCronActions
        );
    }
}
