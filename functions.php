<?php
//Добавление расширенных возможностей
if ( ! function_exists( 'universal_theme_setup' ) ) :
    function universal_theme_setup() {
		//Добавляем файл перевода
		load_theme_textdomain( 'universal', get_template_directory() . '/languages' );
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
            'header_menu' =>  __( 'Menu in header' , 'universal'),
            'footer_menu' => __( 'Menu in footer' , 'universal')
	    ] );
		
		// Добавляем тип записи
		add_action( 'init', 'register_post_types' );
			function register_post_types(){
				register_post_type( 'lesson', [
					'label'  => null,
					'labels' => [
						'name'               => __('Video lessons', 'universal'), // основное название для типа записи
						'singular_name'      =>  __('lesson', 'universal'), // название для одной записи этого типа
						'add_new'            => __('Add lesson', 'universal'), // для добавления новой записи
						'add_new_item'       => __('Add lesson', 'universal'), // заголовка у вновь создаваемой записи в админ-панели.
						'edit_item'          => __('Edit lesson', 'universal'), // для редактирования типа записи
						'new_item'           => __('New lesson', 'universal'), // текст новой записи
						'view_item'          => __('View lesson', 'universal'), // для просмотра записи этого типа.
						'search_items'       => __('Search lesson', 'universal'), // для поиска по этим типам записи
						'not_found'          => __('Not found', 'universal'), // если в результате поиска ничего не было найдено
						'not_found_in_trash' => __('Not found in trash', 'universal'), // если не было найдено в корзине
						'parent_item_colon'  => '', // для родителей (у древовидных типов)
						'menu_name'          => __('Video lessons', 'universal'), // название меню
					],
					'description'         => 'Section with lessons',
					'public'              => true,
					// 'publicly_queryable'  => null, // зависит от public
					// 'exclude_from_search' => null, // зависит от public
					// 'show_ui'             => null, // зависит от public
					// 'show_in_nav_menus'   => null, // зависит от public
					'show_in_menu'        => true, // показывать ли в меню адмнки
					// 'show_in_admin_bar'   => null, // зависит от show_in_menu
					'show_in_rest'        => true, // добавить в REST API. C WP 4.7
					'rest_base'           => null, // $post_type. C WP 4.7
					'menu_position'       => 5,
					'menu_icon'           => 'dashicons-welcome-learn-more',
					'capability_type'   => 'post',
					//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
					//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
					'hierarchical'        => false,
					'supports'            => [ 'title', 'editor','thumbnail','custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
					'taxonomies'          => [],
					'has_archive'         => true,
					'rewrite'             => true,
					'query_var'           => true,
				] );
			}
			
			// подключаем новые таксономии
			add_action( 'init', 'create_lesson_taxonomies' );

			// функция, создающая 2 новые таксономии "genres" и "teacher" для постов типа "lesson"
			function create_lesson_taxonomies(){

				// Добавляем древовидную таксономию 'genre' (как категории)
				register_taxonomy('genre', array('lesson'), array(
					'hierarchical'  => true,
					'labels'        => array(
						'name'              => _x( 'Genres', 'taxonomy general name' ),
						'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
						'search_items'      =>  __( 'Search Genres' , 'universal'),
						'all_items'         => __( 'All Genres' , 'universal'),
						'parent_item'       => __( 'Parent Genre' , 'universal'),
						'parent_item_colon' => __( 'Parent Genre:' , 'universal'),
						'edit_item'         => __( 'Edit Genre' , 'universal'),
						'update_item'       => __( 'Update Genre' , 'universal'),
						'add_new_item'      => __( 'Add New Genre' , 'universal'),
						'new_item_name'     => __( 'New Genre Name' , 'universal'),
						'menu_name'         => __( 'Genre' , 'universal'),
					),
					'show_ui'       => true,
					'query_var'     => true,
					//'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
				));

				// Добавляем НЕ древовидную таксономию 'teacher' (как метки)
				register_taxonomy('teacher', 'lesson',array(
					'hierarchical'  => false,
					'labels'        => array(
						'name'                        => _x( 'Teachers', 'taxonomy general name' ),
						'singular_name'               => _x( 'Teacher', 'taxonomy singular name' ),
						'search_items'                =>  __( 'Search Teachers' , 'universal'),
						'popular_items'               => __( 'Popular Teachers' , 'universal'),
						'all_items'                   => __( 'All Teachers' , 'universal'),
						'parent_item'                 => null,
						'parent_item_colon'           => null,
						'edit_item'                   => __( 'Edit Teacher' , 'universal'),
						'update_item'                 => __( 'Update Teacher' , 'universal'),
						'add_new_item'                => __( 'Add New Teacher' , 'universal'),
						'new_item_name'               => __( 'New Teacher Name' , 'universal'),
						'separate_items_with_commas'  => __( 'Separate teachers with commas' , 'universal'),
						'add_or_remove_items'         => __( 'Add or remove ' , 'universal'),
						'choose_from_most_used'       => __( 'Choose from the most used teachers' , 'universal'),
						'menu_name'                   => __( 'Writers' , 'universal'),
					),
					'show_ui'       => true,
					'query_var'     => true,
					//'rewrite'       => array( 'slug' => 'the_teachers' ), // свой слаг в URL
				));
			}
		register_taxonomy_for_object_type( 'genre', 'page');
    }       
