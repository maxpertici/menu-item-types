<?php
/*
Plugin Name:  Menu Item Types
Plugin URI:   https://maxpertici.fr#menu-item-types
Description:  Use elements of a personalized type in the navigation menus.
Version:      1.5
Author:       @maxpertici
Author URI:   https://maxpertici.fr
Contributors:
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  menu-item-types
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or die();

use MXP\MITypes\App;

require_once( 'config.php' );
$loader = require __DIR__ . '/vendor/autoload.php';

$App = App::instance();
$App->createFromFile( __FILE__ );
$App->load();