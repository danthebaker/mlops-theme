<?php 
get_header(); 
?>
		
<header class="hero-standard">
	<div>
		<h1><?php the_title(); ?></h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-learn2.jpg">
</header>
<main class="default-main typeset section-content-wrapper">
	<?php the_content(); ?>
</main>

<?php get_footer(); ?>
