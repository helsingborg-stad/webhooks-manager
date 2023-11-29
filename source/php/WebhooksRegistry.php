<?php

namespace WebhooksManager;

class WebhooksRegistry implements WebhooksRegistryInterface
{
    /**
     * @var WebhookInterface[]
     */
    private array $webhooks       = [];
    private array $webhooksOption = [];

    public function registerWebhooks(): void
    {
        $this->webhooksOption = get_field('webhooks', 'option');
        if (!empty($this->webhooksOption)) {
            $this->registerWebhooksFromOptions();
        }
    }

    private function registerWebhooksFromOptions(): void
    {
        foreach ($this->webhooksOption as $webhookOption) {
            if ($this->isValidWebhookOption($webhookOption)) {
                $this->webhooks[] = new Webhook(
                    $webhookOption['payload_url'],
                    $webhookOption['http_method'],
                    $webhookOption['action'],
                    $webhookOption['action_priority'],
                    $webhookOption['should_send_payload'],
                    $webhookOption['is_active']
                );
            }
        }
    }

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
     * @return WebhookInterface[]
     */
    public function getWebhooks(): array
    {
        return $this->webhooks;
    }
}
