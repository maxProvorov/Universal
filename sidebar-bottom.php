<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package universal
 */

if ( ! is_active_sidebar( 'sidebar-bottom' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar-front-page">
	<?php dynamic_sidebar( 'sidebar-bottom' ); ?>
</aside><!-- #secondary -->