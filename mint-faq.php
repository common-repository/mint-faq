<?php
/**
 * Plugin Name: Mint FAQ
 * Plugin URI: https://www.promptplugins.com/plugin/mint-faq/
 * Description: Build Beautiful Category based FAQ layouts
 * Version: 2.1
 * Requires at least: 5.3
 * Requires PHP: 5.6
 * Author: Prompt Plugins
 * Author URI: https://www.promptplugins.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mint-faq
 * Domain Path: /languages
 * 
 * @package mintfaq

  Mint FAQ is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  Mint FAQ is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Mint FAQ. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */
if (!defined("ABSPATH")) {
    exit;
}

/**
 * Define plugin version
 */
define("MINTFAQ_PLUGIN_VERSION", "2.1");

/**
 * Define plugin file constant
 */
define("MINTFAQ_PLUGIN_FILE", __FILE__);

/**
 * Define plugin basename
 */
define("MINTFAQ_PLUGIN_BASENAME", plugin_basename(__FILE__));

/**
 * Require install lib
 */
require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/functions.install.php");

/**
 * Require setup
 */
require_once(plugin_dir_path(MINTFAQ_PLUGIN_FILE) . "includes/class-mintfaq-setup.php");

/**
 * Activation/Deactivation hook
 */
register_activation_hook(MINTFAQ_PLUGIN_FILE, "mintfaq_install");
register_deactivation_hook(MINTFAQ_PLUGIN_FILE, "mintfaq_deactivate");

new Mintfaq_Setup();