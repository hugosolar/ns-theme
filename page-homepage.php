<?php 
  // Template name: Homepage
  get_header();
  the_post();
?>
<section class="main_content">
  <?php get_template_part( 'inc/partials/home/home', 'hero' ); ?>
  <?php get_template_part( 'inc/partials/home/home', 'entries' ); ?>
</section>
<?php get_footer(); ?>