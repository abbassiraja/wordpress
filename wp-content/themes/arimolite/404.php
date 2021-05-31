<?php get_header(); ?>
<div class="main-contaier">
    <div class="container">
    	<div class="arimolite-page-error">
            <h1><?php echo esc_html__('404', 'arimolite'); ?></h1>
            <p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'arimolite' ); ?></p>
			<?php get_search_form(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
