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
define( 'DB_NAME', 'veenabki_blog' );

/** MySQL database username */
define( 'DB_USER', 'veenabki_dbuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'igD*]e!vYC{y' );

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
define( 'AUTH_KEY',         'YiS;@>7yA]2zw1nHu$v{7!j8BY/)2u_rf]r|}E8QXA79/ny#>3$0a,ZiDQOY)3EH' );
define( 'SECURE_AUTH_KEY',  'HJ@GsCH]7nh[o&!ALLsK+ZC+FlSSin%13Pl.c&a2lxU4caH:&2EwrTg;^^/|_CeT' );
define( 'LOGGED_IN_KEY',    'y&e>e*JkzB|E2Z=YO%a&`_}YCW>1OSd*sCK,^5^eSAE9OY2BBLGh&Y0[x@N><S(P' );
define( 'NONCE_KEY',        'wx9Pc`:Xwp1)qZ#WTBa`A?-2HHr8``|$&V>j@k5._rn5_)r[~R0Q!T7]||.;r-*c' );
define( 'AUTH_SALT',        '+5%((h54ME?wBp.;K7_NIsLEBip,6Rw+Gx|HYD22fU*.V]>8(|4>hx6&}^1yO|L_' );
define( 'SECURE_AUTH_SALT', '5s;p??q^{ CodG[~O0V.MWbUf[bwKl35(<s[C|nj= #*)+%:eJH44/wy8i d=(Fb' );
define( 'LOGGED_IN_SALT',   '@DotDDBp=9)5dZA~w6Qt#^N1tl@n#0XVkz4T=%M1_(BL[;3Z)e@eq?Lz(p)YrUF ' );
define( 'NONCE_SALT',       'PY~^O4]T=7UpJB9(M{Vt,,.NPUjUW7)iTU4VhxC1WkUQdeln=$3XYwUDmU-qrx g' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'vd_';

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
define( 'WP_DEBUG', false );

define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
