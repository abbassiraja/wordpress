<?php 
$ft_back_to_top = spawp_get_option('footer_back_to_top');

if($ft_back_to_top=='disable'){
	return;
}
?>
<a href="#" class="backToTop"><i class="fa fa-long-arrow-up"></i></a>