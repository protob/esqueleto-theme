<div class="container">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			$post_title = get_the_title();
			$permalink  = get_the_permalink();
			?>
			<a
				class="d-block "
				href="<?php echo esc_url( $permalink ); ?>">
				<?php echo esc_html( $post_title ); ?>
			</a>
			<?php
		}
	}
	?>

</div>
