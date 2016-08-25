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
define('DB_NAME', 'beetube');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost:8080');

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
define('AUTH_KEY',         'ryY/!L{R;rv*&SE[9H,[CzA.{BP>dfwC(^xvv<SUw.l-:|&T&d;!&U}oghP-DDFF');
define('SECURE_AUTH_KEY',  'q]f?3~SFU!G,Oe1^an> }*)S{#Z3 bSC<SidvYyOl/Lk6E#JRSkTGX4x4ZLo[%3K');
define('LOGGED_IN_KEY',    '4.db@Qa!3eln33vma]X<{Op05$u` 9~BL)n9RFvtqNqT>kL*-IQmTC%Ne~EF]g$:');
define('NONCE_KEY',        '@RlukFpptmZSq{[{*>{S$WngO[@r;5}TO>sRnqLTg*)7!so$9K~(Q1l}$A[+8!C%');
define('AUTH_SALT',        'R3^(7)hFqc|]hud4Z$w%aC3pV=bxGcAYO!=/9ya^<6>rTl)D`!;- W9m7}:aVw1 ');
define('SECURE_AUTH_SALT', ':3!jfY[zl$_9FXUR=5bsUU7^apx|ChZJt#$9B*Q(C> kX?bV17LDKKKV(Oep-oyU');
define('LOGGED_IN_SALT',   '6TyW;0O{5)R>c!Frch5w>W=$HS2eGfuR@qajRFS&%co4fd||dfE<6HaROdQ`Xbn*');
define('NONCE_SALT',       '61SKdP~und!3|{Ev/+//8X68Gr_<fVBK4MIWe=NR)-%jytJ_Zaf-te9%G|cd[^qy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_beetube';

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
