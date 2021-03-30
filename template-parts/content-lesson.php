<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- шапка поста -->
    <header class="entry-header <?php echo get_post_type()?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75));">
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
                </div>
                <div class="video">                    
                    <?php 
                        $link= get_field('video_link');
                        
                        if (strpos($link, 'youtube') !== false) {
                            $tmp= explode('?v=', $link);
                            $temp = end($tmp);
                            
                            echo '<iframe width="100%" height="450" src="https://www.youtube.com/embed/' . $temp . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        }elseif(strpos($link, 'vimeo') !== false){
                            $tmp= explode('vimeo.com/', $link);
                            $temp = end($tmp);
                            echo '<iframe src="https://player.vimeo.com/video/' . $temp . '?title=0&byline=0&portrait=0" width="100%" height="450" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
                        }
                    ?>
                </div>
                <div class="lesson-header-title-wrapper">
                    <?php
                    //проверка, толчно ли мы на странице поста
                    if ( is_singular() ) :
                        the_title( '<h1 class="lesson-header-title">', '</h1>' );
                    else :
                        the_title( '<h2 class="lesson-header-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    endif;?>
                
                </div>
                   
                <div class="post-header-info">
                    <svg width="19" height="15" fill="#BCBFC2" class="icon clock-icon">
                        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
                    </svg> 
                    <span class="post-header-date"><?php the_time('j F, G:i')?></span>
                              
                </div>
                
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
    
        <footer class="entry-footer">
            <?php 
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'universal' ) );
                if ( $tags_list ) {
                    /* translators: 1: list of tags. */
                    printf( '<span class="tags-links">' . esc_html__( '%1$s', 'universal' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                //вывод шеринговых ссылок
                meks_ess_share();
            ?>
        </footer><!-- .entry-footer -->
        
    </div>
   
</article>
