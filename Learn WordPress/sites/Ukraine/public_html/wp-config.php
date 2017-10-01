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
define('DB_NAME', 'z97198z9_wp');

/** MySQL database username */
define('DB_USER', 'z97198z9_wp');

/** MySQL database password */
define('DB_PASSWORD', '19kolja12');

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
define('AUTH_KEY',         'uEL,mj;l[IhrpE+m8mS^^ s(V{Qg-${0xDVQM/Zss|O>g_M{pbTFE<&D6gE2SfP&');
define('SECURE_AUTH_KEY',  '%WOYt`J2t)`E[PjWYTFx>&w!B/Z9B=nGIDw8*+qrTWqe[t(1VO{NF$ALSX:+nz,2');
define('LOGGED_IN_KEY',    '><kOlGHCF]4lE[814GuEF@8k:n:Tz Yeu;IB?<B:$*gMsa(j3q<2]Y6LV?[nyj4(');
define('NONCE_KEY',        'fMW|nO){qM74.cKV/+k2KA~=wzkP@3)ZclP/2dIHf)_^b.nS]r3tkv*a[U}yGDQ/');
define('AUTH_SALT',        '-lo5lob2sAp7AW{lF5F)3AHD]oPHE*TJuKb50I]FWUq{qV`urWZ7meKZj5,;hsnz');
define('SECURE_AUTH_SALT', '`m6EOTd-&B!^]t/}1Y]]@*Z5/7g5]+)@@u@fa6$})&o,2x`ko-E|.0e(MVLZS.AQ');
define('LOGGED_IN_SALT',   ':Q60cD2C%AJ!)$m%q,aeK;R?54a}(b8hnxgPtjt7C5})Zs2@tP%E6]Hh[2bFZGJq');
define('NONCE_SALT',       'zX!i%*SBq:z`]T^wO:?:#Y_B1Qd:&![/GQSovU O??fT,eEklP6V+EwL&EV#3T}a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