endif;
add_action( 'after_setup_theme', 'universal_theme_setup' );

/**
 * Register sidebar Сайдбар на главной.
 */
function universal_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( __( 'Sidebar on main' , 'universal'), 'universal-example' ),
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
			'name'          => esc_html__( __( 'Sidebar below' , 'universal'), 'universal-example' ),
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
			'name'          => esc_html__( __( 'Menu in footer' , 'universal'), 'universal-example' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( __( 'Only for menu' , 'universal'), 'universal-example' ),
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
			'name'          => esc_html__( __( 'Text in footer' , 'universal'), 'universal-example' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Add menu here.', 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
		/**
 	* Register sidebar Меню в подвале.
 	*/
	register_sidebar(
		array(
			'name'          => esc_html__( __( 'Sidebar for posts below' , 'universal'), 'universal-example' ),
			'id'            => 'sidebar-post',
			'description'   => esc_html__( __( 'Add posts' , 'universal'), 'universal-example' ),
			'before_widget' => '<section id="%1$s" class="post-page-sidebar %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="post-sidebar-title">',
			'after_title'   => '</h2>',
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
 * Register виджета bottom_widget..
 */
 require get_template_directory() . '/inc/bottom_widget.php';


/**
 * Register  post-widget  в подвале.
 */
 require get_template_directory() . '/inc/post_widget.php';

 /**
 * Register  breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';




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


// Создаем переменную для доступа к файлу admin-ajax.php
add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );
function adminAjax_data(){

	// Первый параметр 'jquery' означает, что код будет прикреплен к скрипту с ID 'jquery'
	// 'jquery' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
	// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
	wp_localize_script( 'jquery', 'adminAjax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}
//Обработчик формы
add_action( 'wp_ajax_contacts_form', 'ajax_form' );
add_action( 'wp_ajax_nopriv_contacts_form', 'ajax_form' );
function ajax_form() {
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$message = 'Пользователь ' . $contact_name . 'спросил: ' . $contact_comment . '. Его email: ' . $contact_email;
	$headers = 'From: Veloceraptor <maxiys1@rambler.ru>' . "\r\n";
	$sent_message = wp_mail('maxiys1@rambler.ru', 'Новая заявка', $message, $headers);
	if($sent_message ){
		echo 'Успешно';
	}else{
		echo 'Ошибка';
	}

	// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	wp_die();
}

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

//Меняем стандартный вывод многоточия в excerpt
add_filter('excerpt_more', function($more) {
	return '...';
});

// Склоняем слова после числительных
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

