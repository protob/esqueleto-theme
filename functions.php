<?php
use Esq\Backend;

// Constants.
define( 'ESQUELETO_THEME_VERSION', '1.0.0' );
define( 'ESQUELETO_MINIMUM_WP_VERSION', '5.2.1' );

require_once __DIR__ . '/utils/loader/Load.php';
require_once __DIR__ . '/utils/assets/Assets.php';

// require_once __DIR__ . '/utils/wp-acf/Acf.php';
require_once __DIR__ . '/utils/wp-taxonomy/Taxonomy.php';
require_once __DIR__ . '/utils/wp-widgets/Register.php';
require_once __DIR__ . '/utils/custom-post-types/Cpt.php';
require_once __DIR__ . '/utils/wp-endpoints/AbstractEndpoint.php';


require_once __DIR__ . '/backend/Backend.php';


require_once __DIR__ . '/ThemeSetup.php';

ThemeSetup::init();
Backend::init();


// Run the theme setup.
add_filter(
    'loader_directories',
    function ( $directories ) {
        $directories[] = get_template_directory() . '/frontend/components';
        return $directories;
    }
);

add_filter(
    'loader_alias',
    function ( $alias ) {
        $alias['atom']     = 'atoms';
        $alias['molecule'] = 'molecules';
        $alias['organism'] = 'organisms';
        $alias['template'] = 'templates';

        return $alias;
    }
);


/**
 * Escapes same as wp_kses_post() but also inline SVG and image srcset.
 */
$allow_all_post_tags = array_merge(
	wp_kses_allowed_html( 'post' ),
	[
		'svg'      => [
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		],
		'g'        => [
			'fill' => true,
		],
		'title'    => [
			'title' => true,
		],
		'path'     => [
			'd'            => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		],
		'polyline' => [
			'd'            => true,
			'fill'         => true,
			'points'       => true,
			'stroke'       => true,
			'stroke-width' => true,
		],
		'img'      => [
			'class'  => true,
			'src'    => true,
			'alt'    => true,
			'srcset' => true,
			'sizes'  => true,
		],
	]
);
/**
 * For escaping ACF text areas.
 */
$allow_break_tag = [
	'br' => '',
];
