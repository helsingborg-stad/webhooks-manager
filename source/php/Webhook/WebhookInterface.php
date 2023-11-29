<?php

namespace WebhooksManager\Webhook;

interface WebhookInterface
{
    public function getPayloadUrl(): string;
    public function getHttpMethod(): string;
    public function getAction(): string;
    public function getActionPriority(): int;
    public function shouldSendPayload(): bool;
    public function isActive(): bool;
}
