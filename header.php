<?php
/**
 * The main header file.
 *
 * @package Esq
 * @since 1.0.0
 */

use Esq\Load;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
do_action( 'Esq/before_header' );

Load::organisms( 'header/header' );

do_action( 'Esq/after_header' );

