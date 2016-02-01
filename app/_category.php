<?php
/**
 * The caterogy.php template for our theme
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
				<ul class="category__wrap">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li class="category__cart">
						<a class="category__link" href="<? the_permalink() ?>" rel="nоfоllow">
							<div class="category__img-wrap">
								<?php  $id = get_post_thumbnail_id( $post_id ); ?>
								<?php if ($id != null) echo  get_the_post_thumbnail();  ?>
							</div>
							<article id="post-<?php the_ID(); ?>" <?php post_class('category__article'); ?> >
								<h2 class="category__post-title"><?php the_title(); ?></h2>
								<section class="category__section">
									<?php the_excerpt(); ?>
								</section>
							</article>
						</a>
					</li>
					<?php endwhile; endif; ?>
				</ul>	
				<?php the_posts_pagination( array( 
					'end_size' => 2,
    				'mid_size' => 2, )
					); 
    			?>
			</section>
	    	<!-- sidebar -->
			<?php get_sidebar(); ?>
		</div>
		<!-- footer -->
		<?php get_footer(); ?>