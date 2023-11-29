<?php

namespace WebhooksManager\AcfFields;

use WebhooksManager\Options\OptionsInterface;

/**
 * Class FieldOptionsModifier
 *
 * This class is responsible for modifying the options of ACF fields based on the Webhooks Manager settings.
 */
class FieldOptionsModifier
{
    private OptionsInterface $options;

    /**
     * FieldOptionsModifier constructor.
     *
     * @param OptionsInterface $options The options object used to retrieve the available actions and HTTP methods.
     */
    public function __construct(OptionsInterface $options)
    {
        $this->options = $options;
    }

    /**
     * Modifies the options of the action field based on the Webhooks Manager settings.
     *
     * @param array $field The ACF field options.
     * @return array The modified ACF field options.
     */
    public function getActionFieldOptions($field)
    {
        if (!$this->isOnWebhooksManagerPage()) {
            return $field;
        }

        foreach ($this->options->getActions() as $value) {
            $field['choices'][$value] = $value;
        }

        return $field;
    }

    /**
     * Modifies the options of the HTTP method field based on the Webhooks Manager settings.
     *
     * @param array $field The ACF field options.
     * @return array The modified ACF field options.
     */
    public function getHttpMethodFieldOptions($field)
    {
        if (!$this->isOnWebhooksManagerPage()) {
            return $field;
        }

        foreach ($this->options->getHttpMethods() as $value) {
            $field['choices'][$value] = $value;
        }

        return $field;
    }

    /**
     * Checks if the current page is the Webhooks Manager page.
     *
     * @return bool True if the current page is the Webhooks Manager page, false otherwise.
     */
    private function isOnWebhooksManagerPage(): bool
    {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        return isset($_GET['page']) && $_GET['page'] === 'webhooks-manager';
    }
}
