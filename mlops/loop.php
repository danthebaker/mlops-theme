<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php the_permalink(); ?>">
			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists. ?>
				<?php the_post_thumbnail( 'medium_large' ); // Declare pixel size you need inside the array. ?>
			<?php else: ?>
				<img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" alt="">
			<?php endif; ?>
			<!-- /post thumbnail -->			
			<main>
				<!-- post title -->
				<h2><?php the_title(); ?></h2>
				<!-- /post title -->				
				<p>
					<time datetime="<?php the_time( 'Y-m-d' ); ?>">
						<?php the_date(); ?>
					</time>
				</p>
			</main>
		</a>
	</article>

<?php endwhile; ?>

<?php else : ?>

	<!-- article -->
	<article>
		<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>