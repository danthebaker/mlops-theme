<?php /* Template Name: Feature Store */ get_header(); ?>


<section class="feature-store-header">
    <?php
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumb">','</div>' );
    }
    ?>
    <h1><?php the_title(); ?></h1>
</section>

<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_template_part('template-parts/newsletter');?>
<?php get_template_part('template-parts/compare-tab');?>
</div>
<?php get_footer(); ?>
