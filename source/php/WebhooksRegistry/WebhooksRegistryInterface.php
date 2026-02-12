<?php

declare(strict_types=1);

namespace WebhooksManager\WebhooksRegistry;

/**
 * Interface for managing webhooks registry.
 */
interface WebhooksRegistryInterface
{
    /**
     * Register webhooks.
     *
     * @return void
     */
    public function registerWebhooks(): void;

    /**
     * Get registered webhooks.
     *
     * @return WebhookInterface[] Array of registered webhooks.
     */
    public function getWebhooks(): array;
}
