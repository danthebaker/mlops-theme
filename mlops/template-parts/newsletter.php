<?php

if($newsletter_content = get_field('newsletter_subscription_section_content', 'options')){
    printf('<section class="newsletter-signup"><div class="content">%s</div></section>', $newsletter_content);
}
?>

