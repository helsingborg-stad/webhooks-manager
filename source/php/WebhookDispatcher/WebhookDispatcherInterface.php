<?php

namespace WebhooksManager\WebhookDispatcher;

use WebhooksManager\Webhook\WebhookInterface;

interface WebhookDispatcherInterface
{
    public function dispatch(WebhookInterface $webhook, $hookArguments): void;
}
