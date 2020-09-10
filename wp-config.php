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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         ';d-}_ C {l%0< >/xPNI}x}rzkqkv{f5Ez(<:(C.uY6@p[.cVHoT8Y*kNhx*.zia' );
define( 'SECURE_AUTH_KEY',  '~[Ei@9fE8*=vm$au[wVZtBSh8hj!8)0m3%<8vTCZasKA^y0=0<)T/h$sR9=7Vpns' );
define( 'LOGGED_IN_KEY',    ']=;~vnjP,b= :_m>DhlY-KXTtYF;:+rc;azw|A@KN,<Ymh,{s#TF4w&+^X]$Th35' );
define( 'NONCE_KEY',        '(p)#Bv}C[5Yb(])n<gM96DxbT.]8LL9FKM8IUO> HgBYqQZAD)c/5_W&ptf6~T_d' );
define( 'AUTH_SALT',        'T%&5c%>O^^8y.`.c(PwIXqhhSq9IQ(Ys.OP$ 1?^h(Z9^#R.rkzE3qG$vr0f6 Ko' );
define( 'SECURE_AUTH_SALT', '}64n/6e5Fe(esYuNwvmi~Qhm(je~Moz|r$E~z})Mk?J1W@u %md24JfMbNs[Rte$' );
define( 'LOGGED_IN_SALT',   '|g0ITKH>j-J18r.:i>`XY7S$r%5y+<z$<a?axyzSsk~Z{tT)J~#q2eu$B:Ev@E5U' );
define( 'NONCE_SALT',       'z!C+Dr23+~q6C[-&W#s[l|lv=F$qeax7s<MVn%>7Sc@V96ko=Fz 4rC&*e=yOR`H' );

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
