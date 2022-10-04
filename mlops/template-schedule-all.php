<?php /* Template Name: Schedule All */ get_header(); ?>


<section class="schedule">
  
<header class="hero-standard">
	<div>
		<h1><?php the_title(); ?></h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-ep3.jpg" class="Photograph of keyboard warrior">
</header>
  <div class="schedule-body tabs">
<div style="padding:0 0 50px 0; color:#000000;">
	<script async src="https://cse.google.com/cse.js?cx=a5087c92853fcb7fa"></script>
	<div class="gcse-search"></div>
</div>
    <nav class="tab-menu">
      <ul>
        <li><button class="active">All episodes</button></li>
        <li><a href="/watch/past/" style="text-decoration: none;"><button id="tab-2">Past episodes</button></a></li>
      </ul>
    </nav>
    <div class="schedule-events tab tab-1 current" id="tab-1">

		
		<!-- event list start -->
		<?php
		$query = new AirpressQuery();
		$query->setConfig("Schedule List");
		$query->table("Schedule")->view("All");
		$query->sort("DateTime","desc");
	
		$events = new AirpressCollection($query);
		$events->populateRelatedField("Talks", "Talk");
		$events->populateRelatedField("Hosts", "Host");
		$events->populateRelatedField("Speakers", "Speaker");
		?>

		<?php foreach($events as $e): ?>
		<?php

			if(!isset($e["TalkTitle"])): break; endif;
			$speaker_name = $e['SpeakerName'];
			$speaker_avatar = $e['SpeakerAvatar'];
		?>
			<article class="schedule_event h-event">
			<a href="/watch/<?= $e["slug"] ?>">
			<header>
			<div class="schedule_event_tile" style="background-image: url(<?= $e["CoverImage"][0]['thumbnails']['large']['url'] ?>)"></div>
			<div class="schedule_event_speakers">
				<?php foreach($speaker_avatar as $sa): ?>
					<img src="<?= $sa['thumbnails']['large']['url'] ?>">
				<?php endforeach; ?>	  
			</div>
			</header>
			<main class="schedule_event_description">
			<span class="schedule_event_ep"><?= $e["Type"] ?> #<?= $e["EpisodeNumber"] ?></span>
			<h2 class="p-name"><?= $e["TalkTitle"][0] ?></h2>
			<ul class="schedule_event_details">
				<?php foreach($speaker_name as $sn): ?>
				<li><?= $sn ?></li>	
				<?php endforeach; ?>
				<?php if (isset($e["DateString"])): ?> 
					<li><time class="dt-start" datetime="YYY-MM-DD HH:MM"><?= $e["DateString"] ?></time></li>		
				<?php endif ?>		
			</ul>
			</main>
			</a>
			</article>
		<?php endforeach; ?>
		<!-- event list end -->

    </div>
  </div>
</section>

<?php get_template_part('template-parts/sponsors');?>
<section class="prefooter prefooter--footer-top"></section>

		
	</div>
	<?php get_footer(); ?>
