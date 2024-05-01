<?php

namespace DT\Home\Providers;

use function DT\Home\namespace_string;
use function DT\Home\plugin_url;
use function DT\Home\route_url;

class AssetServiceProvider extends ServiceProvider {

	public function register(): void{
		add_filter( namespace_string( 'allowed_styles' ), function ( $allowed_css ) {
			$allowed_css[] = 'dt-home';
			return $allowed_css;
		} );

		add_filter( namespace_string( 'allowed_scripts' ), function ( $allowed_js ) {
			$allowed_js[] = 'dt-home';
			return $allowed_js;
		} );

		add_filter( namespace_string( 'javascript_globals' ), function ( $data ) {
			return array_merge($data, [
				'nonce'        => wp_create_nonce( 'dt_home' ),
				'admin_nonce' => wp_create_nonce( 'dt_admin_form_nonce' ),
				'route_url'    => route_url(),
			]);
		});
	}
	public function boot(): void{
		// TODO: Implement boot() method.
	}
}
