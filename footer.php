<footer class="footer">
    <div class="container">
        <?php 
        if( !is_page('thankyou')){?>
              <div id= "footer-form-wrapper" class="footer-form-wrapper">
            <h3 class="footer-form-title">Подпишитесь на нашу рассылку</h3>
            <form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post" class="footer-form">
                <!-- Поле Email (обязательно) -->
                <input required type="text" name="email" placeholder="Email" class="input footer-form-input"/>
                <input type="hidden" name="campaign_token" value="BHcwt" />
                <!-- Страница благодарности -->
                <input type="hidden" name="thankyou_url" value="<?php echo home_url('thankyou')?>"/>
                <!-- Добавить подписчика в цикл на определенный день (по желанию) -->
                <input type="hidden" name="start_day" value="0" />
                <!-- Кнопка подписаться -->
                <button type="submit">Подписаться</button>
            </form>
        </div> 
        <?php }
        ?>
           
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
            <span class="footer-copyright"><?php echo get_post_meta(98, 'email', true) . ' &copy '  . ' ' . get_bloginfo( 'name' ); ?></span>        
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>