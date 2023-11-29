<?php

namespace WebhooksManager;

interface WebhookDispatcherInterface
{
    public function dispatch(WebhookInterface $webhook, $hookArguments): void;
}
