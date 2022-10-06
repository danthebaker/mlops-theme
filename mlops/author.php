<?php get_header(); ?>
		
<section class="blog blog--list">
  
	<header class="hero-standard">
		<div>
			<h1>Posts by: <?php echo get_the_author(); ?></h1>
		</div>
	</header>

  <div class="blog-body">
    <div class="blog-grid">

			<?php get_template_part('loop'); ?>

    </div>
  </div>
  <footer class="paging">
		<?php get_template_part('pagination'); ?>
  </footer>
</section>

		
	</div>
	<?php get_footer(); ?>