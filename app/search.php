<?php
/**
* Search Page
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
				<h1 class="post__title"><?php printf('Поиск: %s', get_search_query());?></h1>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<a class="search__link" href="<?php the_permalink(); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<h2 class="post__title"><?php the_title(); ?></h2>
						<section class="post__entry search__post">
							<div class="search__img-wrap">
								<?php  $id = get_post_thumbnail_id( $post_id ); ?>
								<?php if ($id != null) echo  get_the_post_thumbnail();  ?>
							</div>
							<?php the_excerpt('');?>	 
						</section>
					</article>
					</a>
				<?php endwhile; else: echo '<h2>Нет записей.</h2>'; endif; ?>	
			</section>
	    	<!-- sidebar -->
			<?php get_sidebar(); ?>
		</div>
		<!-- footer -->
		<?php get_footer(); ?>