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
define('DB_NAME', 'manlook');

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
define('AUTH_KEY',         '[+&`8wOiog5*s&bH+SPs<&,UviWdcZjmn9lOxRJ(<xb2X=wvK<Yx=j(YOZq)}i3?');
define('SECURE_AUTH_KEY',  'wkX;Sk1EhqC#JGSPpncXeaaP#k$&++1bQK4QlpQSggD;PLhU.8Lf!R538a#=Sk /');
define('LOGGED_IN_KEY',    'e@#W=v9[tS(Jp8:B)Od&nw(5UZhsj5x<^0d!fgzv/-CX1FpC$-AU(hHhx[IZKE#:');
define('NONCE_KEY',        'i6Aw+UKZF 9qMVD00~!3^3_@$t5kL3$D;=~dJNE2|%4&nH B[Q(2?v`]TQR}GR:l');
define('AUTH_SALT',        '5hyNX_YM3mV9mV[*T#7_>udICbNtUqw|3NCa 1,=0~ca?3u8T<r_~T^3lFH=VJV5');
define('SECURE_AUTH_SALT', '/7;_vGax51TfP);(^r_Vfc=^>oCwl{,lJcg= #Z,YL8r >JR&#GA!TC>OBW8)Zs@');
define('LOGGED_IN_SALT',   '>k(gC2d8My.%jY{&j7z:AkpF+#u)^yB%i:D7dd88_8Aof(+t{^Vre8N?^`MvzxdX');
define('NONCE_SALT',       'y-]>~vm93~f3+4h=vjK@Su#I:)cT|w=mB|Imr@]ym~`ZpHQQD+pXq,L:NCqZa^(<');

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
