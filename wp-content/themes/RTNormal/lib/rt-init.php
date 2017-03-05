<?php
define('NO_THUMB_IMG', get_stylesheet_directory_uri().'/images/custom/no_thumb.png');

/**
 * Load GTID admin settings
 */
require_once('rt-options.php');

/**
 * Load GTID functions
 */
require_once('rt-functions.php');

/** * Load GTID widgets */
require_once('widgets/rt-image-ad.php');
require_once('widgets/rt-support.php');
require_once('widgets/rt-product-slider.php');
require_once('widgets/rt-fblikebox.php');
require_once('widgets/rt-video-widget.php');
require_once('widgets/rt-image-slider-widget.php');
// Load Custom Login
require_once('rt-customlogin.php');

?>