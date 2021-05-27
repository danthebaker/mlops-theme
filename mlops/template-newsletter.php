<?php /* Template Name: Newsletter */ get_header(); ?><div id="uicontainer" class="uicontainer l-">
	
	<header class="header">
		<a href="/" rel="home" class="logo"><svg width="42" height="47" viewBox="0 0 42 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0 47V40.1971H10.0338C12.3865 40.1971 14.3046 38.2785 14.3046 35.9156V32.3293C14.3046 30.4547 15.8276 28.9278 17.6975 28.9278H41.0044V35.7307H17.6975C15.3448 35.7307 13.4267 37.6493 13.4267 40.0123V43.5985C13.4267 45.4731 11.9036 47 10.0338 47H0Z" fill="white"/>
<path d="M0 25.8608H10.0338C12.3865 25.8608 14.3046 23.9422 14.3046 21.5793V17.993C14.3046 16.1184 15.8276 14.5915 17.6975 14.5915H24.3428V21.3944H17.6931C15.3404 21.3944 13.4223 23.313 13.4223 25.676V29.2622C13.4223 31.1368 11.8993 32.6637 10.0294 32.6637H0V25.8608Z" fill="white"/>
<path d="M0 11.2649H10.0338C12.3865 11.2649 14.3046 9.34632 14.3046 6.98334V3.40146C14.3046 1.52692 15.8276 0 17.6975 0H24.3428V6.80292H17.6931C15.3404 6.80292 13.4223 8.72147 13.4223 11.0844V14.6707C13.4223 16.5453 11.8993 18.0722 10.0294 18.0722H0V11.2649Z" fill="white"/>
</svg>
<span>MLOps Community</span></a>
		<div class="navigation">
			<button class="nav-toggle" id="nav-toggle" aria-label="Main menu" aria-expanded="false" aria-controls="nav-main"><span>Menu</span></button>
			<nav id="nav-main">
				<ul>
					<li ><a href="/watch/">Watch</a></li>
					<li ><a href="/learn/">Learn</a></li>
					<li ><a href="/blog/">Blog</a></li>
				</ul>
			</nav>
		</div>
	</header>
	
	<div id="bodycontent">
		
<section class="page">
  
<header class="hero-default">
	<div>
		<h1>Newsletter</h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-learn2.jpg" class="News">
</header>

  <div class="page_body">
    <article class="newsletter">
      <main>
        <h2 class="h3">Sign up to our newsletter for free updates, once a month. No spam, ever</h2>
        <form>
          <fieldset>
            <div class="formfield">
              
<div class="form-element">
	<label for="name">Full name</label>
	  <input 
	  	type="text" 
	  	value="" 
	  	id="name" 
	  	placeholder="" 
	  	autocomplete=""
		required 
		aria-required="true"
	  >
	  <div class="form-element__notes"></div>
</div>

            </div>
            <div class="formfield formfieldSpaced">
               
<div class="form-element">
	<label for="email">Email</label>
	  <input 
	  	type="email" 
	  	value="" 
	  	id="email" 
	  	placeholder="" 
	  	autocomplete="email"
		required 
		aria-required="true"
	  >
	  <div class="form-element__notes"></div>
</div>

            </div>
          </fieldset>
          <div class="formfield formfieldSpaced">
            
            

<button type="submit" class="button buttonPrimary">Submit form</button>


          </div>
        </form>
      </main>
    </article>
  </div>
</section>

		
	</div>
	<?php get_footer(); ?>
