<?php
/**
 * The template for displaying search form.
 *
 * @package Divine_Salon
 */ 
?>

<div class="sidebar-area">
	<div class="widget_search">
		<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>"> 
			<input class="search-field" placeholder="<?php esc_attr_e('Search ...','divine-salon'); ?>" value="<?php echo get_search_query(); ?>" name="s" type="search"> 
		</form>
	</div>
</div>