<?php
/**
 * Добавление нового виджета Post_Widget.
 */
class Post_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'post_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: post_widget
			'Статьи той же категории кроме текущей',
			array( 'description' => 'Вывод последних статей', 'classname' => 'widget-post', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_post_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_post_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$count = $instance['count'];
		echo $args['before_widget'];
		if ($count%4 ===0) {
			echo '<div class="container post-widget-wrapper">';
            //Цикл
			global $post;
            $posts = get_posts( array(
			'numberposts' => $count,
				) );
			$category = get_the_category();
			rsort($category);
			$cat_add_id = $category[0]->term_id;
			$real_id = get_the_ID();

			$set = array('cat' =>$cat_add_id);
			$posts = get_posts($set);

			foreach( $posts as $post ){
				setup_postdata($post);
				if ($post->ID <> $real_id){
				?>
				<a href="<?php the_permalink(); ?> class="post-widget-permalink"">
					<img src="<?php 
					if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail_url();
                        }
                        else {
                            echo get_template_directory_uri() . '/assets/images/img-default.svg';
                        } ?>" alt="" class="post-widget-thumb">
					<h4 class="post-widget-title"><?php echo mb_strimwidth(get_the_title(),0, 45, '...'); ?></h4>
					<div class="post-widget-info">
						<div class="eye">
                            <svg width="15" height="15" fill= "#BCBFC2" class="icon likes-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#eye"></use>
                            </svg>
                            <span class="eye-counter"><?php comments_number('0', '1', '%')?></span>
                        </div>
						<div class="comments">
                            <svg width="15" height="15" fill= "#BCBFC2" class="icon comments-icon">
                                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                            </svg>                                                        
                            <span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
                        </div>
                        
					</div>
				</a> <?php
				}
			}
			wp_reset_postdata();
			echo '</div>';							
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
        $count = @ $instance['count'] ?: '4';
		?>
        <p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Колличество постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		return $instance;
	}
	

	// скрипт виджета
	function add_post_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_post_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Post_Widget

// регистрация Post_Widget в WordPress
function register_post_widget() {
	register_widget( 'Post_Widget' );
}
add_action( 'widgets_init', 'register_post_widget' );