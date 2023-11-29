<?php

namespace WebhooksManager\WebhookDispatcher;

use WebhooksManager\Webhook\WebhookInterface;

/**
 * Class WebhookDispatcher
 *
 * Responsible for dispatching webhooks by sending HTTP requests.
 */
class WebhookDispatcher implements WebhookDispatcherInterface
{
    /**
     * Dispatches the given webhook by sending an HTTP request.
     *
     * @param WebhookInterface $webhook The webhook to be dispatched.
     * @param mixed $hookArguments The arguments to be included in the webhook payload.
     * @return void
     */
    public function dispatch(WebhookInterface $webhook, $hookArguments): void
    {
        $payload = $webhook->shouldSendPayload() ? $hookArguments : null;

        if ($webhook->getHttpMethod() === 'GET') {
            $this->dispatchGetRequest($webhook->getPayloadUrl(), $payload);
        } else {
            $this->dispatchPostRequest($webhook->getPayloadUrl(), $payload);
        }
    }

    /**
     * Dispatches a GET request to the specified URL with the given payload.
     *
     * @param string $url The URL to send the GET request to.
     * @param mixed $payload The payload to be included in the request.
     * @return void
     */
    private function dispatchGetRequest($url, $payload)
    {
        if (is_array($payload)) {
            $url .= '?' . http_build_query($payload);
        }

        wp_remote_get($url, ['blocking' => false ]);
    }

    /**
     * Dispatches a POST request to the specified URL with the given payload.
     *
     * @param string $url The URL to send the POST request to.
     * @param mixed $payload The payload to be included in the request.
     * @return void
     */
    private function dispatchPostRequest(string $url, $payload)
    {
        $arguments = [ 'body' => json_encode($payload), 'data_format' => 'body', 'blocking' => false ];
        wp_remote_post($url, $arguments);
    }
}
