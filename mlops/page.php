<?php 
get_header(); 
?>
<style>
.hero-learnsingle {
	height: 60vh;
}
.button.product_type_simple {
	display:none;
}
</style>	

		
<section class="learn learn-single">
  
<header class="hero-learnsingle">
	<div>
		<h1><?php the_title(); ?></h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-learn2.jpg">
</header>

  <div class="learn-body">
    <article class="learn-article">
      <main class="typeset typeset--extended typeset--article">

				<?php the_content(); ?>




		
</div>
<?php get_footer(); ?>
