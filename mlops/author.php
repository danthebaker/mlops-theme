<?php get_header(); ?>
		
<section class="blog blog--list">

<?php if ( have_posts() ): the_post(); ?>
  
	<header class="hero-standard">
		<div>
			<h1><?php echo get_the_author(); ?></h1>
		</div>
		<img src="<?php echo get_avatar_url( get_the_author_email(), '2000' ); ?>">
	</header>

<?php endif; ?>

  <div class="blog-body">
    <div class="blog-grid">

		<?php rewind_posts(); while ( have_posts() ) : the_post(); ?>

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


    </div>
  </div>
  <footer class="paging">
		<?php get_template_part('pagination'); ?>
  </footer>
</section>

		
	</div>
	<?php get_footer(); ?>