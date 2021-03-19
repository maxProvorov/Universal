<footer class="footer">
    <div class="container">        
        <div class="footer-menu-bar">
        	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>
        <!-- ./footer-menu-bar -->
        <div class="footer-info">
            <?php 
            if( has_custom_logo() ){
	            echo '<div class= "logo">' . get_custom_logo() . '</div>';
            }else{
                '<span class= "logo-name">' . get_bloginfo( 'name' ) . '</span>';
            }
            ?>
            <?php wp_nav_menu([
                'theme_location' => 'footer_menu',
                'container' => 'nav',
                'container_class' => 'footer-nav-wrapper',
                'menu_class' => 'footer-nav',
                'echo' => true,
            ]); 
            $instance = array(
                'title' => '',
                'facebook' => 'https://facebook.com/',
                'instagram' => 'https://www.instagram.com/',
                'youtube' => 'https://www.youtube.com/',
                'twitter' => 'https://twitter.com/',
            );
             $args = array(
                'before_widget' => '<div class="footer-social">',
                'after_widget' => '</div>',
             );
            the_widget( 'Soc_Icon_Widget', $instance, $args); ?>
        </div>
        <?php
            if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
            	return;
            }
        ?>
        <div class="footer-text-wrapper">
            <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
            <span class="footer-copyright"><?php echo ' &copy ' . date('Y') . ' ' . get_bloginfo( 'name' ); ?></span>        
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>