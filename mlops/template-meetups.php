<?php /* Template Name: Meetups */ get_header(); ?>
<header class="hero-standard">
   <div>
      <h1><?php the_title(); ?></h1>
   </div>
   <img src="/wp-content/themes/mlops/assets/img/hero-ep3.jpg" class="Photograph of keyboard warrior">
</header>

<div class="meetups typeset">
   <div class="meetup-body">
      <?php the_content(); ?>
   </div>
</div>

<?php get_template_part('template-parts/sponsors');?>
<section class="prefooter prefooter--footer-top"></section>



<?php get_footer(); ?>