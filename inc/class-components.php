<?php
class components {
  public static function card( $post_id ) {
    $out = '';
    $has_image_class = ( has_post_thumbnail( $post_id ) || !empty( get_field( 'entry_image', $post_id) ) ) ? ' has-image' : '';
    $out .= '<article class="card entry-card card-post'.$has_image_class.'">';
      if ( !empty( $has_image_class ) ) {
        $out .= '<a href="'.get_permalink( $post_id ).'">';
          $out .= '<figure class="card-image">';
            if ( function_exists( 'get_field' ) ) {
              $out .= wp_get_attachment_image( get_field( 'entry_image', $post_id), 'landscape-small', false, array( 'class' => 'card-img-top' ) );
            } else {
              $out .= get_the_post_thumbnail( $post_id, 'landscape-small', array( 'class' => 'card-img-top' ) );
            }
          $out .= '</figure>';
        $out .= '</a>';
      }
      $out .= '<div class="card-body">';
        $out .= '<h3 class="entry-title">'.get_the_title( $post_id ).'</h3>';
        $out .= '<div class="entry-summary">'.do_excerpt( $post_id ).'</div>';
        $out.= '<a href="'.get_permalink( $post_id ).'" class="btn btn-primary btn-sm">View more</a>';
      $out .= '</div>';
    $out .= '</article>';
    return $out;
  }
}