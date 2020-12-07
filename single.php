<?php 
  get_header();
  the_post();
?>
<section class="main-content">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-8 col-xs-12">
        <header class="entry-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        <?php 
            if ( function_exists( 'get_field' ) && !empty( get_field( 'entry_image' ) ) )  {
              echo '<figure class="entry-thumbnail">';
                echo wp_get_attachment_image( get_field( 'entry_image' ), 'landscape-medium' );
              echo '</figure>';
            }
        ?>
        <div class="content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>