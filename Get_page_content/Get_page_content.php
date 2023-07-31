<?php

$hero = new WP_Query( array( 'pagename' => 'accueil' ) );
if( $hero->have_posts() ) : $hero->the_post();?>
    <h1 class="text-2xl lg:text-7xl md:max-w-7xl text-right font-bold md:leading-[96px] ">
     <?php the_content(); ?>
  </h1>    
<?php
    endif;
wp_reset_postdata();
  ?>