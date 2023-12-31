<?php

namespace WebhooksManager\Webhook;

/**
 * Class Webhook
 * Represents a webhook with its properties and methods.
 */
class Webhook implements WebhookInterface
{
    /**
     * Webhook constructor.
     *
     * @param string $payloadUrl The URL where the payload will be sent.
     * @param string $httpMethod The HTTP method to be used for the webhook.
     * @param string $action The action to be performed by the webhook.
     * @param int $actionPriority The priority of the action.
     * @param bool $shouldSendPayload Determines if the payload should be sent.
     * @param bool $isActive Determines if the webhook is active.
     */
    public function __construct(
        private string $payloadUrl,
        private string $httpMethod,
        private string $action,
        private int $actionPriority,
        private bool $shouldSendPayload,
        private bool $isActive,
        private ?array $headers = null
    ) {
        $this->headers = $this->setHeaders($headers);
    }

    /**
     * Get the payload URL of the webhook.
     *
     * @return string The payload URL.
     */
    public function getPayloadUrl(): string
    {
        return $this->payloadUrl;
    }

    /**
     * Get the HTTP method of the webhook.
     *
     * @return string The HTTP method.
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * Get the action of the webhook.
     *
     * @return string The action.
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Get the action priority of the webhook.
     *
     * @return int The action priority.
     */
    public function getActionPriority(): int
    {
        return $this->actionPriority;
    }

    /**
     * Check if the payload should be sent.
     *
     * @return bool True if the payload should be sent, false otherwise.
     */
    public function shouldSendPayload(): bool
    {
        return $this->shouldSendPayload;
    }

    /**
     * Check if the webhook is active.
     *
     * @return bool True if the webhook is active, false otherwise.
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Get the headers of the webhook.
     *
     * @return array The headers.
     */
    public function getHeaders(): array
    {
        return is_array($this->headers) ? $this->headers : [];
    }

    /**
     * Set the headers for the webhook.
     *
     * @param array|null $headers The headers to set for the webhook.
     * @return array The updated headers array.
     */
    private function setHeaders(?array $headers): array
    {
        if (!is_array($headers)) {
            return [];
        }

        $validHeaders = array_filter($headers, function ($value) {
            return is_string($value) && str_contains($value, ':');
        });

        $headerKeyValuePairs = array_map(function ($value) {
            [$key, $headerValue] = explode(':', $value, 2);
            return [trim($key) => trim($headerValue)];
        }, $validHeaders);

        $mergedHeaders = array_merge(...$headerKeyValuePairs);

        return array_map('trim', $mergedHeaders);
    }
}
