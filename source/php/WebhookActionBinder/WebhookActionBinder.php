<?php

namespace WebhooksManager\WebhookActionBinder;

use WebhooksManager\Webhook\WebhookInterface;
use WebhooksManager\WebhookDispatcher\WebhookDispatcherInterface;

class WebhookActionBinder implements WebhookActionBinderInterface
{
    public function __construct(
        private WebhookInterface $webhook,
        private WebhookDispatcherInterface $webhookDispatcher
    ) {
    }

    public function bindWebhookToAction(): void
    {
        $action       = $this->webhook->getAction();
        $callback     = [$this, 'actionCallback'];
        $priority     = $this->webhook->getActionPriority();
        $acceptedArgs = 100; // Allow for any number since we have no way of knowing the number on forehand.
        add_action($action, $callback, $priority, $acceptedArgs);
    }

    public function actionCallback(): void
    {
        if (!$this->webhook->isActive()) {
            return;
        }

        $this->webhookDispatcher->dispatch($this->webhook, func_get_args());
    }
}
