<?php
use Esq\Backend;

// Constants.
define( 'Esqueleto_THEME_VERSION', '1.0.0' );
define( 'Esqueleto_MINIMUM_WP_VERSION', '5.2.1' );


require_once __DIR__ . '/utils/loader/Load.php';
require_once __DIR__ . '/utils/assets/Assets.php';
require_once __DIR__ . '/ThemeSetup.php';
require_once __DIR__ . '/backend/Backend.php';
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



