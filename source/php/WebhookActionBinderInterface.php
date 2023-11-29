<?php

namespace WebhooksManager;

interface WebhookActionBinderInterface
{
    public function bindWebhookToAction(): void;
}
