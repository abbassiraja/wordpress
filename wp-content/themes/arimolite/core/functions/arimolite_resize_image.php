<?php
/**
 * @author AZ-Theme
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @param bool $place_hold  Using place hold image if the image does not exist
 * @since 1.0
 * @return array
 */
function arimolite_resize_image( $attach_id = null, $img_url = null, $width, $height, $crop = false, $place_hold = true )
{
	// this is an attachment, so we have the ID
	$image_src = array();
	if ( $attach_id ) {
		$image_src			= wp_get_attachment_image_src( $attach_id, 'full' );
		$actual_file_path 	= get_attached_file( $attach_id );
		// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		$file_path 			= parse_url( $img_url );
		$actual_file_path 	= str_replace( get_site_url(), rtrim( ABSPATH, '/' ), $img_url );
		$orig_size 			= getimagesize( $actual_file_path );
		$image_src[0] 		= $img_url;
		$image_src[1] 		= $orig_size[0];
		$image_src[2] 		= $orig_size[1];
	}
	
	if ( ! empty( $actual_file_path ) && file_exists( $actual_file_path ) )
	{
		$file_info = pathinfo( $actual_file_path );
		$extension = '.' . $file_info['extension'];

		// the image path without the extension
		$no_ext_path 		= $file_info['dirname'] . '/' . $file_info['filename'];
		$cropped_img_path 	= $no_ext_path . '-' . $width . 'x' . $height . $extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ( $image_src[1] > $width || $image_src[2] > $height )
		{
			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if ( file_exists( $cropped_img_path ) ) {
				$cropped_img_url 	= str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
				$vt_image 			= array( 'url' => $cropped_img_url, 'width' => $width, 'height' => $height );
				return $vt_image;
			}

			if ( $crop == false )
			{
				// calculate the size proportionaly
				$proportional_size 	= wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
				$resized_img_path 	= $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

				// checking if the file already exists
				if ( file_exists( $resized_img_path ) ) {
					$resized_img_url 	= str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
					$vt_image 			= array( 'url' => $resized_img_url, 'width' => $proportional_size[0], 'height' => $proportional_size[1] );
					return $vt_image;
				}
			}

			// no cache files - let's finally resize it
			$img_editor = wp_get_image_editor( $actual_file_path );

			if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
				return array('url' => '', 'width' => '', 'height' => '');
			}

			$new_img_path = $img_editor->generate_filename();

			if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
				return array('url' => '', 'width' => '', 'height' => '');
			}
			if ( ! is_string( $new_img_path ) ) {
				return array('url' => '', 'width' => '', 'height' => '');
			}

			$new_img_size 	= getimagesize( $new_img_path );
			$new_img 		= str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

			// resized output
			$vt_image = array( 'url' => $new_img, 'width' => $new_img_size[0], 'height' => $new_img_size[1] );

			return $vt_image;
		}

		$vt_image = array('url' => $image_src[0],'width' => $image_src[1],'height' => $image_src[2]);

		return $vt_image;
	}
	else {
		if ( $place_hold ) {
			$width 		= intval( $width );
			$height 	= intval( $height );
			$color 		= str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT ) . str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT ) . str_pad( dechex( mt_rand( 1, 255 ) ), 2, '0', STR_PAD_LEFT );
			$vt_image 	= array(
				'url' 		=> 'http://placehold.it/' . $width . 'x' . $height . '/' . $color . '/ffffff/',
				'width' 	=> $width,
				'height' 	=> $height
			);
			return $vt_image;
		}
	}
    
	return false;
}