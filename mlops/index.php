<?php get_header(); ?>
		
<section class="blog blog--list">
  
	<header class="hero-standard">
		<div>
			<h1>Blog</h1>
		</div>
		<img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" class="Photograph of keyboard warrior">
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

