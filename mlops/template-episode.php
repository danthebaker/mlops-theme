<?php /* Template Name: Episode */ ?>
<?php
$query = new AirpressQuery("Schedule", "Episode");
$event_url = basename($_SERVER['REQUEST_URI']);
$record = substr($event_url, strrpos($event_url, '_' )+1);
$query->filterByFormula("{RecordID}='".$record."'");

$event = new AirpressCollection($query);
$event->populateRelatedField("Talks", "Talk");
$event->populateRelatedField("Hosts", "Host");
$event->populateRelatedField("Speakers", "Speaker");

function output_speakers_hosts($e){

	// Speakers

	for($si = 1; $si <=4; $si++){
		$count = $si;
		$index = $si - 1;
		if(count($e["SpeakerName"]) >= $count && $e["SpeakerName"][$index]):
		?>
		<div>
			<img src="<?= $e["SpeakerAvatar"][$index]['thumbnails']['large']['url'] ?>" alt="<?= $e["SpeakerName"][$index] ?>">
			<h4><?= $e["SpeakerName"][$index] ?></h4>
			<p><b style="color: #FD94CE;"><?= $e["SpeakerPosition"][$index] ?></b></p>
			<p><?= $e["SpeakerBio"][0] ?></p>
			<?php if (isset($e["SpeakerTwitter"], $e["SpeakerTwitter"][$index])): ?><p><a href="<?= $e["SpeakerTwitter"][$index] ?>" target="_blank">Twitter</a></p><?php endif ?>
			<?php if (isset($e["SpeakerLinkedIn"], $e["SpeakerLinkedIn"][$index])): ?><p><a href="<?= $e["SpeakerLinkedIn"][$index] ?>" target="_blank">LinkedIn</a></p><?php endif ?>
		</div>	
		<?php

		endif;
	}


	// Hosts

	for($si = 1; $si <=4; $si++){
		$count = $si;
		$index = $si - 1;
		if(count($e["HostName"]) >= $count && $e["HostName"][$index]):
		?>
		<div>
			<img src="<?= $e["HostAvatar"][$index]['thumbnails']['large']['url'] ?>" alt="<?= $e["HostName"][$index] ?>">
			<h4><?= $e["HostName"][$index] ?></h4>
			<p><b style="color: #FD94CE;">Host</b></p>
			<p><?= $e["HostBio"][$index] ?></p>
		</div>		
		<?php

		endif;
	}
}
?>
<?php foreach($event as $e): ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta name="google-site-verification" content="jyVPI0wmsbnR3dh3ITnqf3Qdhbprbo8TUP5S6uzt3b0" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?= $e["TalkTitle"][0] ?></title>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/mlops/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/mlops/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/mlops/assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="/wp-content/themes/mlops/assets/favicons/site.webmanifest">
    <link rel="mask-icon" href="/wp-content/themes/mlops/assets/favicons/safari-pinned-tab.svg" color="#c33082">
    <meta name="msapplication-TileColor" content="#c33082">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <a class="skiplink" href="#bodycontent">Skip to content</a>
    <div id="uicontainer" class="uicontainer l-<?php echo get_post_meta($post->ID, 'Class', true); ?>">
	
      <header class="header">
        <a href="/" rel="home" class="logo">
          <svg width="42" height="47" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 47V40.1971H10.0338C12.3865 40.1971 14.3046 38.2785 14.3046 35.9156V32.3293C14.3046 30.4547 15.8276 28.9278 17.6975 28.9278H41.0044V35.7307H17.6975C15.3448 35.7307 13.4267 37.6493 13.4267 40.0123V43.5985C13.4267 45.4731 11.9036 47 10.0338 47H0Z" fill="white"/>
          <path d="M0 25.8608H10.0338C12.3865 25.8608 14.3046 23.9422 14.3046 21.5793V17.993C14.3046 16.1184 15.8276 14.5915 17.6975 14.5915H24.3428V21.3944H17.6931C15.3404 21.3944 13.4223 23.313 13.4223 25.676V29.2622C13.4223 31.1368 11.8993 32.6637 10.0294 32.6637H0V25.8608Z" fill="white"/>
          <path d="M0 11.2649H10.0338C12.3865 11.2649 14.3046 9.34632 14.3046 6.98334V3.40146C14.3046 1.52692 15.8276 0 17.6975 0H24.3428V6.80292H17.6931C15.3404 6.80292 13.4223 8.72147 13.4223 11.0844V14.6707C13.4223 16.5453 11.8993 18.0722 10.0294 18.0722H0V11.2649Z" fill="white"/>
          </svg>
          <span>MLOps Community</span>
        </a>
        <div class="navigation">
          <button class="nav-toggle" id="nav-toggle" aria-label="Main menu" aria-expanded="false" aria-controls="nav-main"><span>Menu</span></button>
          <nav id="nav-main">
            <?php html5blank_nav(); ?>
          </nav>
        </div>
      </header>
	
	<div id="bodycontent">
