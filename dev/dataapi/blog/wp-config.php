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
define( 'DB_NAME', 'lone9378_wp1' );

/** MySQL database username */
define( 'DB_USER', 'lone9378_wp1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'T.QXixKBHxIVNiMDakp34' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '7bBwqsFVeVyZ5iMvsFBUiniVEKterPbcSzssntcPvrbXgB9YL4CK54nrZedmhAnh');
define('SECURE_AUTH_KEY',  'IrCgily4I8zPgyoLn2bEq3kYpcynCjed8ijajreo63rlAExQoOa9qsh6zNtrtN90');
define('LOGGED_IN_KEY',    'lhnUkNsIIB1mkhyBqTHhjDqUpynI16OVessh95AuaFmWoSQUtfKyDrsZ6K07lv9h');
define('NONCE_KEY',        'UAREXqJNqEvttCkkasT2x8n5Gp74HZnWYHAzapPrUPTthM8m4aju5apZnUOTeSE3');
define('AUTH_SALT',        'q1SL4Vzcgksj6I3nmiMyGQedsiWmnNq3V0PEY4Pb5XCnZeJNB7TENBrcbxhlQ5We');
define('SECURE_AUTH_SALT', 'vw0FRARHGbRQnOvjZ7eZ7QVqf7uZcg28J8LIyWpWGDgNjw96jdifRl3yQmcsiL0T');
define('LOGGED_IN_SALT',   '9DKybqZQbLYeVtYugYUdXYgz1QfSqUDDyGa1wFaaoZ2PbOYlTyUBBSADcpxkZtMs');
define('NONCE_SALT',       'iMFZPuWP8YkJQ9W0WNJV4MT2o0ABAKQdYvKo5nGnwbmhyi4UP0pcScyMVPgE9MHE');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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