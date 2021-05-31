<?php 
$ft_width = spawp_get_option('footer_width');
$ft_inner_width = spawp_get_option('footer_inner_width');
$ft_bar_alignment = spawp_get_option('footer_bar_alignment');

$option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );

if( class_exists('Spawp_Premium_Theme_Setup') || isset($option['footer_copyright']) && $option['footer_copyright']!='' ){
  $ft_copyright = $option['footer_copyright'];
}else{
  $ft_copyright = sprintf( __( 'Copyright %1$s %2$s %3$s <span>&ndash;</span>', 'spawp' ), '&copy;', esc_attr( date( 'Y' ) ), esc_attr( get_bloginfo() ) );
  $ft_copyright .= sprintf( __( ' %1$s theme by %2$s', 'spawp' ), '<a href="' . esc_url( 'https://www.britetechs.com/themes/', 'spawp' ) . '">Spawp</a>', 'Britetechs' );
}

$options = array(
	'%current_year%',
	'%copy%'
);

$replace = array(
	date('Y'),
	'&copy;'
);

$copyright = str_replace( $options, $replace, $ft_copyright );
?>
<div class="copyright__wrap wow bounceInUp <?php if($ft_width=='container'){ echo 'grid-'.esc_attr($ft_width); } ?>">
  <div class="<?php if($ft_inner_width){ echo esc_attr($ft_inner_width); } ?> inside-copyright">
    <div class="row align-items-center">
      <div class="col-lg-12 col-md-12 col-12 <?php if($ft_bar_alignment){ echo 'text-'.esc_attr($ft_bar_alignment); } ?>">
        <p class="pb-0"><?php echo do_shortcode( $copyright ); ?></p>
      </div>
    </div>
  </div>
</div><!-- .footer__wrap -->