<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ducphat');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_SITEURL', 'http://localhost/ducphat/'); // tên domain ở cuối ko có dấu /
define('WP_HOME', 'http://localhost/ducphat/'); // tên domain ở cuối ko có dấu /

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k,Q{sED k_keBKr-_GRj|a-ol~+kQ.2i{G^|YLEwVa^i~eX/-A);l8_z1=!lNrm^');
define('SECURE_AUTH_KEY',  'B9VX_2w_:A=XglG3r VA]0t)KVY$N/Ra--.|6c/I]7DnG~j>#k9m-/-+uMI+I:/y');
define('LOGGED_IN_KEY',    'zJZ<Q.Qi|656&vJAsZ^B;c38<6<@xnMz,>DT]m>d:[#{TTK-:K)2)?9zO|3nBHMX');
define('NONCE_KEY',        '2] %mHv5qier^5^}hc[var{v_hVkuw&5;x7}O&Ec>jp~4x`l:@+t9a#T^e^F2%$`');
define('AUTH_SALT',        '|eJ{-fQBTmQ`Z R~{M_Y8v1om{  }x4b ~yNC~P[!:Eew68JTp>*g/w0tt**wgC|');
define('SECURE_AUTH_SALT', '+CzFkP-P;;|{TIX,`,6!(TWC O[F} )j9J*=+o:T0C*P$wj:z  5|YNE@;i? Q,k');
define('LOGGED_IN_SALT',   '+(Q%l/IdOp5z!V54&(mk><gDe2H.Iw^Kw!&0(F&8 H(umXqEKb-3KLJwZ3Qi! `)');
define('NONCE_SALT',       'UhSOz`dvv*/BBVQf-prW^D<.[sHbc#`Ks.l>NGJ%12<~PE4y]-]%F$b},6w Ahev');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rt_';

define( 'WP_POST_REVISIONS', 1 );

define('DISALLOW_FILE_EDIT',true);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'vi');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
