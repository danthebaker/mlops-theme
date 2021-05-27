<?php /* Post Template: Learn Single */ get_header(); ?>
<style>
.hero-learnsingle {
	height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
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

      </main>
    </article>
  </div>
</section>

<section class="prefooter prefooter--learn-single">
  <h4 class="compare-heading">Compare providers</h4>
  <form class="compare-grid">
    
<label class="compare-item" for="tecton">
	<input class="compare-item__check" type="checkbox" id="tecton" name="tecton">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-tecton.jpg" alt="Logo for tecton">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

    
<label class="compare-item" for="ydata">
	<input class="compare-item__check" type="checkbox" id="ydata" name="ydata">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-ydata.jpg" alt="Logo for ydata">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

    
<label class="compare-item" for="tecton2">
	<input class="compare-item__check" type="checkbox" id="tecton2" name="tecton2">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-tecton.jpg" alt="Logo for tecton2">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

    
<label class="compare-item" for="ydata2">
	<input class="compare-item__check" type="checkbox" id="ydata2" name="ydata2">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-ydata.jpg" alt="Logo for ydata2">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

    
<label class="compare-item" for="tecton3">
	<input class="compare-item__check" type="checkbox" id="tecton3" name="tecton3">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-tecton.jpg" alt="Logo for tecton3">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

    
<label class="compare-item" for="ydata3">
	<input class="compare-item__check" type="checkbox" id="ydata3" name="ydata3">
	<span class="compare-item__label">Compare provider</span>
	<img class="compare-item__logo" src="/assets/img/logo-ydata.jpg" alt="Logo for ydata3">
	<h4 class="compare-item__heading">Short headline</h4>
	<p class="compare-item__blurb">Short description about this company</p>
	<ul class="compare-item__rating">
		<li>⭐️</li>
		<li>⭐️</li>
		<li>⭐️</li>
		<li class="fade">⭐️</li>
		<li class="fade">⭐️</li>
	</ul>
</label>

  </form>
</section>

		
</div>
<?php get_footer(); ?>
