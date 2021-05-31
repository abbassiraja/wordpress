<?php
class Spawp_Section_plus extends WP_Customize_Section {

    public $type = 'spawp-upsale';

    public $plus_text = '';

    public $plus_url = '';

    public $id = '';
  
    public function json() {
        $json = parent::json();
        $json['plus_text'] = $this->plus_text;
        $json['plus_url']  = esc_url( $this->plus_url );
        $json['id'] = $this->id;
        return $json;
    }

    protected function render_template() { ?>

        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

            <h3 class="accordion-section-title">
                {{ data.title }}

                <# if ( data.plus_text && data.plus_url ) { #>
                    <a href="{{ data.plus_url }}" class="button button-secondary alignright" target="_blank">{{ data.plus_text }}</a>
                <# } #>
            </h3>
        </li>
    <?php }
}

class Spawp_Button_Customize_Control extends WP_Customize_Control {
    public $type = 'upgrade_premium_buttons';

    public function enqueue() {
        wp_enqueue_style(
            'spawp-additional-controls',
            get_template_directory_uri() . '/inc/customizer/customizer-base/css/additional-controls.css',
            array( 'wp-color-picker' )
        );
    }

    function render_content() {
        $support_url = '';
        if( ! class_exists('Spawp_Premium_Theme_Setup') ){
            $support_url = 'https://wordpress.org/support/theme/spawp/';
        }else{
            $support_url = 'https://www.britetechs.com/support/';
        }
    ?>
        <div class="upgrade_premium_buttons_info">
            <ul>
                <?php if( ! class_exists('Spawp_Premium_Theme_Setup') ){ ?>
                <li><a href="<?php echo esc_url( admin_url('themes.php?page=bt_themepage&tab=free_vs_pro') ); ?>" target="_blank"><i class="dashicons dashicons-list-view"></i><?php _e( 'Premium Features','spawp' ); ?> </a></li>
                <?php } ?>

                <li><a href="<?php echo esc_url( $support_url ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php _e( 'Get Support','spawp' ); ?> </a></li>

                <?php if( ! class_exists('Spawp_Premium_Theme_Setup') ){ ?>
                <li><a href="<?php echo esc_url('https://www.britetechs.com/spawp-premium-wordpress-theme/'); ?>" target="_blank"><i class="dashicons dashicons-update-alt"></i><?php _e( 'Upgrade to PRO','spawp' ); ?> </a></li>
                <?php } ?>

                <li><a href="<?php echo esc_url('https://wordpress.org/support/theme/spawp/reviews/#new-post'); ?>" target="_blank"><i class="dashicons dashicons-smiley"></i><?php _e( 'Love it','spawp' ); ?> </a></li>
            </ul>
        </div>
    <?php
   }
}


class SPAWP_Customize_Upgrade_Control extends WP_Customize_Control {

    public $type = 'spawp-upgrade';

    protected function content_template() {
        $link = 'https://www.britetechs.com/spawp-premium-wordpress-theme/';
        ?>
        <div class="spawp-upgrade-premium-message" style="display:none;">
            <# if ( data.label ) { #><h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="'.$link.'" target="_blank" > Spawp Premium </a> addon plugin to add', 'spawp'); ?> {{{ data.label }}} <?php esc_html_e( 'and get the more advanced premium styling features.', 'spawp') ?></h4><# } #>
        </div>
        <?php
    }
}