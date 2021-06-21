<?php
global $post;
$learn_ID = 0;
$pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-learn.php'
));

if($pages){
    $learn_ID  = $pages[0]->ID; // get the Learn page
}
get_header(); ?>
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
    <div class="learn-grid">

		<?php

        if($learn_ID > 0){

            $args = array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'post_parent'    => $learn_ID,
                'order'          => 'ASC',
                'orderby'        => 'menu_order'
            );

            $coming_soon = array();

            $children = new WP_Query( $args );
            if ( $children->have_posts() ) : ?>

                <?php while ( $children->have_posts() ) : $children->the_post(); ?>
                <?php
                if(get_field('coming_soon') === true){
                    array_push($coming_soon, array("title" => get_the_title(), "feature_image_url" => get_the_post_thumbnail_url($post->ID, 'original'), "excerpt" => get_the_excerpt()));
                }
                else {
                    ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <div>
                                <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'original'); ?>" alt="">
                            </div>
                            <main>
                                <h2><?php echo the_title(); ?></h2>
                                <p><?php echo the_excerpt(); ?></p>
                            </main>
                        </a>
                    </article>
                    <?php

                }
                ?>
                

                <?php endwhile; ?>

            <?php endif; wp_reset_postdata(); ?>

            <?php

            if(!empty($coming_soon)){
                foreach($coming_soon as $cs){
                    ?>
                    <article>
                        <div>
                            <div>
                                <img src="<?php echo $cs['feature_image_url']; ?>" alt="">
                            </div>
                            <main>
                                <h2><?php echo $cs['title']; ?></h2>
                                <p><?php echo $cs['excerpt']; ?></p>
                            </main>
                        </div>
                    </article>
                    <?php
                }
            }
        }
		?>
      
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

      
      
<!-- <article>
	<a href="/learn/feature-store/">
	<div>
			<img src="/wp-content/themes/mlops/assets/img/hero-learn2.jpg" alt="">
		</div>
	  <main>
		<h2>Feature store</h2>
		<p>MLOps Community presents a feature store comparison page to help data practitioners evaluate and choose the right feature store solution for their operational machine learning applications</p>
	  </main>
	</a>
</article> -->

      
      
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

<?php get_template_part('template-parts/sponsors');?>

<section class="prefooter prefooter--footer-top"></section>

		
	</div>
	<?php get_footer(); ?>
