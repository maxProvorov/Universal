<?php get_header(); ?>
<main class = "front-page-header">
    <div class="container">
        <div class="hero">
            <div class="left">
                <?php
                //Объявляем глобальную переменную
                global $post;

                $myposts = get_posts([ 
                	'numberposts' => 1,
                	'category_name' => 'javascript, css, html, web-design,',
                ]);
                //проверка есть ли посты
                if( $myposts ){
                    //если есть, запускаем цикл
                	foreach( $myposts as $post ){
                		setup_postdata( $post );
                		?>
                		<!-- Вывода постов, функции цикла: the_title() и т.д. -->
                        <img src="<?php the_post_thumbnail_url() ?>" alt="" class="post-thumb">
                        <?php $author_id = get_the_author_meta('ID') ?>
                        <a href="<?php echo get_author_posts_url($author_id) ?>" class="author">                   
                            <img src="<?php echo get_avatar_url($author_id)?>" alt="" class="avatar">
                            <div class="author-bio">
                                <span class="author-name"><?php the_author(); ?></span>
                                <span class="author-rank">Разработчик</span>
                            </div>
                        </a>
                        <div class="post-text">
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
                            <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...') ?></h2>
                            <a href="<?php echo get_the_permalink() ?>" class="more">Читать далее</a>
                        </div>
                <?php 
                    }
                } else {
                    // Постов не найдено
                    ?> <p>Постов не найдено</p><?php
                }

                wp_reset_postdata(); // Сбрасываем $post
                ?>
            </div>
            <div class="right">
                <h3 class="recommend">Рекомендуем</h3>
                <ul class="posts-list">
                        <?php
                    //Объявляем глобальную переменную
                    global $post;

                    $myposts = get_posts([ 
                        'numberposts' => 5,
                        'offset' => 1,
                        'category_name' => 'javascript, css, html, web-design,',
                    ]);
                    //проверка есть ли посты
                    if( $myposts ){
                            //если есть, запускаем цикл
                        foreach( $myposts as $post ){
                              setup_postdata( $post );
                              ?>
                              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                            <li class="post">
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
                                <a class = "post-permalink" href="<?php echo get_the_permalink() ?>">
                                    <h4 class="post-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...') ?></h4>
                                </a>                                
                            </li>
                          <?php 
                        }
                    } else {
                        // Постов не найдено
                        ?> <p>Постов не найдено</p><?php
                    }
                    wp_reset_postdata(); // Сбрасываем $post
                    ?>        
                </ul>
            </div>
        </div>
    </div>
</main>
<div class="container">
    <ul class="article-list">
            <?php
        //Объявляем глобальную переменную
        global $post;

        $myposts = get_posts([ 
            'numberposts' => 4,
            'category_name' => 'articles',
        ]);
        //проверка есть ли посты
        if( $myposts ){
                //если есть, запускаем цикл
            foreach( $myposts as $post ){
                  setup_postdata( $post );
                  ?>
                  <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                <li class="article-item">                    
                    <a class = "article-permalink" href="<?php echo get_the_permalink() ?>">
                        <h4 class="article-title"><?php echo mb_strimwidth(get_the_title(),0, 50, '...') ?></h4>
                    </a>
                    <img width = "65" height = "65" src="<?php echo get_the_post_thumbnail_url(null, 'homepage-thumb') ?>" alt="">                                
                </li>
              <?php 
            }
        } else {
            // Постов не найдено
            ?> <p>Постов не найдено</p><?php
        }
        wp_reset_postdata(); // Сбрасываем $post
        ?>        
    </ul>
  <div class="main-grid">
    <ul class="article-grid">
        <?php		
            global $post;
            // формирование запроса в бд
            $query = new WP_Query( [
                //кол-во пстов
                'posts_per_page' =>7,
                'tag'=>  'популярное',
                'category__not_in' => '34',
            ] );
            //если есть посты
            if ( $query->have_posts() ) {
                //создаем пререм-ю счетчик постов
                $cnt = 0;
                //выводим посты пока есть
                while ( $query->have_posts() ) {
                    $query->the_post();
                    //увелич-е счетчика
                    $cnt++;
                    //Выводим первый пост
                    switch ($cnt) {
                        case '1':
                            ?>
                                <li class="article-grid-item article-grid-item-1">
                                    <a href="<?php echo get_the_permalink() ?>" class="article-grid-permalink">                                        
                                        <span class="category-name"><?php $category = get_the_category();echo $category[0]->name; ?></span>
                                        <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...'); ?></h4>
                                        <p class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(),0, 90, '...'); ?></p>
                                        <div class="article-grid-info">
                                            <div class="author">
                                                <?php $author_id = get_the_author_meta('ID') ?>
                                                <img src="<?php echo get_avatar_url($author_id)?>" alt="" class="author-avatar">
                                                <span class="author-name"><strong><?php the_author()?></strong>: <?php the_author_meta('description')?></span>
                                            </div>
                                            <div class="comments">
                                                <img src="<?php echo get_template_directory_uri() . '/assets/images/comment.svg' ?>" alt="comment icon" class=" comments-icon">                                                
                                                <span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            break;
                        case '2':
                            //Вывожим второй пост
                            ?>
                                <li class="article-grid-item article-grid-item-2">
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" class="article-grid-thumb">
                                    <a href="<?php the_permalink() ?>" class="article-grid-permalink">
                                        <span class="tag">
                                            <?php $posttags = get_the_tags();
                                                if($posttags){
                                                    echo $posttags[0] -> name . ' ';
                                                }
                                            ?></span>
                                        <span class="category-name"><?php $category = get_the_category();echo $category[0]->name; ?></span>
                                        <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...'); ?></h4>                                        
                                        <div class="article-grid-info">
                                            <div class="author">
                                                <?php $author_id = get_the_author_meta('ID') ?>
                                                <img src="<?php echo get_avatar_url($author_id)?>" alt="" class="author-avatar">
                                                <div class="author-info">
                                                    <span class="author-name"><strong><?php the_author()?></strong></span>
                                                    <span class="date"><?php the_time('j F')?></span>
                                                    <div class="comments">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/comment-white.svg' ?>" alt="comment icon" class="comments-icon">                                                
                                                        <span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
                                                    </div>
                                                    <div class="likes">
                                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/heart.svg' ?>" alt="icon: like" class="likes-icon">
                                                        <span class="likes-counter"><?php comments_number('0', '1', '%')?></span>
                                                    </div>
                                                </div> <!-- /.author-info -->
                                            </div>                                            
                                        </div>
                                    </a>
                                </li>
                            <?php
                        break;
                        case '3':
                            //Выводим 3 пост
                            ?>
                                <li class="article-grid-item article-grid-item-3">
                                     <a href="<?php echo get_the_permalink() ?>" class="article-grid-permalink">
                                        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" class="article-thumb">
                                        <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...'); ?></h4>
                                    </a>
                                </li>                                
                            <?php
                        break;
                        default:?> 
                            <li class="article-grid-item article-grid-item-default">
                                <a href="<?php echo get_the_permalink() ?>" class="article-grid-permalink">
                                    <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(),0, 40, '...'); ?></h4>
                                    <p class="article-grid-excerpt"><?php echo mb_strimwidth(get_the_excerpt(),0, 87, '...'); ?></p>
                                    <span class="article-date"><?php the_time('j F');?></span>
                                </a>
                            </li>
                        <?php                            
                            break;
                    }                    
                }
            }
            wp_reset_postdata(); // Сбрасываем $post
        ?>
    </ul>
    <?php get_sidebar() ?>
  </div>
