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
define( 'DB_NAME', 'wp' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Q.WAr0}C+j+#hpwaevpFX W_W$cT+FSu}V<~Q/iXKGfTx}*%OO|Vkp!Dce{?d ~v' );
define( 'SECURE_AUTH_KEY',  '-9$Jj_A}+x}G/qIg7o6LBA z)aKId2Z!uP3 ,NnNU`72%tOc-K>$VwQad<E-vj.{' );
define( 'LOGGED_IN_KEY',    '- ,F*p/!&aKXY}+m?h=W[QkCD-94sF?%lA7qv,dqy+$yfU,`v?D)R>^>C9qIG#%z' );
define( 'NONCE_KEY',        '5V{9O]6&?6EjOK1e_Q6GV=WPrIiLdhAglcr|AS()**C&$SZ/Z#qJCt$Yi$u=-n@W' );
define( 'AUTH_SALT',        'M?*x]vxFe,hTi!=+#ACF|Gsy:HFzr{2`e,B}?/o!]frabX6_tHyLKp:T,sX`DevK' );
define( 'SECURE_AUTH_SALT', 'h|fGSJ C/7kysRw39)6{m[Z}bp8fEB.SnE,mJ.*LCnnwlrGG`N]RHk#[b!b5D.~?' );
define( 'LOGGED_IN_SALT',   'I(`23 loCdNpOx[n.x AGc?CuE8c%<=SplV7|0@U0[}sRTcNAEgWbqrg7,RR9cS]' );
define( 'NONCE_SALT',       '>XI)kB k$-LNm.GE]D.nc,!_X6+R]o|JCCNN2SsRI+N`2m%*]ad!T)bbf-6YP4(~' );

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
