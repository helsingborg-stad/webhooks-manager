<?php

namespace WebhooksManager\Webhook;

class Webhook implements WebhookInterface
{
    public function __construct(
        private string $payloadUrl,
        private string $httpMethod,
        private string $action,
        private int $actionPriority,
        private bool $shouldSendPayload,
        private bool $isActive
    ) {
    }

    public function getPayloadUrl(): string
    {
        return $this->payloadUrl;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getActionPriority(): int
    {
        return $this->actionPriority;
    }

    public function shouldSendPayload(): bool
    {
        return $this->shouldSendPayload;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
