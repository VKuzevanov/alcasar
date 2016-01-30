<?php
/**
 * The index.php template for our theme
 *
 * @package WordPress
 */
?>
<?php get_header();?>
	    	
	    	<!-- content-wrap -->
			<section class="content-wrap">
				<!-- content -->
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<h1 class="post_title"><?php the_title(); ?></h1>
						<div class="meta-data">
							<span class="meta-data_time"><?php the_time('d. m. Y'); ?></span>
							<div class="meta-data_breadcrumb"><?php kama_breadcrumbs(); ?></div>
						</div>
						<section class="post-entry">
							<?php the_content('Подробнее', 'true'); ?>
						</section>
					</article>
				<?php endwhile; endif; ?>	
			</section>
		</div>
		<!-- footer -->
		<?php get_footer(); ?>