<?php

namespace WebhooksManager;

interface OptionsInterface
{
    public function getHttpMethods(): array;
    public function getActions(): array;
}
