<?php

/**
 * Plugin Name:       Webhooks Manager
 * Plugin URI:        https://github.com/helsingborg-stad/webhooks-manager
 * Description:       Create and manage webhooks from WordPress action hooks
 * Version: 1.2.0
 * Author:            Thor Brink @ Helsingborg Stad
 * Author URI:        https://github.com/helsingborg-stad
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       webhooks-manager
 * Domain Path:       /languages
 */

// Protect agains direct file access
if (!defined('WPINC')) {
    die;
}

define('WEBHOOKS_MANAGER_PATH', plugin_dir_path(__FILE__));
define('WEBHOOKS_MANAGER_URL', plugins_url('', __FILE__));
define('WEBHOOKS_MANAGER_TEMPLATE_PATH', WEBHOOKS_MANAGER_PATH . 'templates/');

require_once WEBHOOKS_MANAGER_PATH . 'Public.php';

// Register the autoloader
if (file_exists(WEBHOOKS_MANAGER_PATH . 'vendor/autoload.php')) {
    require WEBHOOKS_MANAGER_PATH . '/vendor/autoload.php';
}

// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('webhooks-manager');
    $acfExportManager->setExportFolder(WEBHOOKS_MANAGER_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'webhooks' => 'group_6565af01867da',
    ));

    $acfExportManager->import();
});

// Start application
$plugin = new WebhooksManager\Plugin();
$plugin->initialize();

add_action('plugins_loaded', function () {
    load_plugin_textdomain('webhooks-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');
});
