<?php
//Добавление расширенных возможностей
if ( ! function_exists( 'universal_theme_setup' ) ) :
    function universal_theme_setup() {
        //Добавление тега title
        add_theme_support( 'title-tag' );
        //Добавление миниатюры
        add_theme_support( 'post-thumbnails', array( 'post' ) ); 
        //Лого из админки
        add_theme_support( 'custom-logo', [
            'height'      => 190,
            'width'       => 163,
            'flex-height' => true,
            'header-text' => 'universal',
            'unlink-homepage-logo' => false, // WP 5.5
         ] );
        
	    register_nav_menus( [
            'header_menu' => 'Меню в шапке',
            'footer_menu' => 'Меню в подвале'
	    ] );        
    }       
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

/**
 * Register sidebar Сайдбар на главной.
 */
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар на главной', 'universal-example' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	/**
 	* Register sidebar Поледние посты.
 	*/
	register_sidebar(
		array(
			'name'          => esc_html__( 'Сайдбар снизу', 'universal-example' ),
			'id'            => 'sidebar-bottom',
			'description'   => esc_html__( 'Add widgets here.', 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	/**
 	* Register sidebar Меню в подвале.
 	*/
	register_sidebar(
		array(
			'name'          => esc_html__( 'Меню в подвале', 'universal-example' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Только для меню!', 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
		)
	);

	/**
 	* Register sidebar Меню в подвале.
 	*/
	register_sidebar(
		array(
			'name'          => esc_html__( 'Текст в подвале', 'universal-example' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Add menu here.', 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}
add_action( 'widgets_init', 'universal_theme_widgets_init' );



/**
 * Register виджета Downloader_Widget..
 */
require get_template_directory() . '/inc/downloader_widget.php';

/**
 * Register виджета Soc_Icon_Widget..
 */
 require get_template_directory() . '/inc/soc_icon_widget.php';

/**
 * Register виджета Soc_Icon_Widget..
 */
 require get_template_directory() . '/inc/bottom_widget.php';



//Подключение стилей и скртптов
function enqueue_universal_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'swiper-slider', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', 'style', time());
    wp_enqueue_style( 'universal-theme', get_template_directory_uri() . '/assets/css/universal-theme.css', 'style', time());
    wp_enqueue_style( 'Roboto Slab', "https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap");
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', 'https://code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', null,  time(), true);
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', 'swiper',  time(), true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_universal_style' );

//Фильтр тегов
add_filter( 'widget_tag_cloud_args' , 'edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args($args){
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['number'] = '13';
	$args['orderby'] = 'count';

	return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'homepage-thumb', 65, 65, true ); // Кадрирование изображения
}

