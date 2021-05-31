<?php 
$mobile_toggle_label = spawp_get_option('secondary_mobilebtn_label');
$nav_width = spawp_get_option('secondary_width');
$nav_inner_width = spawp_get_option('secondary_inner_width');
$nav_alignment = spawp_get_option('secondary_alignment');
$nav_dropdown = spawp_get_option('nav_dropdown');
$nav_direction = spawp_get_option('secondary_direction');

$navbar_nav_class = 'mr-auto';
if($nav_alignment=='right'){
  $navbar_nav_class = 'ml-auto';
}else if($nav_alignment=='center'){
  $navbar_nav_class = 'ml-auto mr-auto';
}

if($nav_dropdown=='hover'){
  $navbar_nav_class .= ' hover focus';
}else if($nav_dropdown=='focus'){
  $navbar_nav_class .= ' focus hover';
}

$navbar_nav_class .= ' direction-'.$nav_direction;
?>
<nav class="navbar navbar-expand-lg navbar-light navbar-header-wrap secondary_menu p-0 <?php if($nav_width=='container'){ echo 'grid-'.esc_attr($nav_width); } ?>">
  <div class="<?php if($nav_inner_width){ echo esc_attr($nav_inner_width); } ?> d-block">
    <div class="row align-items-center">
      <div class="col-xl-12 col-lg-12 col-12">
        <div class="collapse navbar-collapse" id="navbarSupportedContentSecondary">
          <?php if ( has_nav_menu( 'secondary' ) || ! has_nav_menu( 'expanded' ) ) { ?>
            <ul class="nav navbar-nav primary-menu <?php echo esc_attr($navbar_nav_class); ?>">
              <?php
                if ( has_nav_menu( 'secondary' ) ) {

                  wp_nav_menu(
                    array(
                      'container'  => '',
                      'items_wrap' => '%3$s',
                      'theme_location' => 'secondary',
                    )
                  );

                } elseif ( ! has_nav_menu( 'expanded' ) ) {

                  wp_list_pages(
                    array(
                      'match_menu_classes' => true,
                      'show_sub_menu_icons' => true,
                      'title_li' => false,
                      'walker'   => new SPAWP_Walker_Page(),
                    )
                  );

                }
                ?>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav><!-- .navbar -->
<div class="mobile_secondary_menu w-100">
  <div class="mobile_secondary_container">
    <header>
      <nav id="secondary">
        <?php 
        wp_nav_menu( array( 
          'theme_location' => 'secondary',
          'container' => '',
          'menu_class'=> '',
        ) );
        ?>
      </nav>
    </header>
  </div>
</div><!-- End .mobile_secondary_menu -->