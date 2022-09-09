<?php /* Template Name: Meetups */ get_header(); ?>

<style>
.hero-standard {
   min-height: <?php echo get_post_meta($post->ID, 'HeroHeight', true);
   ?>vh;
}
</style>
<section class="meetups">

   <header class="hero-standard">
      <div>
         <h1><?php the_title(); ?></h1>
      </div>
      <img src="/wp-content/themes/mlops/assets/img/hero-ep3.jpg" class="Photograph of keyboard warrior">
   </header>
   <div class="meetup-body">
      <div class="meetup-intro" style="padding: 50px 0; color:#000000;">
         <?php the_content(); ?>

      </div>

      <?php
         $cities = get_field('cities');
            if($cities){ 
               ?>
      <div style="background-color:#F7F7F7;" class="meetup-cities">
         <h2>Cities</h2>
         <div class="cities-grid">
            <?php foreach($cities as $city){ 
                     $image = $city['city_image'];
                     $name = $city['city_name'];
                     $url = $city['meetup_url'];
                     $type = $city['meetup_type'];  
                     ?>
            <div class="city">
               <a href="<?php echo $url; ?>">
                  <?php  
                           echo wp_get_attachment_image($image, 'meetup-img');
                           ?>
                  <h3><?php echo $name; ?></h3>
                  <p><?php echo $type; ?></p>
               </a>
            </div>


            <?php }//end while ?>
         </div>
      </div>
      <?php } //end if
         ?>

      <div class="who-meetup" style="padding: 50px 0;">
         <?php 
            if(the_field('who')){
               get_the_field('who');
            }
         ?>
      </div>
      <?php 
         $photos = get_field('photos');
         if($photos){
      ?>
      <div class="photo-slider">
         <?php foreach($photos as $photo){ ?>

         <div class="photo">
            <?php echo wp_get_attachment_image($photo, 'meetup-img');?>
         </div>
      <?php } ?>
      </div>
      <?php
         }
      ?>
   </div>
   <div class="upcoming-events">
      <h2>Upcoming Events</h2>
   </div>
</section>

<?php get_template_part('template-parts/sponsors');?>
<section class="prefooter prefooter--footer-top"></section>



<?php get_footer(); ?>