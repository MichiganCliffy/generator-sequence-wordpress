<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package <%= ThemeName %>
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside class="widget-area col-md-4 col-md-push-8" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- .widget-area -->
