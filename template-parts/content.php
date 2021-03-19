<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- шапка поста -->
    <header class="entry-header <?php echo get_post_type()?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75)), url(
        <?php                                                 
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail_url(null, 'thumb');
            }
            else {
                echo get_template_directory_uri() . '/assets/images/img-default.svg';
            }
        ?>
    );">
		<div class="container">
            <div class="post-header-wrapper">                                
                <div class="post-header-nav">
                    <?php
                    foreach (get_the_category() as $category) {
                        printf(
                            '<a href="%s" class="category_link %s">%s</a>',
                            esc_url(get_category_link($category)),
                            esc_html($category -> slug),
                            esc_html($category -> name),
                        );
                    }
                    ?>  
                    <!-- Ссылка на главную-->
                    <a class="home-link" href="<?php echo get_home_url();?>">
                        <svg width="18" height="17" fill="#fff" class="icon comments-icon">
                            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#home"></use>
                        </svg> 
                        На главную
                    </a>
                    <?php
                    //выводим ссылки на предидущий и следующий посты
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="post-nav-prev">
                            <svg width="15" height="7" class="icon prev-icon">
                                <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left-arrow"></use>
                            </svg>
                            ' . esc_html__( 'Назад', 'universal' ) . '</span>',
                            'next_text' => '<span class="post-nav-next">' . esc_html__( 'Вперед', 'universal' ) . '
                            <svg width="15" height="7" class="icon next-icon">
                                <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#right-arrow"></use>
                            </svg>
                            </span>',
                        )
                    );
                    ?>
                </div>
                <div class="post-header-title-wrapper">
                    <?php
                    //проверка, толчно ли мы на странице поста
                    if ( is_singular() ) :
                        the_title( '<h1 class="post-header-title">', '</h1>' );
                    else :
                        the_title( '<h2 class="post-header-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;?>
                    <button class="bookmark">
                    <svg width="19" height="15" fill="#BCBFC2" class="icon bookmark">
                            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#bookmark"></use>
                        </svg>
                    </button>
                </div>
                    <p class="career-post-excerpt">
                    <?php echo mb_strimwidth(get_the_excerpt(),0, 170, '...'); ?>
                    </p>
                <div class="post-header-info">
                    <svg width="19" height="15" fill="#BCBFC2" class="icon clock-icon">
                        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
                    </svg> 
                    <span class="post-header-date"><?php the_time('j F, G:i')?></span>
                    <div class="likes post-header-comments">
                        <svg width="19" height="15" fill="#BCBFC2" class="icon heart-icon">
                            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                        </svg>
                        <span class="likes-counter"><?php comments_number('0', '1', '%')?></span>
                    </div>
                    <div class="post-header-likes">
                        <svg width="19" height="15" fill="#BCBFC2" class="icon comment-icon">
                            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                        </svg>                                                                                     
                        <span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
                    </div>                
                </div>
                <div class="post-author">
                    <div class="post-author-info">
                        <?php $author_id = get_the_author_meta('ID') ?>                                     
                        <img src="<?php echo get_avatar_url($author_id)?>" alt="" class="post-author-avatar">
                            <span class="post-author-name"><?php the_author(); ?></span>
                            <span class="post-author-rank">Разработчик</span>
                            <span class="post-author-posts"><?php
                            plural_form(
                                count_user_posts($author_id),
                                array('статья','статьи','статей'));
                            ?></span>
                        <a href="<?php echo get_author_posts_url($author_id) ?>" class="post-author-link">Страница автора</a>
                </div>
                <!-- /.post-author -->
            </div>    
        </div>  
	</header><!-- .entry-header -->
    <!-- Содержимое поста -->
    <div class="container">
        <div class="post-content">
            <?php
            //выводим содержимое записи
            the_content(
                sprintf(
                    //очистка от лишних тегов
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'universal' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            //Выводит ссылки навигации по страницам, для многостраничных постов (для разделения используется <!--nextpage-->)
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'universal' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
    </div>
    <footer class="entry-footer">
		<?php 
            /* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'universal' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'universal' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
        ?>
	</footer><!-- .entry-footer -->
</article>
