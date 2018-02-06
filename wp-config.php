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
define('DB_NAME', 'db_elite');

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
define('AUTH_KEY',         'yWMW=-,T&LY&aLZD.5KCEPTye.:>4gSU=8b$pJ/<4Y[G*%NPc2Q5MZflDNHr>}i@');
define('SECURE_AUTH_KEY',  '[Jjt|:c}COj*`YYE*rVba~o@_+j?m%w=XxZ9C@ue|)8)!{x0cx!GC8:9$M}HZJui');
define('LOGGED_IN_KEY',    'yBaoa]YbWtx0oV%_VHr1O.]MBgRmryki4SE=6FOu3x:K3V5vUI@Lx|B}y}as.])F');
define('NONCE_KEY',        'g}RbDWJJqS/_a2(:{@[(;j]O,yfU$on4|mvXmB}5B0{+5N/NPjTjH|Lt*~]9qoP(');
define('AUTH_SALT',        ']UTM_@*$@Ugm 9L[9k2BJ,3NLNLDdOxy;4lTms&o$lw0zZb6!qD5vkihz+U=u9vx');
define('SECURE_AUTH_SALT', '{obEN&@Iw4PQnxQ9f{n3L`_|c)RxP(&bLCne@gU@QM;WQl2LDaiP^aT,h~a#Sy3D');
define('LOGGED_IN_SALT',   'o!@?KLDVxYBhKL/M)LtUg_ P(<*=lHd,4&3~kjgMWG7yx(7bvl,u8]xvNh1DDo}m');
define('NONCE_SALT',       './q.qX.HAW>hvZxv)`!vVCU/,}fa1B/XI PnC-L8PUN.:uXsd`5uEi):ei:p&=`[');

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