</div>
<?php		
global $post;

// Цикл для статьи широкого блока
$query = new WP_Query( [
	'posts_per_page' => 1,
	'category_name' => 'investigation',
] );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<section class="investigation" style = "background: linear-gradient(0deg, rgba(64, 48, 61, 0.45), rgba(64, 48, 61, 0.45)),  url(<?php echo get_the_post_thumbnail_url()?>) no-repeat center center">
            <div class="container">
                <h2 class="investigation-title"><?php echo mb_strimwidth(get_the_title(),0, 90, '...') ?></h2>
                <a href="<?php echo get_the_permalink() ?>" class="more">Читать статью</a>
            </div>
        </section>
		<?php 
	}
} else {
	// Постов не найдено
}

wp_reset_postdata(); // Сбрасываем $post
?>





<div class="container">
    <div class="digest-wrapper">
        <ul class="digest">
            <?php
            //Объявляем глобальную переменную
            global $post;
            $myposts = get_posts([ 
                'numberposts' => 6,
                'offset' => 1,
            ]);
            //проверка есть ли посты
            if( $myposts ){
                    //если есть, запускаем цикл
                foreach( $myposts as $post ){
                      setup_postdata( $post );
                      ?>
                      <!-- Вывода постов, функции цикла: the_title() и т.д. -->
                    <li class="post">
                          <li class="digest-item">
                            <a href="<?php the_permalink() ?>" class="digest-item-permalink">
                              <img src="<?php echo get_the_post_thumbnail_url() ?>" class="digest-thumb">
                            </a>
                            <div class="digest-info">
                              <button class="bookmark">
                                <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 0H12C13.1046 0 14 0.89543 14 2V18L7.09495 13L0 18V2C0 0.89543 0.89543 0 2 0Z" fill="#BCBFC2"/>
                                </svg>

                              </button>
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
                              <a href="#" class="digest-item-permalink">
                                <h3 class="digest-title"><?php echo mb_strimwidth(get_the_title(),0, 60, '...') ?></h3>
                              </a>
                              <p class="digest-excerpt"><?php echo mb_strimwidth(get_the_excerpt(),0, 110, '...'); ?></p>
                              <div class="digest-footer">
                                <span class="digest-date"><?php the_time('j F')?></span>
                                <div class="comments digest-comments">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/images/comment-grey.svg' ?>" alt="comment icon" class="icon comments-icon">                                                
                                    <span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
                                </div>
                                <div class="likes digest-likes">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/images/heart-grey.svg' ?>" alt="icon: like" class="likes-icon">
                                    <span class="likes-counter"><?php comments_number('0', '1', '%')?></span>
                                </div>
                              </div>
                              <!-- /.digest-footer -->
                            </div>
                            <!-- /.digest-info -->
                          </li>                        
                  <?php 
                }
            } else {
                // Постов не найдено
                ?> <p>Постов не найдено</p><?php
            }
            wp_reset_postdata(); // Сбрасываем $post
            ?>  
        </ul>
        <?php get_sidebar('bottom') ?>
    </div>    
</div>
   
