<footer class="footer">
	  <div class="footer_links">
		  <div>
			<img class="footer-logo" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-mlops-white.svg" alt="MLOps Community" width="120" height="49" style="width: 120px; height: 49px;">

			<p class="footer_feet desktop">&copy;<?php echo date('Y'); ?> MLOps Community. All rights reserved unless states. Images provided by <a href="https://unsplash.com" target="_blank">Unsplash.com</a> and <a href="https://pexels.com" target="_blank">pexels.com</a>. <span>Made with &hearts;, tea and biscuits.</span></p>
		  </div>
		<div class="menus-wrapper">
			<?php
			$theme_locations = get_nav_menu_locations();

			for($i = 1; $i <= 3; $i++){
				if(array_key_exists('footer-menu-'.$i, $theme_locations)):
					$menuID = $theme_locations['footer-menu-'.$i];
					$nav_menu = wp_get_nav_menu_object( $menuID1 );
					$arg_f = array(
						'theme_location'  => 'footer-menu-'.$i,
						'container'       => '',
						'menu_class'      => '',
						'depth'				=> 1,
						'items_wrap'        => '<ul>%3$s</ul>',
						'fallback_cb'	  => false,
						'echo'		=> 1
					);
					wp_nav_menu( $arg_f );
				endif;
			}
			
			?>
		</div>
		<!-- <ul>
		  <li><a href="/">Home</a></li>
		  <li><a href="/learn/">Learn</a></li>
		  <li><a href="/watch/">Watch</a></li>
		  <li><a href="/blog/">Blog</a></li>
		</ul>
		<ul>
		  <li><a href="/contact/">Contact</a></li>
		  <li><a href="/privacy/">Privacy</a></li>
		  <li><a href="/cookies/">Cookies</a></li>
		  <li><a href="/terms/">Terms</a></li>
		</ul>
		<ul>
		  <li><a href="https://go.mlops.community/slack" target="_blank"><svg class="icon_slack_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#slack"></use></svg>Slack</a></li>
		  <li><a href="https://go.mlops.community/youtube" target="_blank"><svg class="icon_youtube_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#youtube"></use></svg>YouTube</a></li>
		  <li><a href="https://go.mlops.community/medium" target="_blank"><svg class="icon_medium_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#medium"></use></svg>Medium</a></li>
		</ul>
		<ul>
		  <li><a href="https://go.mlops.community/twitter" target="_blank"><svg class="icon_twitter_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#twitter"></use></svg>Twitter</a></li>
		  <li><a href="https://go.mlops.community/linkedin" target="_blank"><svg class="icon_linkedin_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#linkedin"></use></svg>LinkedIn</a></li>
		  <li><a href="https://go.mlops.community/newsletter" target="_blank"><svg class="icon_newsletter_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#newsletter"></use></svg>Newsletter</a></li>
		</ul> -->
	  </div>
	  <p class="footer_feet mobile">&copy;<?php echo date('Y'); ?> MLOps Community. All rights reserved unless states. Images provided by <a href="https://unsplash.com" target="_blank">Unsplash.com</a> and <a href="https://pexels.com" target="_blank">pexels.com</a>. <span>Made with &hearts;, tea and biscuits.</span></p>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>