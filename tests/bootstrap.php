<?php

// First we need to load the composer autoloader, so we can use WP Mock
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Bootstrap Patchwork
WP_Mock::setUsePatchwork(true);

// Bootstrap WP_Mock to initialize built-in features
// WP_Mock::activateStrictMode();
WP_Mock::bootstrap();
