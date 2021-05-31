<?php 
$ft_width = spawp_get_option('footer_width');
$ft_inner_width = spawp_get_option('footer_inner_width');
$ft_widget_setting = spawp_get_footer_widgets_layout();

if($ft_widget_setting==0){
  retun;
}

$col = '';
switch ($ft_widget_setting) {
  case 1:
    $col = 'col-lg-12 col-md-12 col-sm-12';
    break;

  case 2:
    $col = 'col-lg-6 col-md-6 col-sm-6';
    break;

  case 3:
    $col = 'col-lg-4 col-md-4 col-sm-6';
    break;
  
  default:
    $col = 'col-lg-3 col-md-3 col-sm-6';
    break;
}
?>
<div id="footer" class="footer__wrap <?php if($ft_width=='container'){ echo 'grid-'.esc_attr($ft_width); } ?>">
  <div class="<?php if($ft_inner_width){ echo esc_attr($ft_inner_width); } ?> inside-footer-widgets">
    <div class="row">
      <?php $duration_time = 1; for ($i=1; $i <= $ft_widget_setting; $i++) { $duration_time = .5 + $duration_time; ?>
      <div class="<?php echo esc_attr($col); ?> wow bounceInUp" data-wow-duration="<?php echo esc_attr($duration_time); ?>s">
        <?php 
        if ( is_active_sidebar( 'footer-'.$i ) ) {
          dynamic_sidebar( 'footer-'.$i );
        } 
        ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div><!-- .footer__wrap -->