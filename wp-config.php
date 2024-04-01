<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'custom_plugin' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'a$|{DCu+LU|CPF+6@6@_iPqtx:pNxGM6gC1o^c9$*aV1^%O3Ud< Qs|&)x#R25}y' );
define( 'SECURE_AUTH_KEY',  '5n`(`bF}^JZDKKfQ#P7BDAz~4#HF,UkE@K=)DPC+77SB^f7/JiqOQl2[Cr[Cr*Vw' );
define( 'LOGGED_IN_KEY',    '/]iVtCu[}<eHIb:hVH1=Xq:~LO%`FILX9_fkRG5s*mQ[Z>~q=w,^~!?#_&l`|-w(' );
define( 'NONCE_KEY',        '85r,Wxk4(FmNL@A A 0yP&&_RH|`_Z8:>L0Z(Wg#N+RY31oW/.+C4S!<Z!?cjL@n' );
define( 'AUTH_SALT',        'VJ=+yTx!,]BmI{XRAW6ERm?gJ956WX16MzDEwJ)U+!YT%JBV439vqjK-B{9`!Gi_' );
define( 'SECURE_AUTH_SALT', 'D8``>2K[{A%}5 w<.iS{#}*Sv;bJBpTmv?nZoRIc>3nP7z]rVm3z17}eIs klOJs' );
define( 'LOGGED_IN_SALT',   'Tjv8hmVq <%D F ;43ku;^@(?Qc }8YKsvqqMY8Zz)U+O2j6yC9%+G*moG]&Ff;j' );
define( 'NONCE_SALT',       ',7I`d?XaevqEFvkMZ7[yv.Skw5VJLT+0OGXgKFU)?!SZg3?d? 5s>gX;,yXyp>U2' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
