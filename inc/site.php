<?php 
/**
 * Common use methods acrros the site
 */

class ns {
  static function get_latest_posts( $size = 3, $post_type = 'post', $category = null ) {
    $params = array(
      'post_type' => $post_type,
      'posts_per_page' => $size,
      'post_status' => 'publish'
    );
    if ( !empty( $category ) ) {
      $params['category_name'] = $category;
    }
    $query = new WP_Query( $params );
    if ( $query->have_posts() ) {
      return $query->posts;
    } else {
      return null;
    }
  }
  static function get_background_image( $post_id ) {
    // make sure ACF plugin is activated
    if ( function_exists( 'get_field' ) ) {
      $image_field = get_field( 'hero_image', $post_id );
      return wp_get_attachment_image( $image_field, 'landscape-hero' );
    } else {
      return get_the_post_thumbnail( $post_id, 'landscape-hero' );
    }
  }
  static function get_hero_content( $post_id ) {
    if ( function_exists( 'get_field' ) ) {
      return get_field( 'hero_text', $post_id );
    }
  }
}