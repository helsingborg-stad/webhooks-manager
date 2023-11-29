<?php

namespace WebhooksManager\WebhookActionBinder;

use WebhooksManager\Webhook\WebhookInterface;
use WebhooksManager\WebhookDispatcher\WebhookDispatcherInterface;

/**
 * Class WebhookActionBinder
 *
 * Binds a webhook to an action in WordPress.
 */
class WebhookActionBinder implements WebhookActionBinderInterface
{
    /**
     * WebhookActionBinder constructor.
     *
     * @param WebhookInterface $webhook
     * @param WebhookDispatcherInterface $webhookDispatcher
     */
    public function __construct(
        private WebhookInterface $webhook,
        private WebhookDispatcherInterface $webhookDispatcher
    ) {
    }

    /**
     * Binds the webhook to the specified action in WordPress.
     */
    public function bindWebhookToAction(): void
    {
        $action       = $this->webhook->getAction();
        $callback     = [$this, 'actionCallback'];
        $priority     = $this->webhook->getActionPriority();
        $acceptedArgs = 100; // Allow for any number since we have no way of knowing the number on forehand.
        add_action($action, $callback, $priority, $acceptedArgs);
    }

    /**
     * Callback function for the action.
     * Dispatches the webhook if it is active.
     */
    public function actionCallback(): void
    {
        if (!$this->webhook->isActive()) {
            return;
        }

        $this->webhookDispatcher->dispatch($this->webhook, func_get_args());
    }
}
