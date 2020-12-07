<?php 
  $last_entries = ns::get_latest_posts( 4 );
  if ( !empty( $last_entries ) ):
 ?>
<section class="home-entries move-up">
  <div class="container">
    <div class="row">
    <?php 
      foreach ( $last_entries as $entry ) {
        echo '<div class="col-md-4 col-lg-3 col-sm-6">';
        echo components::card( $entry->ID );
        echo '</div>';
      }
    ?>
    </div>
  </div>
</section>
<?php endif; ?>