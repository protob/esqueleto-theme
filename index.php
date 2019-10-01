<?php

use Esq\Load;


get_header();

Load::template( 'posts/archive' );
Load::molecule( 'examples/vue-example' );

get_footer();
