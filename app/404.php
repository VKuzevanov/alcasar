<?php
/**
* Home Page
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
					<article id="post-<?php the_ID(); ?>" >
						<h1 class="post__title">404. Cтраница не найдена!</h1>
					</article>
			</section>
	    	<!-- sidebar -->
			<?php get_sidebar(); ?>
		</div>
		<!-- footer -->
		<?php get_footer(); ?>