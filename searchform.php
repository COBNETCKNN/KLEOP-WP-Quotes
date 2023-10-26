<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
	
	<div class="input-group">
		<input name="s" autocomplete="off" type="text" class="topSearchForm ajax_s form-control input-sm" value="<?php echo get_search_query(); ?>" style="text-align:left;padding-left:15px;">
		<span class="input-group-btn">
		<i class="magnifyingGlass icon-glyph-3 icon-1x">
			<input type="submit" value="" class="searchsubmit button">
		</i>
		</span>
	</div>

</form>