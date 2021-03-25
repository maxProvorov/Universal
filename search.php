<?php
get_header();
?>

<div class="container">
	<h1 class="search-title">Результаты поиска по запросу:</h1>
	<div class="digest-wrapper">
		<div class="digest-pagination">	
			<ul class="digest">
				<?php while ( have_posts() ){ the_post(); ?>
					<li class="digest-item">
						<a href="<?php the_permalink() ?>" class="digest-item-permalink">                                
							<img src="<?php                                                 
							if ( has_post_thumbnail() ) {
								echo get_the_post_thumbnail_url();
							}
							else {
								echo get_template_directory_uri() . '/assets/images/img-default.svg';
							}
							?>"
							class="digest-thumb">
						</a>
						<div class="digest-info">			
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
								<svg width="19" height="15" fill="#BCBFC2" class="icon comments-icon">
									<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
								</svg>                                                                                     
								<span class="comments-counter"><?php comments_number('0', '1', '%')?></span>
							</div>
							<div class="likes digest-likes">
								<svg width="19" height="15" fill="#BCBFC2" class="icon likes-icon">
									<use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
								</svg>
								<span class="likes-counter"><?php comments_number('0', '1', '%')?></span>
							</div>
							</div>
							<!-- /.digest-footer -->
						</div>
						<!-- /.digest-info -->
					</li>  
				<?php } ?>
				<?php if ( ! have_posts() ){ ?>
					Записей нет.
				<?php } ?>
			</ul>
			<?php $args = array(
				'prev_text'    => __('&larr; &nbsp; Назад'),
				'next_text'    => __('Вперед &nbsp; &rarr;'),
			);
			 the_posts_pagination($args); ?>
		</div>
		<?php get_sidebar('bottom') ?>
	</div>
</div>

<?php
get_footer();
