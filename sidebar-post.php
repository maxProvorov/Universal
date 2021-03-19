<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal
 */

if ( ! is_active_sidebar( 'sidebar-post' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar-post-page">
	<?php dynamic_sidebar( 'sidebar-post' ); ?>
</aside><!-- #secondary -->
