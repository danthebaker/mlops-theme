<?php /* Template Name: Episode */ get_header(); ?>
<style>
.hero-episode {
	height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
}
</style>
<article class="episode-article">

<!-- episode start -->
<?php
$query = new AirpressQuery("Schedule", "Episode");
$event_url = basename($_SERVER[REQUEST_URI]);
$record = substr($event_url, strrpos($event_url, '_' )+1);
$query->filterByFormula("{RecordID}='".$record."'");

$event = new AirpressCollection($query);
$event->populateRelatedField("Talks", "Talk");
$event->populateRelatedField("Hosts", "Host");
$event->populateRelatedField("Speakers", "Speaker");
?>
<?php foreach($event as $e): ?>
<header class="hero-episode">
	<div>
		<span><?= $e["Type"] ?> #<?= $e["EpisodeNumber"] ?></span>
		<h1><?= $e["TalkTitle"][0] ?></h1>
	</div>
	<img src="<?= $e["CoverImage"][0][thumbnails][full][url] ?>">
</header>

<?php if ($e["PastEvent"]): ?>
<section class="episode">
	<aside>
		<div class="episode_media">
			<?php if ($e["YouTube"]): ?>
				<div class="video">
					<iframe height="315" width="560" src="https://www.youtube.com/embed/<?= $e["YouTube"] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			<?php endif ?>
			<?php if ($e["AnchorFM"]): ?>
			<div class="video"><iframe height="102" width="560" style="margin-top:30px;" frameborder="0" scrolling="no" src="https://anchor.fm/mlops/embed/episodes/<?= $e["AnchorFM"] ?>"></iframe></div>
			<?php endif ?>
			<?php if ($e["Spotify"]): ?>
				<h4>Listen on</h4>
				<ul>
					<li><a href="https://open.spotify.com/show/<?= $e["Spotify"] ?>" target="_blank"><img src="/wp-content/themes/mlops/assets/img/ico_spotify.png" alt="Logo for Spotify"></a></li>
				</ul>
			<?php endif ?>
		</div>
	</aside>
	<main>

		<p class="episode_intro"><?= $e["TalkAbstract"][0] ?></p>

		<?php if ($e["Transcript"]): ?>
		<h3 class="episode_title">Take-aways</h3>
		<div class="typeset">
			<?= $e["TalkTakeaways"][0] ?>
		</div>
		<?php endif ?>

		<?php if ($e["Transcript"]): ?>
		<h3 class="episode_title">Transcript</h3>
		<div class="typeset">
			<?= $e["Transcript"] ?>
		</div>
		<?php endif ?>

		<h3 class="episode_title">In this episode</h3>


		<div class="episode_speakers">
			<?php if ($e["SpeakerName"][0]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][0][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][0] ?>">
				<h4><?= $e["SpeakerName"][0] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][0] ?></b></p>
				<p><?= $e["SpeakerBio"][0] ?></p>
				<?php if ($e["SpeakerTwitter"][0]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][0] ?>" target="_blank"><?= $e["SpeakerTwitter"][0] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][0]): ?><p><a href="<?= $e["SpeakerLinkedIn"][0] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][1]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][1][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][1] ?>">
				<h4><?= $e["SpeakerName"][1] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][1] ?></b></p>
				<p><?= $e["SpeakerBio"][1] ?></p>
				<?php if ($e["SpeakerTwitter"][1]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][1] ?>" target="_blank"><?= $e["SpeakerTwitter"][1] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][1]): ?><p><a href="<?= $e["SpeakerLinkedIn"][1] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][2]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][2][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][2] ?>">
				<h4><?= $e["SpeakerName"][2] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][2] ?></b></p>
				<p><?= $e["SpeakerBio"][2] ?></p>
				<?php if ($e["SpeakerTwitter"][2]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][2] ?>" target="_blank"><?= $e["SpeakerTwitter"][2] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][2]): ?><p><a href="<?= $e["SpeakerLinkedIn"][2] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][3]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][3][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][3] ?>">
				<h4><?= $e["SpeakerName"][3] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][3] ?></b></p>
				<p><?= $e["SpeakerBio"][3] ?></p>
				<?php if ($e["SpeakerTwitter"][3]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][3] ?>" target="_blank"><?= $e["SpeakerTwitter"][3] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][3]): ?><p><a href="<?= $e["SpeakerLinkedIn"][3] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][0]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][0][thumbnails][large][url] ?>" alt="<?= $e["HostName"][0] ?>">
				<h4><?= $e["HostName"][0] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][0] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][1]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][1][thumbnails][large][url] ?>" alt="<?= $e["HostName"][1] ?>">
				<h4><?= $e["HostName"][1] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][1] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][2]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][2][thumbnails][large][url] ?>" alt="<?= $e["HostName"][2] ?>">
				<h4><?= $e["HostName"][2] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][2] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][3]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][3][thumbnails][large][url] ?>" alt="<?= $e["HostName"][3] ?>">
				<h4><?= $e["HostName"][3] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][3] ?></p>
			</div>	
			<?php endif ?>
		</div>
	</main>
