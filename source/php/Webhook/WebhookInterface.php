<?php

namespace WebhooksManager\Webhook;

/**
 * Interface for defining a webhook.
 */
interface WebhookInterface
{
    /**
     * Get the payload URL for the webhook.
     *
     * @return string The payload URL.
     */
    public function getPayloadUrl(): string;

    /**
     * Get the HTTP method for the webhook.
     *
     * @return string The HTTP method.
     */
    public function getHttpMethod(): string;

    /**
     * Get the action for the webhook.
     *
     * @return string The action.
     */
    public function getAction(): string;

    /**
     * Get the action priority for the webhook.
     *
     * @return int The action priority.
     */
    public function getActionPriority(): int;

    /**
     * Check if the webhook should send the payload.
     *
     * @return bool True if the payload should be sent, false otherwise.
     */
    public function shouldSendPayload(): bool;

    /**
     * Check if the webhook is active.
     *
     * @return bool True if the webhook is active, false otherwise.
     */
    public function isActive(): bool;
}
