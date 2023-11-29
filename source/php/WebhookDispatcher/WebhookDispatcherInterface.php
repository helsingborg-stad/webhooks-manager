<?php

namespace WebhooksManager\WebhookDispatcher;

use WebhooksManager\Webhook\WebhookInterface;

/**
 * Interface for a webhook dispatcher.
 */
interface WebhookDispatcherInterface
{
    /**
     * Dispatches a webhook with the given arguments.
     *
     * @param WebhookInterface $webhook The webhook to dispatch.
     * @param mixed $hookArguments The arguments to pass to the webhook.
     * @return void
     */
    public function dispatch(WebhookInterface $webhook, $hookArguments): void;
}
