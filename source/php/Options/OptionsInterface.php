<?php

namespace WebhooksManager\Options;

/**
 * Interface OptionsInterface
 *
 * This interface defines the methods for retrieving available options.
 */
interface OptionsInterface
{
    /**
     * Get the available HTTP methods.
     *
     * @return array An array of available HTTP methods.
     */
    public function getHttpMethods(): array;

    /**
     * Get the available actions.
     *
     * @return array An array of available actions.
     */
    public function getActions(): array;
}
