<?php get_header(); ?>

<section class="team">

   <header class="hero-standard">
      <div>
         <?php echo do_shortcode('[rank_math_breadcrumb]'); ?>
         <h1>Teams</h1>
      </div>
      <img src="/wp-content/themes/mlops/assets/img/hero-learn1.jpg" class="Photograph of keyboard warrior">
   </header>

   <div class="team-body">
      <div class="team-grid">
         <?php
    $args = array(
			'post_type'      => 'team-member',
			'posts_per_page' => -1,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		);


		$team_member = new WP_Query( $args );

		if ( $team_member->have_posts() ) : ?>

         <?php while ( $team_member->have_posts() ) : $team_member->the_post(); ?>
         
         <div class="grid-item" data-id="<?php echo $post->post_name; ?>">
            <div class="sq-img">
               <?php the_post_thumbnail(); ?>
            </div>
            <div class="team-header">
               <h2><?php the_title(); ?></h2>
            
            <?php if( get_field('linkedin') ): ?>
               <a href="<?php the_field('linkedin'); ?>"><span class="social-icon pinkedin"></span></a>
            <?php endif; ?>
            </div>

            <?php if( get_field('job_title') ): ?>
               <p class="title"><?php the_field('job_title'); ?></p>
            <?php endif; ?>

            <?php if( get_field('company') ): ?>
               <p><?php the_field('company'); ?></p>
            <?php endif; ?>

         </div>

         <div class="modal-background" id="<?php echo $post->post_name; ?>" style="display: none;">
            <div class="modal">
               <div class="close" aria-label="close-modal"></div>
               <div class="modal-content">
                  <div class="sq-img">
                     <?php the_post_thumbnail(); ?>
                  </div>
                  <div class="content">
                     <h2><?php the_title(); ?></h2>
                     <?php if( get_field('job_title') ): ?>
                        <p class="title"><?php the_field('job_title'); ?></p>
                     <?php endif; ?>

                     <?php if( get_field('company') ): ?>
                        <p class="company"><?php the_field('company'); ?></p>
                     <?php endif; ?>

                     <?php the_content(); ?>
                  </div>
               </div>
            </div>
         </div>



         <?php endwhile; ?>

         <?php endif; wp_reset_postdata(); ?>

      </div>
   </div>
</section>


</div>
<?php get_footer(); ?>