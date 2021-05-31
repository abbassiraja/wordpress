<?php 
    do_action( 'spawp_before_footer' ); 

    do_action( 'spawp_footer' );

    do_action( 'spawp_after_footer' );

    do_action( 'spawp_after_wrap' );
    ?>
  </div><!-- .wrapper -->
  
  <?php 
  do_action( 'spawp_after_outer_wrap' ); 
  get_template_part( 'partials/back-to-top' );
  wp_footer(); ?>
  </body>
</html>