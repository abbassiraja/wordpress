<?php 
$is_topbar = spawp_get_option('topbar_show');
$tb_width = spawp_get_option('topbar_width');
$tb_inner_width = spawp_get_option('topbar_inner_width');
$tb_alignment = spawp_get_option('topbar_alignment');
$tb_office_time = spawp_get_option('topbar_office_time');
$tb_email = spawp_get_option('topbar_email');
$tb_phone = spawp_get_option('topbar_phone');

$items = array();
$items = spawp_get_option('topbar_icons');
if(!$items && class_exists('Spawp_Premium_Theme_Setup') ){
  $items = spwp_social_icons_default_contents();
}

if(is_string($items)){
  $items = json_decode($items);
}

if($is_topbar){
?>
<div class="top_header__wrap <?php if($tb_width=='container'){ echo 'grid-'.esc_attr($tb_width); } ?>">
  <div class="<?php if($tb_inner_width){ echo esc_attr($tb_inner_width); } ?> inside-top-bar">
    <div class="row align-items-center <?php if($tb_alignment){ echo 'text-md-'.esc_attr($tb_alignment); } ?> text-center">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <?php if($tb_office_time || $tb_email || $tb_phone){ ?>
        <ul class="header_info">
          <?php if($tb_office_time){ ?>
          <li><i class="fa fa-clock-o"></i> <?php echo esc_html($tb_office_time); ?></li>
          <?php } ?>

          <?php if($tb_email){ ?>
          <li><a href="<?php echo 'mailto:'.esc_attr($tb_email); ?>"><i class="fa fa-envelope-o"></i> <?php echo esc_html($tb_email); ?></a></li>
          <?php } ?>

          <?php if($tb_phone){ ?>
          <li><a href="<?php echo 'tel:'.esc_attr($tb_phone); ?>"><i class="fa fa-phone"></i> <?php echo esc_html($tb_phone); ?></a></li>
          <?php } ?>
        </ul>
        <?php } ?>

        <?php if( !empty($items) ){ ?>
        <ul class="social_icons m-0">
          <?php foreach ($items as $key => $item) { 
                $social_link = ! empty( $item->link ) ? $item->link : '#';
                $icon_value = ! empty( $item->icon_value ) ? $item->icon_value : '#';
            ?>
          <li><a href="<?php echo esc_url($social_link); ?>"><i class="fa <?php echo esc_attr($icon_value); ?>"></i></a></li>
          <?php } ?>
        </ul>
        <?php } ?>        
      </div>
    </div>
  </div>
</div><!-- .top_header__wrap -->
<?php } ?>