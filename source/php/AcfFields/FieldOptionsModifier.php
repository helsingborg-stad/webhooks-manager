<?php

namespace WebhooksManager\AcfFields;

use WebhooksManager\Options\OptionsInterface;

class FieldOptionsModifier
{
    private OptionsInterface $options;

    public function __construct(OptionsInterface $options)
    {
        $this->options = $options;
    }

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

    private function isOnWebhooksManagerPage(): bool
    {
        return isset($_GET['page']) && $_GET['page'] === 'webhooks-manager';
    }
}
