<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
		<a href="<?php the_permalink(); ?>" class="thumb">
			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists. ?>
				<?php the_post_thumbnail( 'medium_large' ); // Declare pixel size you need inside the array. ?>
			<?php else: ?>
				<img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" alt="">
			<?php endif; ?>
			<!-- /post thumbnail -->		
        </a>	
        <main>
            <p class="date">
                <time datetime="<?php the_time( 'Y-m-d' ); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </p>
            <!-- post title -->
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <!-- /post title -->	
            <?php html5wp_excerpt('html5wp_custom_post'); ?>			
        </main>
		
	</article>

<?php endwhile; ?>

<?php else : ?>

	<!-- article -->
	<article>
		<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>