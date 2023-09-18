<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
if (getenv('ENVIRONMENT_STATE') === 'production') {
    define('DB_NAME', getenv('DB_NAME'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
    define('DB_HOST', getenv('DB_HOST'));
} else {
    // Local connection
    define('DB_NAME', 'joyapplicant_www');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'r00tr00t');
    define('DB_HOST', 'phpmyadmin.dev-local');
}

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'uF>xE4-v)5w$z|&)_%j~$ %}4o(L:ra;z>ct4FbD*)$4d<c(a/|&xW><Jvwnp;hV');
define('SECURE_AUTH_KEY',  'odEQ</?pRcl#L8o/[Uxd6+dA[,kWK:ad8yj_EXYz_ ?8OAa8t9<ZypIazmfEDdSR');
define('LOGGED_IN_KEY',    'XxwgAIa+;[m/AXH(Zgz*| sO-0Ttdlg*V!O]o@Oq$e?om458p`0d-NsLy+AEJPvD');
define('NONCE_KEY',        'L3383HtE5[ .za!eu!h)`&^JlhXdO4CA&7$Z>6V2:5,IY9O8wxl+Oxe/,2DDgU>@');
define('AUTH_SALT',        'D1 U(lEF)w|M,}_4Ed7iAmQ3PCOv^9Qc~%ZN/u/@V~=7|1woDnmjB0Q7r$91P976');
define('SECURE_AUTH_SALT', '9#K=9uf4w[I@~[Viw.j#SkN*rz8Q?&QB-|@z~rU_%K`R*`NAzxC#jLShGZjbhi2&');
define('LOGGED_IN_SALT',   '/Y~ss!0C5^KW+Be0oIw{/C73+b-4N[bj5z{H?v8tHz%dw e 4Q!}Yy2#tkPK.&+w');
define('NONCE_SALT',       ']PkgVdnHe.XKe?<G8!Hq64q^-iFklKdl&R!2Sg|Sui~AXpaewmKh%5fY=Ej~[alF');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ja_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