</section>
<?php else: ?>
<section class="episode">
	<aside>
		<div class="episode_speakers">
			<?php if ($e["SpeakerName"][0]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][0][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][0] ?>">
				<h4><?= $e["SpeakerName"][0] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][0] ?></b></p>
				<p><?= $e["SpeakerBio"][0] ?></p>
				<?php if ($e["SpeakerTwitter"][0]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][0] ?>" target="_blank"><?= $e["SpeakerTwitter"][0] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][0]): ?><p><a href="<?= $e["SpeakerLinkedIn"][0] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][1]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][1][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][1] ?>">
				<h4><?= $e["SpeakerName"][1] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][1] ?></b></p>
				<p><?= $e["SpeakerBio"][1] ?></p>
				<?php if ($e["SpeakerTwitter"][1]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][1] ?>" target="_blank"><?= $e["SpeakerTwitter"][1] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][1]): ?><p><a href="<?= $e["SpeakerLinkedIn"][1] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][2]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][2][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][2] ?>">
				<h4><?= $e["SpeakerName"][2] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][2] ?></b></p>
				<p><?= $e["SpeakerBio"][2] ?></p>
				<?php if ($e["SpeakerTwitter"][2]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][2] ?>" target="_blank"><?= $e["SpeakerTwitter"][2] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][2]): ?><p><a href="<?= $e["SpeakerLinkedIn"][2] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			
			</div>	
			<?php endif ?>
			<?php if ($e["SpeakerName"][3]): ?>
			<div>
				<img src="<?= $e["SpeakerAvatar"][3][thumbnails][large][url] ?>" alt="<?= $e["SpeakerName"][3] ?>">
				<h4><?= $e["SpeakerName"][3] ?></h4>
				<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][3] ?></b></p>
				<p><?= $e["SpeakerBio"][3] ?></p>
				<?php if ($e["SpeakerTwitter"][3]): ?><p><a href="https://twitter.com/<?= $e["SpeakerTwitter"][3] ?>" target="_blank"><?= $e["SpeakerTwitter"][3] ?></a></p><?php endif ?>
				<?php if ($e["SpeakerLinkedIn"][3]): ?><p><a href="<?= $e["SpeakerLinkedIn"][3] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][0]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][0][thumbnails][large][url] ?>" alt="<?= $e["HostName"][0] ?>">
				<h4><?= $e["HostName"][0] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][0] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][1]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][1][thumbnails][large][url] ?>" alt="<?= $e["HostName"][1] ?>">
				<h4><?= $e["HostName"][1] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][1] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][2]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][2][thumbnails][large][url] ?>" alt="<?= $e["HostName"][2] ?>">
				<h4><?= $e["HostName"][2] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][2] ?></p>
			</div>	
			<?php endif ?>
			<?php if ($e["HostName"][3]): ?>
			<div>
				<img src="<?= $e["HostAvatar"][3][thumbnails][large][url] ?>" alt="<?= $e["HostName"][3] ?>">
				<h4><?= $e["HostName"][3] ?></h4>
				<p><b style="color: #FD94CE;">Host</b></p>
				<p><?= $e["HostBio"][3] ?></p>
			</div>	
			<?php endif ?>
		</div>
	</aside>
	<main>
		<p class="episode_intro"><?= $e["TalkAbstract"][0] ?></p>

		<?php if ($e["Transcript"]): ?>
		<h3 class="episode_title">Take-aways</h3>
		<div class="typeset">
			<?= $e["TalkTakeaways"][0] ?>
		</div>
		<?php endif ?>
	</main>
</section>
<?php endif ?>
	
<?php endforeach; ?>
<!-- episode end -->
</article>

<section class="related">
  <h5>Upcoming episodes</h5>
  <div class="related_content">

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
?>

<?php $i = 0; foreach($events as $e => $row): ?>
<?php
	if(++$i > 2) break;	
	$speaker_name = $e[SpeakerName];
	$speaker_avatar = $e[SpeakerAvatar];
?>	
		<a href="/watch/<?= $row["slug"] ?>">
			<img src="<?= $row["CoverImage"][0][thumbnails][large][url] ?>">
			<div class="related_caption">
			<span><?= $row["Type"] ?> #<?= $row["EpisodeNumber"] ?></span>
			<h4><?= $row["TalkTitle"][0] ?></h4>
			<h5>
				<?php foreach($speaker_name as $sn): ?>
					<?= $sn ?> 
				<?php endforeach; ?>
			</h5>
			</div>
		</a>
<?php endforeach; ?>
<!-- event list end -->

  </div>
</section>

		
	</div>
	<?php get_footer(); ?>
