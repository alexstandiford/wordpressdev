<?php // DO NOT EDIT THIS FILE! Please put customizations in the git-ignored wp-tests-config-local.php!
/**
 * WordPress test suite configuration file.
 *
 * @copyright 2019 Google LLC
 * @license   GNU General Public License, version 2
 * @link      https://github.com/GoogleChromeLabs/wordpressdev
 */

// Allow local environment to override config.
if ( file_exists( dirname( __FILE__ ) . '/wp-tests-config-local.php' ) ) {
	require dirname( __FILE__ ) . '/wp-tests-config-local.php';
} elseif ( file_exists( dirname( dirname( __FILE__ ) ) . '/wp-tests-config-local.php' ) ) {
	require dirname( dirname( __FILE__ ) ) . '/wp-tests-config-local.php';
}

// If testing core, run from 'build' directory. Otherwise, run from 'src' directory.
if ( ! defined( 'WP_TESTS_CORE_PATH_RELATIVE' ) ) {
	if ( defined( 'WP_RUN_CORE_TESTS' ) && WP_RUN_CORE_TESTS ) {
		define( 'WP_TESTS_CORE_PATH_RELATIVE', 'core-dev/build' );
	} else {
		define( 'WP_TESTS_CORE_PATH_RELATIVE', 'core-dev/src' );
	}
}

// Load custom functions.
require_once dirname( __FILE__ ) . '/functions.php';

/* Path to the WordPress codebase you'd like to test. Add a forward slash in the end. */
if ( defined( 'WP_RUN_CORE_TESTS' ) && WP_RUN_CORE_TESTS ) {
	_wordpressdev_set_directory_constants( WP_TESTS_CORE_PATH_RELATIVE, WP_TESTS_CORE_PATH_RELATIVE . '/wp-content' );
} else {
	_wordpressdev_set_directory_constants( WP_TESTS_CORE_PATH_RELATIVE );
}

// ** MySQL settings ** //

// This configuration file will be used by the copy of WordPress being tested.
// wordpress/wp-config.php will be ignored.

// WARNING WARNING WARNING!
// These tests will DROP ALL TABLES in the database with the prefix named below.
// DO NOT use a production database or one that is shared with something else.

$table_prefix = 'wptests_';   // Only numbers, letters, and underscores please!

// Define constants that haven't been overridden by wp-tests-config-local.php.
$constants = array(
	'DB_NAME'          => 'wordpress',
	'DB_USER'          => 'wordpress',
	'DB_PASSWORD'      => 'wordpress',
	'DB_HOST'          => 'database:3306',
	'DB_CHARSET'       => 'utf8',
	'DB_COLLATE'       => '',

	'AUTH_KEY'         => 'put your unique phrase here',
	'SECURE_AUTH_KEY'  => 'put your unique phrase here',
	'LOGGED_IN_KEY'    => 'put your unique phrase here',
	'NONCE_KEY'        => 'put your unique phrase here',
	'AUTH_SALT'        => 'put your unique phrase here',
	'SECURE_AUTH_SALT' => 'put your unique phrase here',
	'LOGGED_IN_SALT'   => 'put your unique phrase here',
	'NONCE_SALT'       => 'put your unique phrase here',

	'WP_TESTS_DOMAIN'  => 'example.org',
	'WP_TESTS_EMAIL'   => 'admin@example.org',
	'WP_TESTS_TITLE'   => 'Test Blog',
	'WP_HOME'          => 'http://example.org',

	/*
	 * Path to the theme to test with.
	 *
	 * The 'default' theme is symlinked from test/phpunit/data/themedir1/default into
	 * the themes directory of the WordPress installation defined above.
	 */
	'WP_DEFAULT_THEME' => 'default',

	// Test with WordPress debug mode (default).
	'WP_DEBUG'         => true,
	'WPLANG'           => '',
	'WP_PHP_BINARY'    => 'php',
);
foreach ( $constants as $constant_name => $constant_value ) {
	if ( ! defined( $constant_name ) ) {
		define( $constant_name, $constant_value );
	}
}
unset( $constants, $constant_name, $constant_value );

// Test with multisite enabled.
// Alternatively, use the tests/phpunit/multisite.xml configuration file.
// define( 'WP_TESTS_MULTISITE', true );

// Force known bugs to be run.
// Tests with an associated Trac ticket that is still open are normally skipped.
// define( 'WP_TESTS_FORCE_KNOWN_BUGS', true );

/* That's all, stop editing! Happy blogging. */

// Set 'WP_SITEURL' and 'WP_CONTENT_URL' based on 'WP_HOME'.
_wordpressdev_set_url_constants();
