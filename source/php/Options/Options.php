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
     * An array of HTTP methods supported by the plugin.
     *
     * @return array The supported HTTP methods.
     */
    public function getTypeLabels(): object
    {
        return (object) [
            'cron' => __("Cron:"),
            'post' => __("Post:")
        ];
    }

    /**
     * Retrieves the available post actions.
     *
     * @return array The available post actions.
     */
    private function getPostActions(): array
    {
        $avabilePostActions = []; 
        foreach(self::DEFAULT_ACTIONS as $action) {
            $avabilePostActions[$action] = $this->getTypeLabels()->post . " " . $action;
        }
        return apply_filters('WebhooksManager\Options\getPostActions', 
            $avabilePostActions
        );
    }

    /**
     * Retrieves the available cron actions.
     *
     * @return array The available cron actions.
     */
    private function getCronActions(): array
    {
        $cron = get_option('cron', []);
        $avabileCronActions = [];

        if(!empty($cron) && is_countable($cron)) {
            foreach ($cron as $value) {
                if(!is_countable($value)) {
                    continue;
                }
                foreach($value as $action => $cronItem) {
                    $cronItem = array_pop($cronItem);
                    if($cronItem['schedule'] !== false) {
                        $avabileCronActions[$action] = $this->getTypeLabels()->cron . " " . $action;
                    }
                }
            }
        }

        return apply_filters('WebhooksManager\Options\getCronActions', 
            $avabileCronActions
        );
    }
}
