<?php

namespace WebhooksManager\Options;

interface OptionsInterface
{
    public function getHttpMethods(): array;
    public function getActions(): array;
}
