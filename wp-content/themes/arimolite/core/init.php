<?php

if ( function_exists('arimolite_require_file') )
{
    # Load Classes
    arimolite_require_file( ARIMOLITE_CORE_CLASSES . 'class-tgm-plugin-activation.php' );
    
    # Load Functions
    arimolite_require_file( ARIMOLITE_CORE_FUNCTIONS . 'customizer/arimolite_custom_controll.php' );
    arimolite_require_file( ARIMOLITE_CORE_FUNCTIONS . 'customizer/arimolite_customizer_settings.php' );
    arimolite_require_file( ARIMOLITE_CORE_FUNCTIONS . 'customizer/arimolite_customizer_style.php' );
    arimolite_require_file( ARIMOLITE_CORE_FUNCTIONS . 'arimolite_resize_image.php' );    
}
