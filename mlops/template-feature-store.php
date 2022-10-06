<?php /* Template Name: Feature Store */ get_header(); ?>


<section class="hero-standard feature-store-header">
    <div>
        <h1><?php the_title(); ?></h1>
    </div>
</section>

<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_template_part('template-parts/newsletter');?>
</div>
<?php get_footer(); ?>
