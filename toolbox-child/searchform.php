<aside class="widget_search">
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text" for="s"><?php __('Search for:') ?></label>
	
	<input type="text" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" results=5 autosave="un1qu3_aut0s@v3_v@l" value="<?php esc_attr(apply_filters('the_search_query', get_search_query())) ?>" name="s" id="s">
	<input type="submit" id="searchsubmit" value="<?php esc_attr__('Search') ?>" />
	</form>
	
</aside>
