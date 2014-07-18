<!-- Postfix action -->
<div class="row collapse">
	<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
		<fieldset>
			<div class="nine mobile-three columns">
				<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
			</div>
			<div class="three mobile-one columns">
				<input type="submit" class="button expand postfix" value="Search" />
			</div>
		</fieldset>
	</form>
</div>