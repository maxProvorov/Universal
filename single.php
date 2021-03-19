<?php get_header('post');?>
<main class="site-main">
    <?php
    //запускааем цикл, проверяем есть ли посты
	while ( have_posts() ) :
        // если есть, выводим содержимое
		the_post();
        // находиv шаблон для вывода поста в папке template-parts
		get_template_part( 'template-parts/content', get_post_type() );        
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
            //находит файл comments.php  и выводит его
			comments_template();
		endif;
	endwhile; // End of the loop.
	?>
</main>
<?php get_footer();?>