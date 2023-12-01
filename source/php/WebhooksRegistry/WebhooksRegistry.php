<?php

namespace WebhooksManager\WebhooksRegistry;

/**
 * Class WebhooksRegistry
 *
 * This class represents a registry for managing webhooks.
 */
class WebhooksRegistry implements WebhooksRegistryInterface
{
    /**
     * @var \WebhooksManager\Webhook\WebhookInterface[]
     */
    private array $webhooks = [];
    /**
     * @var array
     */
    private array $webhooksOption = [];

    /**
     * Registers webhooks based on the options retrieved from the database.
     */
    public function registerWebhooks(): void
    {
        $this->webhooksOption = get_field('webhooks', 'option');
        if (!empty($this->webhooksOption)) {
            $this->registerWebhooksFromOptions();
        }
    }

    /**
     * Registers webhooks from the options array.
     */
    private function registerWebhooksFromOptions(): void
    {
        foreach ($this->webhooksOption as $webhookOption) {
            if ($this->isValidWebhookOption($webhookOption)) {
                $this->webhooks[] = new \WebhooksManager\Webhook\Webhook(
                    $webhookOption['payload_url'],
                    $webhookOption['http_method'],
                    $webhookOption['action'],
                    $webhookOption['action_priority'],
                    $webhookOption['should_send_payload'],
                    $webhookOption['is_active'],
                    $webhookOption['headers']
                );
            }
        }
    }

    /**
     * Checks if a webhook option is valid.
     *
     * @param mixed $webhookOption The webhook option to validate.
     * @return bool True if the webhook option is valid, false otherwise.
     */
    private function isValidWebhookOption($webhookOption): bool
    {
        return isset($webhookOption['payload_url'])
            && isset($webhookOption['http_method'])
            && isset($webhookOption['action'])
            && isset($webhookOption['action_priority'])
            && isset($webhookOption['should_send_payload'])
            && isset($webhookOption['is_active']);
    }

    /**
     * Returns the registered webhooks.
     *
     * @return \WebhooksManager\Webhook\WebhookInterface[] The registered webhooks.
     */
    public function getWebhooks(): array
    {
        return $this->webhooks;
    }
}
