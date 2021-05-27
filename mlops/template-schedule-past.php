<?php /* Template Name: Schedule Past */ get_header(); ?>
<style>
.hero-standard {
	min-height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
}
</style>
<section class="schedule">
  
<header class="hero-standard">
	<div>
		<h1><?php the_title(); ?></h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-ep3.jpg" class="Photograph of keyboard warrior">
</header>

  <div class="schedule-body tabs">
    <nav class="tab-menu">
      <ul>
        <li><a href="/watch/" style="text-decoration: none;"><button>All episodes</button></a></li>
        <li><button class="active">Past episodes</button></li>
      </ul>
    </nav>
    <div class="schedule-events schedule-events--past tab tab-2 current" id="tab-2">

<!-- event list start -->
<?php
$query = new AirpressQuery();
$query->setConfig("Schedule List");
$query->table("Schedule")->view("Past");
$query->sort("DateTime","desc");

$events = new AirpressCollection($query);
$events->populateRelatedField("Talks", "Talk");
$events->populateRelatedField("Hosts", "Host");
$events->populateRelatedField("Speakers", "Speaker");
?>

<?php foreach($events as $e): ?>
<?php
 $speaker_name = $e[SpeakerName];
 $speaker_avatar = $e[SpeakerAvatar];
?>
	<article class="schedule_event h-event">
	<a href="/watch/<?= $e["slug"] ?>">
	<header>
	<div class="schedule_event_tile" style="background-image: url(<?= $e["CoverImage"][0][thumbnails][large][url] ?>)"></div>
	<div class="schedule_event_speakers">
		<?php foreach($speaker_avatar as $sa): ?>
			<img src="<?= $sa[thumbnails][large][url] ?>">
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
		<?php if ($e["DateString"] != ""): ?> 
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

<section class="prefooter">
  <h5>Sponsors</h5>
  <ul class="sponsors-grid">
    <li><a href="https://www.tecton.ai" target="_blank"><img src="/wp-content/themes/mlops/assets/img/logo-tecton.jpg" alt="Tecton logo"></a></li>
    <li><a href="https://ydata.ai" target="_blank"><img src="/wp-content/themes/mlops/assets/img/logo-ydata.jpg" alt="YData logo"></a></li>
  </ul>
</section>

		
	</div>
	<?php get_footer(); ?>
