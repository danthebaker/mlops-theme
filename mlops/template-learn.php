<?php /* Template Name: Learn */ get_header(); ?>
<style>
.hero-standard {
	min-height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
}
</style>		
<section class="learn">
  
<header class="hero-standard">
	<div>
		<h1>Learn</h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" class="Photograph of keyboard warrior">
</header>

  <div class="learn-bod">
    <div class="learn-grid" style="display: block;">

		<?php the_content(); ?>
      
<!-- <article>
	<a href="#">
	<div>
			<img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" alt="">
		</div>
	  <main>
		<h2>Model deployment</h2>
		<p>There are a range of choices for using models to make business decisions. Deploying machine learning models can mean different things, depending on the context. Understanding the types of prediction use-cases can help to decide on which tools apply to your use case.</p>
	  </main>
	</a>
</article> -->

      
      
<article>
	<a href="/learn/feature-store/">
	<div>
			<img src="/wp-content/themes/mlops/assets/img/hero-learn2.jpg" alt="">
		</div>
	  <main>
		<h2>Feature store comparison</h2>
		<p>A one stop shop that make it easy for a user to handle everything from data discovery to monitoring and sharing of features for machine learning workflows.</p>
	  </main>
	</a>
</article>

      
      
<!-- <article>
	<a href="#">
	<div>
			<img src="/wp-content/themes/mlops/assets/img/hero-learn3.jpg" alt="">
		</div>
	  <main>
		<h2>Pipelines</h2>
		<p>One of the key elements of the MLOps ecosystem. A Pipeline is a sequence of linked steps that perform complex operations on given inputs and produce a bunch of outputs.</p>
	  </main>
	</a>
</article>

      
      
<article>
	<a href="#">
		<div>
			<img src="/wp-content/themes/mlops/assets/img/hero-learn4.jpg" alt="">
		</div>
	  <main>
		<h2>Model Versioning &amp; Model Registry</h2>
		<p>One of the key elements of the MLOps ecosystem. A Pipeline is a sequence of linked steps that perform complex operations on given inputs and produce a bunch of outputs.</p>
	  </main>
	</a>
</article> -->

    
    </div>
  </div>
</section>

<section class="prefooter prefooter--sizemore">
  <h5>Sponsors</h5>
  <ul class="sponsors-grid">
    <li><a href="https://www.tecton.ai" target="_blank"><img src="/wp-content/themes/mlops/assets/img/logo-tecton.jpg" alt="Tecton logo"></a></li>
    <li><a href="https://ydata.ai" target="_blank"><img src="/wp-content/themes/mlops/assets/img/logo-ydata.jpg" alt="YData logo"></a></li>
  </ul>
</section>

<section class="prefooter prefooter--footer-top"></section>

		
	</div>
	<?php get_footer(); ?>
