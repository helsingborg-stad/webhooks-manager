<?php

namespace WebhooksManager\WebhookActionBinder;

/**
 * Interface for binding webhooks to actions.
 */
interface WebhookActionBinderInterface
{
    /**
     * Binds a webhook to an action.
     *
     * @return void
     */
    public function bindWebhookToAction(): void;
}
