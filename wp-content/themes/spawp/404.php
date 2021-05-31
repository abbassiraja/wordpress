<?php 
get_header(); 
spawp_breadcrumbs(); ?>

<section class="error-page">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <h2 class="error-title"><?php _e('404','spawp'); ?></h2>
        <h3><?php _e('oh no! page not found','spawp'); ?></h3>
        <p><?php _e('The page you are looking for isn`t available, Try your search again or use the Go Home button below','spawp'); ?></p>
        <a class="more-link button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Go Home','spawp'); ?></a>
      </div>                   
    </div>
  </div>
</section>

<?php get_footer(); ?>