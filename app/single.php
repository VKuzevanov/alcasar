<?php
/**
 * The single.php template for output single post
 *
 * @package WordPress
 * @subpackage pc-runa
 */
?>
<?php get_header();?>
	    	
	    	<!-- content-wrap -->
			<section class="content__wrap">
				<!-- slider -->
				<div class="m-slider__box">
					<?php echo do_shortcode("[metaslider id=1567]"); ?>
				</div>
				<!-- content -->
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<h1 class="post__title"><?php the_title(); ?></h1>
						<div class="meta-data">
							<span class="meta-data__time"><?php the_time('d. m. Y'); ?></span>
							<div class="meta-data__breadcrumb"><?php kama_breadcrumbs(); ?></div>
						</div>
						<section class="post__entry">
							<?php the_content('Подробнее', 'true'); ?>
						</section>
						<?php comments_template(); ?>
					</article>
				<?php endwhile; endif; ?>	
			</section>
	    	<!-- sidebar -->
			<?php get_sidebar(); ?>
		</div>
		<!-- footer -->
		<?php get_footer(); ?>