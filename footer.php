<?php
/**
 * The template for displaying the footer.
 *
 * @package Esq
 * @since 1.0.0
 */

use Esq\Load;

do_action( 'Esq/before_footer' );

$copyright = 'Copyright %YEAR%';

Load::organisms(
	'footer/footer',
	[
		'copyright' => $copyright,
	]
);

wp_footer();
?>

</body>
</html>
