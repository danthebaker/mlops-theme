<?php /* Template Name: Homepage */ get_header(); ?>
<style>
.hero-home {
	height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
}
</style>

<section class="home">
  
	<header class="hero-home">
		<div>
			<h1><?php the_title(); ?></h1>
		</div>
		<img src="/wp-content/themes/mlops/assets/img/bkg3.jpg" class="Photograph of keyboard warrior">
	</header>

	<?php the_content(); ?>

	<!-- event list start -->
	<?php 
	$query = new AirpressQuery();
    $query->setConfig("Schedule List");
    $query->table("Schedule")->view("Future");
    $query->sort("DateTime","desc");

    $events = new AirpressCollection($query);
    $events->populateRelatedField("Talks", "Talk");
    $events->populateRelatedField("Hosts", "Host");
    $events->populateRelatedField("Speakers", "Speaker");

    $i = 0;
    $upcoming_episodes_html = '';

    foreach($events as $e => $row):

        $talk_title = isset($row['TalkTitle']) ? $row['TalkTitle'] : '';

        if(!$talk_title) break;

        if(++$i > 2) break;

        $speaker_name = $row['SpeakerName'];
        $speaker_avatar = $row['SpeakerAvatar'];
        
        $upcoming_episodes_html .= '
        <article class="schedule_event h-event">
            <a href="/watch/'.$row["slug"].'">
            <header>
                <div class="schedule_event_tile" style="background-image: url('.$row["CoverImage"][0]['thumbnails']['large']['url'].')"></div>
                <div class="schedule_event_speakers">';
                    foreach($speaker_avatar as $sa):
                        $upcoming_episodes_html .= '<img src="'.$sa['thumbnails']['large']['url'].'">';
                    endforeach; 
        $upcoming_episodes_html .='</div>
            </header>
            <main class="schedule_event_description">
            <span class="schedule_event_ep">'.$row["Type"].' #'.$row["EpisodeNumber"].'</span>
            <h2 class="p-name">'.$row["TalkTitle"][0].'</h2>
            <ul class="schedule_event_details">';

                foreach($speaker_name as $sn):
                    $upcoming_episodes_html .= '<li>'.$sn.'</li>';
                endforeach;
                
                if (isset($row["DateString"])):
                    $upcoming_episodes_html .= '<li><time class="dt-start" datetime="YYY-MM-DD HH:MM">'.$row["DateString"].'</time></li>';
                endif;
        $upcoming_episodes_html .= '</ul>
            </main>
            </a>
            </article>';
    endforeach;

	if($upcoming_episodes_html != ''){
		?>
		<div class="schedule-body">
			<h2>Upcoming episodes</h2>
			<div class="schedule-home">
				<?php echo $upcoming_episodes_html; ?>
			</div>
		</div>
		<?php
	}
	?>
	<!-- event list end -->
	
</section>

<?php get_template_part('template-parts/sponsors');?>

<section class="prefooter prefooter--ctas">
  <h5>Ways to get involved</h5>
  <div class="cta-block">
    <a href="https://go.mlops.community/slack">
      <svg class="icon_slack_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#slack"></use></svg>
      <h6>Slack</h6>
      <p>Join us to share and ask questions about pertinent MLOps topics</p>
    </a>
    <a href="https://go.mlops.community/medium">
      <svg class="icon_slack_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#medium"></use></svg>
      <h6>Medium</h6>
      <p>Follow our blog and random articles written by the community</p>
    </a>
    <a href="/newsletter/">
      <svg class="icon_newsletter_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#newsletter"></use></svg>
      <h6>Get our newsletter</h6>
      <p>Weekly roundups of everything happening in the MLOps Community</p>
    </a>
    <a href="https://go.mlops.community/youtube">
      <svg class="icon_youtube_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#youtube"></use></svg>
      <h6>YouTube</h6>
      <p>Watch all our latest videos as soon as they are released</p>
    </a>
    <a href="https://go.mlops.community/linkedin">
      <svg class="icon_linkedin_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#linkedin"></use></svg>
      <h6>LinkedIn</h6>
      <p>Give us a follow on the professional social network</p>
    </a>
  </div>
</section>

		
</div>
<?php get_footer(); ?>
