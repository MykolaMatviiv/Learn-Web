<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wshop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sF|Yht kH`S!3Kccq5l-)h9^cF*R?m,5j$iG$=F]gP!DlICHSYLnPFLZq}qEoL.]');
define('SECURE_AUTH_KEY',  ':u-bn/vA`(yr.K?1WtEYp=O1l}+~AXe`=dd|GsJr[@c.;(~/5LXPH_[`hSI21O*D');
define('LOGGED_IN_KEY',    'F%%hV&BI8` zcac42@T2jsd9?Q7ZqZ:xI>U]a.~5}C6K]/wUC@@K;3gHA/KpzAd$');
define('NONCE_KEY',        'Iy78}|b-{9vi_vF:rI/A[+CvXz@s96c4?ne/fz!_n_VLpsvC|+xn*mavkGc`Q/6R');
define('AUTH_SALT',        ';tE-p7rd;Z*)a9&+Su1.p8XQmX]NY,CU-_XSY~Iwy!^Z[h96/web[_KIyQpZM[MX');
define('SECURE_AUTH_SALT', '9qSw*?~bRz&]8}ILou1Rw+]BM@~mVA2n<a5:Pt#htVuV]YI(MJM@1ZCCx3:HmImI');
define('LOGGED_IN_SALT',   '[8H|Px~XCm2mfm^/q$]:>v^MFD=;i v}=JK8Q:UzJgU!{T|Q]//o=`^3DQQ{9YZ^');
define('NONCE_SALT',       'ma7wvqg-Mb|HJ-X.{+5$2_[Y1{.exsDTJP,Vcljj@FA:Uihqr%i:q gJ+lGzC*u ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bgte_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
