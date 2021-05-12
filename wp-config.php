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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'webstone' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=Gi* DW#5y,-%/O!)`BJ>N$gDdD![|ArlsX3:X.)qum&1EZg#w7-N@al$UW[1n1:' );
define( 'SECURE_AUTH_KEY',  'FPC=-ozzU5K%R$)N|5P%K)_j7.[O6!G0oYh%3ay Ff>7#!m KuZ7A-KAK,G#iB{S' );
define( 'LOGGED_IN_KEY',    '[pEzxk@lg1YR}~+Wk7E2eDT)W/R<} YR&blQ+Mz=zJz6zqM/$tA2emqNpm[@#SEh' );
define( 'NONCE_KEY',        '#<N(3HqA1j3e0tgXv`E~T He5B1ho[(i9NFxPIe[fa_x~-LAVs{LgILtjV1%e[O/' );
define( 'AUTH_SALT',        'ZHzOL/F?_a(w8.rRsNbmE^]`qxa`;On) tt|Q=Oq:}~kr_IVbVS!2Z0^rkD,Fy6?' );
define( 'SECURE_AUTH_SALT', 'o~S<:z j+-K7<nkKUQ/j2M0j&2+c8{oCSR{P,9-I%0jB*$Xz=&-5t}dGJ>]%Ba7 ' );
define( 'LOGGED_IN_SALT',   'QMJVHHmt4fScr?~d)<u-5hs,D8Z@rgICTik@S#_8K8[D:,j;f}es6nb+&S?2S~yQ' );
define( 'NONCE_SALT',       'i4pqvuc7Sc-xHdXA|&Id2<:SLd1NTj5&rE8}1;h{Bkf:jRU5Y`}^p(gEipScgsK ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
