<?php

if (!defined('ABSPATH')) exit;

/**
 * This function is responsible for returning an array of settings used for the license manager module.
 *
 * @return array An associative array containing the following keys:
 * - prefix: A string representing the prefix used for the plugin.
 * - get_base: A string representing the base name of the plugin.
 * - get_slug: A string representing the directory of the plugin.
 * - get_version: A string representing the version of the plugin.
 * - get_api: A string representing the API URL for checking updates.
 * - license_update_class: A string representing the class name for updating the license.
 */
function wsppc_updater_utility() {
    $prefix = 'WSPPC_';
    $settings = [
        'prefix' => $prefix,
        'get_base' => WSPPC_PLUGIN_BASENAME,
        'get_slug' => WSPPC_PLUGIN_DIR,
        'get_version' => WSPPC_BUILD,
        'get_api' => 'https://download.geekcodelab.com/',
        'license_update_class' => $prefix . 'Update_Checker'
    ];

    return $settings;
}

/**
 * This function is responsible for activating the plugin and refreshing transients related to updates.
 *
 * @return void
 *
 */
function wsppc_updater_activate() {

    // Refresh transients
    delete_site_transient('update_plugins');
    delete_transient('wsppc_plugin_updates');
    delete_transient('wsppc_plugin_auto_updates');
}

require_once(WSPPC_PATH . 'updater/class-update-checker.php');
    