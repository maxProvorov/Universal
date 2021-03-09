<?php
/**
 * Добавление нового виджета Soc_Icon_Widget.
 */
class Soc_Icon_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'soc_icon_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: soc_icon_widget
			'Социальные сети',
			array( 'description' => 'Социальные сети', 'classname' => 'widget-soc-icon', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_soc_icon_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_soc_icon_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$facebook = apply_filters( 'widget_title', $instance['facebook'] );
		$instagram = apply_filters( 'widget_title', $instance['instagram'] );
		$youtube = apply_filters( 'widget_title', $instance['youtube'] );
		$twitter = apply_filters( 'widget_title', $instance['twitter'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?><div class="soc_icon_items"><?php
		if ( ! empty( $facebook ) ) {
			echo '<a target="_blank" class="widget-facebook" href ="https://facebook.com/">
			<img src="' . get_template_directory_uri() . ' /assets/images/soc_icon_widget/facebook.svg"> </a>';
		}
        if ( ! empty( $instagram ) ) {
			echo '<a target="_blank" class="widget-instagram" href ="https://www.instagram.com/">
			<img src="' . get_template_directory_uri() . ' /assets/images/soc_icon_widget/instagram.svg"> </a>';
		}
        if ( ! empty( $youtube ) ) {
			echo '<a target="_blank" class="widget-youtube" href ="https://www.youtube.com/">
			<img src="' . get_template_directory_uri() . ' /assets/images/soc_icon_widget/youtube.svg"> </a>';
		}
        if ( ! empty( $twitter ) ) {
			echo '<a target="_blank" class="widget-twitter" href ="https://twitter.com/">
			<img src="' . get_template_directory_uri() . ' /assets/images/soc_icon_widget/twitter.svg"> </a>';
		}
		?></div><?php
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Наши соцсети';
		$facebook = @ $instance['facebook'] ?: '';
        $instagram = @ $instance['instagram'] ?: '';
		$youtube = @ $instance['youtube'] ?: '';
        $twitter = @ $instance['twitter'] ?: '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
		</p> <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'youtube :' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>">
		</p>
        </p> <p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'twitter :' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';

		return $instance;
	}
	

	// скрипт виджета
	function add_soc_icon_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_soc_icon_widget_style() {
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
// конец класса soc_icon_Widget

// регистрация soc_icon_Widget в WordPress
function register_soc_icon_widget() {
	register_widget( 'Soc_Icon_Widget' );
}
add_action( 'widgets_init', 'register_soc_icon_widget' );