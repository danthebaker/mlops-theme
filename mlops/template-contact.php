<?php /* Template Name: Contact */ get_header(); ?>
		
<section class="page">
  
<header class="hero-default">
	<div>
		<h1>Contact MLOps Community</h1>
	</div>
	<img src="/wp-content/themes/mlops/assets/img/hero-learn3.jpg" class="Contact us">
</header>

  <div class="page_body">
    <article class="contact">
      <main>
        <h2>Ask a question or submit an idea for a future episode</h2>
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
            <div class="formfield formfieldSpaced">
              
<div class="form-element">
	<label for="textarea">Comments <span>(Optional)</span></label>
	  <textarea
	  	value="" 
	  	id="textarea"  
	  ></textarea> 
	   <div class="form-element__notes"></div>
</div>

            </div>
          </fieldset>
          <div class="formfield formfieldSpaced">
            
            

<button type="submit" class="button buttonPrimary">Submit form</button>


          </div>
        </form>
      </main>
      <aside>
        <h3>Get in touch</h3>
        <ul>
         <li><a href=""><svg class="icon_slack_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#slack"></use></svg>Slack</a></li>
         <li><a href=""><svg class="icon_twitter_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#twitter"></use></svg>Twitter</a></li>
         <li><a href=""><svg class="icon_linkedin_svg"><use xlink:href="/wp-content/themes/mlops/assets/icons/renders/sprite.svg#linkedin"></use></svg>LinkedIn</a></li>
        </ul>
      </aside>
    </article>
  </div>
</section>

		
	</div>
	<?php get_footer(); ?>
