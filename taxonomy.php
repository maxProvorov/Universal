<?php
/*
Template Name: Страница таксономий
Template Post Type: post, page, product
*/

get_header();
?>
<div class="container">
    <h1 class="category-title">
       <?php single_cat_title() ;?>
   </h1>
   <?php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs();?>
   
   <div class="post-list">
        <?php while ( have_posts() ){ the_post(); ?>
            <a href="<?php echo get_the_permalink() ?>" class="post-card">            
                
                <div class="post-card-text">
                    <h2 class="post-card-title"><?php echo mb_strimwidth(get_the_title(),0, 40, '...') ?></h2>                    
                    <?php echo mb_strimwidth(get_the_excerpt(),0, 57, '...'); ?>
                    <div class="author">
                        <?php $author_id = get_the_author_meta('ID') ?>
                        <img src="<?php echo get_avatar_url($author_id)?>" alt="" class="author-avatar">
                        <div class="author-info">
                            <span class="author-name"><strong><?php the_author()?></strong></span>
                            <span class="date"><?php the_time('j F')?></span>
                           
                        </div> <!-- /.author-info -->
                    </div> <!-- /.author -->
                </div> <!-- /.post-card-text -->
            </a>
        <?php } ?>
        <?php if ( ! have_posts() ){ ?>
            Записей нет.
        <?php } ?>
   </div>
   <div class="category-pagination">
    <?php $args = array(
            'prev_text'    => __('&larr; &nbsp; Назад'),
            'next_text'    => __('Вперед &nbsp; &rarr;'),
        );
        the_posts_pagination($args); ?>
    </div>
</div>
<?php
get_footer();