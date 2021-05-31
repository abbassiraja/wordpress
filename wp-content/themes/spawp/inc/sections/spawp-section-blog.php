<?php 
$option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );
$section = 'blog';
$show = $option[$section.'_show'];
$subtitle = $option[$section.'_subtitle'];
$subtitle_color = '';
$section_title = $option[$section.'_title'];
$title_color = '';
$desc = $option[$section.'_desc'];
$desc_color = '';
$divider_show = $option[$section.'_divider_show'];
$divider_type = $option[$section.'_divider_type'];
$divider_width = $option[$section.'_divider_width'];
$container = $option[$section.'_container_width'];
$bg_color = isset($option[$section.'_bg_color'])?$option[$section.'_bg_color']:'';
$bg_image = isset($option[$section.'_bg_image'])?$option[$section.'_bg_image']:'';

$no_of_blog_to_display = $option[$section.'_no_to_show'];
$column_layout = $option[$section.'_column_layout'];
$category = $option[$section.'_category'];
$blog_orderby = $option[$section.'_orderby'];
$blog_order = $option[$section.'_order'];

$col = '';
if( $column_layout == 2){
  $col = 6;
}else if( $column_layout == 3){
  $col = 4;
}else if( $column_layout == 4){
  $col = 3;
}else{
  $col = 4;
}

$section_attributes = '';
$class = '';

if($bg_color && $bg_image==''){
    $section_attributes .= 'style="';
    $section_attributes .= 'background-color:'.$bg_color.';';
    $section_attributes .= '"';
}

if($bg_image){
    $section_attributes .= 'data-parallax="scroll" data-image-src="'.esc_url_raw($bg_image).'"';
    $class .= 'background_image overlay';
}

if($show){
?>
<section id="news" class="home_section news <?php echo esc_attr($class); ?>" <?php echo $section_attributes; ?>>
  <div class="<?php echo esc_attr($container); ?>">
    
    <?php do_action('spawp_frontpage_section_header',$subtitle,$subtitle_color,$section_title,$title_color,$desc,$desc_color,$divider_show,$divider_type,$divider_width); ?>
    
    <div class="row">
      <?php
      $args = array(
        'posts_per_page' => absint($no_of_blog_to_display),
        'post_status' => 'publish'
      );

      if ( $category > 0 ) {
          $args['category__in'] = array( $category );
      }
            
      if ( $blog_orderby && $blog_orderby != 'default' ) {
        $args['orderby'] = $blog_orderby;
      }

      if ( $blog_order) {
        $args['order'] = $blog_order;
      }

      $query = new WP_Query( $args );
      ?>
      
      <?php if ( $query->have_posts() ) : ?>
      
      <?php /* Start the Loop */ ?>
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <div class="col-xl-<?php echo esc_attr( $col ); ?> col-lg-<?php echo esc_attr( $col ); ?> col-md-6 col-12 wow zoomIn">
        <div class="news-box">
          <?php if( has_post_thumbnail() ): ?>
          <figure class="news-image m-0">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
          </figure>
          <?php endif; ?>

          <div class="inside-news">
            <div class="news-header">
              <div class="media">
                <figure class="news-author-image mr-2">
                  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" alt="<?php echo esc_attr(get_the_author_link());?>"></a>
                </figure>
                <div class="media-body">
                  <h6 class="news-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo get_the_author_link();?></a></h6>
                  <time class="news-date"><?php the_time( get_option('date_format') ); ?></time>
                </div>
              </div>
            </div>
            <div class="news-content">
              <h5 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <?php the_excerpt(); ?>
            </div> 
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section><!-- .news -->
<?php } ?>