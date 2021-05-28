<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '' ); ?></title>
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