<style>
.hero-episode {
	height: <?php echo get_post_meta($post->ID, 'HeroHeight', true); ?>vh;
}
</style>
<article class="episode-article">

<!-- episode start -->
<header class="hero-episode">
	<div>
		<span><?= $e["Type"] ?> #<?= $e["EpisodeNumber"] ?></span>
		<h1><?= $e["TalkTitle"][0] ?></h1>
	</div>
	<img src="<?= $e["CoverImage"][0]['thumbnails']['full']['url'] ?>">
</header>

<?php if ($e["PastEvent"]): ?>
<section class="episode">
	<aside>
		<div class="episode_media">
			<?php if (isset($e["YouTube"])): ?>
				<div class="video">
					<iframe height="315" width="560" src="https://www.youtube.com/embed/<?= $e["YouTube"] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			<?php endif ?>
			<?php if (isset($e["AnchorFM"])): ?>
			<div class="video"><iframe height="102" width="560" style="margin-top:30px;" frameborder="0" scrolling="no" src="https://anchor.fm/mlops/embed/episodes/<?= $e["AnchorFM"] ?>"></iframe></div>
			<?php endif ?>
			<?php if (isset($e["Spotify"])): ?>
				<h4>Listen on</h4>
				<ul>
					<li><a href="https://open.spotify.com/show/<?= $e["Spotify"] ?>" target="_blank"><img src="/wp-content/themes/mlops/assets/img/ico_spotify.png" alt="Logo for Spotify"></a></li>
				</ul>
			<?php endif ?>
		</div>
	</aside>
	<main>

		<p class="episode_intro"><?= $e["TalkAbstract"][0] ?></p>

		<?php if (isset($e["TalkTakeaways"])): ?>
		<h3 class="episode_title">Take-aways</h3>
		<div class="typeset" style="color: #e4e4f0; font-size: 1rem;">
			<?= $e["TalkTakeaways"][0] ?>
		</div>
		<?php endif ?>

		<?php if (isset($e["Transcript"])): ?>
		<h3 class="episode_title">Transcript</h3>
		<div class="typeset" style="color: #e4e4f0; font-size: 1rem;">
			<?= $e["Transcript"] ?>
		</div>
		<?php endif ?>

		<h3 class="episode_title">In this episode</h3>


		<div class="episode_speakers">
			<?php output_speakers_hosts($e); ?>
		</div>
	</main>
</section>
<?php else: ?>
<section class="episode">
	<aside>
		<div class="episode_speakers">
			<?php output_speakers_hosts($e); ?>
		</div>
	</aside>
	<main>
		<p class="episode_intro"><?= $e["TalkAbstract"][0] ?></p>
		
		<?php if (isset($e["TalkTakeaways"])): ?>
		<h3 class="episode_title">Take-aways</h3>
		<div class="typeset" style="color: #e4e4f0; font-size: 1rem;">
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
	$talk_title = isset($row['TalkTitle']) ? $row['TalkTitle'] : '';

    if(!$talk_title) break;

    $speaker_name = $row['SpeakerName'];
    $speaker_avatar = $row['SpeakerAvatar'];
?>	
		<a href="/watch/<?= $row["slug"] ?>">
			<img src="<?= $row["CoverImage"][0]['thumbnails']['large']['url'] ?>">
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
