<?php

namespace WebhooksManager\WebhookDispatcher;

use WebhooksManager\Webhook\WebhookInterface;

class WebhookDispatcher implements WebhookDispatcherInterface
{
    public function dispatch(WebhookInterface $webhook, $hookArguments): void
    {
        $payload = $webhook->shouldSendPayload() ? $hookArguments : null;

        if ($webhook->getHttpMethod() === 'GET') {
            $this->dispatchGetRequest($webhook->getPayloadUrl(), $payload);
        } else {
            $this->dispatchPostRequest($webhook->getPayloadUrl(), $payload);
        }
    }

    private function dispatchGetRequest($url, $payload)
    {
        if (is_array($payload)) {
            $url .= '?' . http_build_query($payload);
        }

        wp_remote_get($url, ['blocking' => false ]);
    }

    private function dispatchPostRequest(string $url, $payload)
    {
        $arguments = [ 'body' => json_encode($payload), 'data_format' => 'body', 'blocking' => false ];
        wp_remote_post($url, $arguments);
    }
}
