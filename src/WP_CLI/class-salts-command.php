<?php

use \WP_CLI;
use \WP_CLI_Command;
use Salaros\WordPress\Salts_Generator;

/**
* Manage salts via WP CLI.
*/
class Salts_Command extends WP_CLI_Command {

	/**
	* Generates salts to STDOUT or to a file.
	*
	* ## OPTIONS
	*
	* [--file=<file>]
	* : The name of the file to write to. Default outputs to STDOUT.
	*
	* [--format=<format>]
	* : Can be php, yaml or env. Defaults to php.
	*
	* @when before_wp_load
	* @synopsis [--file=<foo>] [--format=<php,yaml,env>]
	*
	*/
	function generate( $args, $assoc_args ) {
		$defaults = array(
			'format' => 'php',
		);
		$assoc_args = array_merge( $defaults, $assoc_args );

		$salts_data = self::generate_salts();
		$output = self::format_data( $salts_data, $assoc_args['format'] );

		if ( isset( $assoc_args['file'] ) ) {

			$file = (string) $assoc_args['file'];

			if ( file_exists( $file ) && ! is_writable( $file ) ) {
				WP_CLI::error( 'File is not writable or path is not correct: ' . $file );
			}

			$file_flags = ( file_exists( $file ) ) ? FILE_APPEND : 0;
			if ( ! file_put_contents( $file, $output, $file_flags ) ) {
				WP_CLI::error( 'Could not write salts to: ' . $file );
			}

			WP_CLI::success( 'Added salts to: ' . $file );
			return;
		}

		fwrite( STDOUT, $output );
	}
}

WP_CLI::add_command( 'salts', 'Salts_Command' );