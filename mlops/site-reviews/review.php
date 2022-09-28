<?php defined('ABSPATH') || die; ?>

<div class="glsr-review" id="review-{{ review_id }}" data-assigned='{{ assigned }}'>
    {{ title }}
    {{ rating }}
    {{ date }}
    {{ assigned_links }}
    {{ content }}
    <?php echo reviewer( $review->author_id, $review ); ?>
    {{ response }}
</div>
