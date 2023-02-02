<div class="card <?php if(@$_POST['cat']) {echo 'first-card';}?>">
 <div class="card-header">
    <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h5>
    <span><?php tahaluf_task_posted_on() ?></span>
</div>    
 <div class="card-body">
     <p>
         <?php tahaluf_task_entry_footer(); ?>
     </p>
    <p class="card-text"><?php echo tahaluf_get_post_excerpt(20); ?></p>
    <a href="<?php the_permalink(); ?>" class="see-more-btn">See More</a>
  </div>
</div>