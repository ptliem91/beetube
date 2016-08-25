<?php
/**
 * Search Form Template
 *
 * The search form template displays the search form.
 *
 * @package BeeeTube
 * @subpackage Template
 *  1.0
 */
?>

<div class="searchform-div">
	<form method="get" class="searchform" action="<?php echo home_url(); ?>/">
		<div class="search-text-div"><input type="text" name="s" class="search-text" value="" placeholder="<?php _e('Search Your Keyword |', 'jtheme') ?>" /></div>
		<div class="search-submit-div btn"><input type="submit" class="search-submit" value="<?php _e('Search', 'jtheme') ?>" /></div>
	</form><!--end #searchform-->
</div>