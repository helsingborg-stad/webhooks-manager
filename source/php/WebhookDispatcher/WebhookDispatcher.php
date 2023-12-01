<?php

namespace WebhooksManager\WebhookDispatcher;

use WebhooksManager\UrlDecorator\UrlDecoratorInterface;
use WebhooksManager\Webhook\WebhookInterface;

/**
 * Class WebhookDispatcher
 *
 * Responsible for dispatching webhooks by sending HTTP requests.
 */
class WebhookDispatcher implements WebhookDispatcherInterface
{
    public function __construct(private UrlDecoratorInterface $urlDecorator)
    {
    }

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
            $this->dispatchGetRequest($webhook, $payload);
        } else {
            $this->dispatchPostRequest($webhook, $payload);
        }
    }

    /**
     * Dispatches a GET request to the specified URL with the given payload.
     *
     * @param string $url The URL to send the GET request to.
     * @param mixed $payload The payload to be included in the request.
     * @return void
     */
    private function dispatchGetRequest(WebhookInterface $webhook, $payload)
    {
        $url = $this->urlDecorator->decorateUrlWith($webhook->getPayloadUrl(), $payload);

        if (is_array($payload)) {
            $url .= '?' . http_build_query($payload);
        }

        wp_remote_get($url, [
            'blocking' => false,
            'headers'  => $webhook->getHeaders()
        ]);
    }

    /**
     * Dispatches a POST request to the specified URL with the given payload.
     *
     * @param string $url The URL to send the POST request to.
     * @param mixed $payload The payload to be included in the request.
     * @return void
     */
    private function dispatchPostRequest(WebhookInterface $webhook, $payload)
    {
        $url           = $this->urlDecorator->decorateUrlWith($webhook->getPayloadUrl(), $payload);
        $bodyArguments = is_array($payload) ? ['body' => json_encode($payload)] : [];

        wp_remote_post($url, [
            'data_format' => 'body',
            'blocking'    => false,
            'headers'     => $webhook->getHeaders(),
            ...$bodyArguments
        ]);
    }
}
