<?php

namespace WebhooksManager;

interface WebhooksRegistryInterface
{
    public function registerWebhooks(): void;

    /**
     * @return WebhookInterface[]
     */
    public function getWebhooks(): array;
}
