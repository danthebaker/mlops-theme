<?php get_header(); ?>
<style>
.hero-post {
	height: 30vh;
}
</style>		
<section class="blog blog-single">

<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>

<header class="hero-post">
	<div>
		<span><?php the_date(); ?></span>
		<h1><?php the_title(); ?></h1>
	</div>
	<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
		<?php the_post_thumbnail(); // Fullsize image for the single post. ?>
	<?php else: ?>
		<img src="/wp-content/themes/mlops/assets/img/hero-ep1.jpg">
	<?php endif; ?>
</header>

  <div class="blog-body">
    <article class="blog-article" id="post-<?php the_ID(); ?>">
      <header class="blog-author">
        <img src="<?php echo get_avatar_url( get_the_author_meta('email'), '60' ); ?>">
        <h2><?php esc_html_e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></h2>
      </header>
      <main class="typeset typeset--extended typeset--article">
				<?php the_content(); // Dynamic Content. ?>

				<?php the_tags( __( 'Tags: ', 'html5blank' ), ', ', '<br>' ); // Separated by commas with a line break at the end. ?>

				<!-- <p><?php esc_html_e( 'Categorised in: ', 'html5blank' ); the_category( ', ' ); // Separated by commas. ?></p> -->

      </main>
      <!-- <footer class="blog-footer">
        <div class="typeset typeset--article">
          <h3>Related articles</h3>
          <ul>
            <li><a href="">The ML Test Score: A Rubric for ML Production Readiness and Technical Debt Reduction - 2017</a></li>
            <li><a href="">Hidden Technical Debt of ML Systems</a></li>
            <li><a href="">Monitoring and explainability of models in production</a></li>
          </ul>
        </div>
      </footer> -->
    </article>
	</div>

<?php endwhile; ?>
<?php else : ?>

<!-- article -->
<article>

	<h1><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

</article>
<!-- /article -->

<?php endif; ?>
</section>

		
</div>
<?php get_footer(); ?>