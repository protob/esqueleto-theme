<nav class=" navbar ">


	<div  id="navbarNav">

		<?php
		wp_nav_menu(
			[
				'theme_location' => 'main_menu',
				'container'      => 'ul',
				'menu_class'     => 'navbar-nav',
			]
		);
		?>

	</div>

</nav>
