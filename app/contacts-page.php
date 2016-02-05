<?php
/**
* Page
* Template Name: Contacts page
* @package WordPress
* @subpackage Alcasar
*/
?>
<?php get_header();?>
	    	
	    	<!-- content-wrap -->
			<section class="content-wrap">
				
				<!-- content -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<section class="post_entry">
							<?php the_content('Подробнее', 'true'); ?>
						</section>
					</article>
				<?php endwhile; endif; ?>	
			</section>
		<!-- footer -->
		<?php get_footer(); ?>