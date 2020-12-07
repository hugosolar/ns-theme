<?php
/**
 * Generate a exceprt from whatever argument it's passed to it
 *
 * @param object|string|int       $post Post object with excerpt and/or content OR string.
 * @param object|array|string $args Arguments: length, echo, strict mode.
 *
 * @return string Formatted excerpt
 * */
function do_excerpt( $post, $args = null ) {
	$params = wp_parse_args(
		$args,
		array(
			'length'     => 255,
			'echo'       => false,
			'strict'     => false,
			'wrap'       => null,
			'wrap_id'    => null,
			'wrap_class' => 'entry-excerpt',
			'hellip'     => false,
			'append'     => null,
		)
	);
	$out    = $wrap = '';
	if ( $params['wrap'] ) {
		$wrap_id    = $params['wrap_id'] ? ' id="' . esc_attr( $params['wrap_id'] ) . '"' : null;
		$wrap_class = $params['wrap_class'] ? ' class="' . esc_attr( $params['wrap_class'] ) . '"' : null;
		$wrap       = '<' . $params['wrap'] . $wrap_id . $wrap_class . '>';
	}
	if ( is_string( $post ) ) {
		$excerpt = strip_shortcodes( $post );
		$excerpt = strip_tags( $excerpt );
		if ( strlen( $excerpt ) > $params['length'] ) {
			$excerpt = smart_substr( $excerpt, $params['length'] );
			if ( $params['hellip'] ) {
				$excerpt .= ' ' . $params['hellip'];
			}
		}
		if ( $params['append'] ) {
			$excerpt .= ' ' . $params['append'];
		}
		$out .= apply_filters( 'the_excerpt', $excerpt );
	} elseif ( is_object( $post ) ) {
		if ( isset( $post->post_excerpt ) && ! empty( $post->post_excerpt ) ) {
			if ( $params['strict'] && strlen( $post->post_excerpt ) > $params['length'] ) {
				$buff = smart_substr( $post->post_excerpt, $params['length'] );
				if ( $params['hellip'] ) {
					$buff .= ' ' . $params['hellip'];
				}
				if ( $params['append'] ) {
					$buff .= ' ' . $params['append'];
				}
				$out .= apply_filters( 'the_excerpt', $buff );
			} else {
				if ( $params['append'] ) {
					$post->post_excerpt .= ' ' . $params['append'];
				}
				$out .= apply_filters( 'the_excerpt', $post->post_excerpt );
			}
		} elseif ( isset( $post->post_content ) && ! empty( $post->post_content ) ) {
			return do_excerpt( $post->post_content, $params );
		}
	} elseif ( is_int( $post )) {
    $post = get_post( $post );
    return do_excerpt( $post );
  }

	if ( ! $out ) {
		return false;
	}

	if ( $out ) {
		if ( $params['wrap'] ) {
			$wrap .= $out . '</' . $params['wrap'] . '>';
			$out   = $wrap;
		}
		if ( $params['echo'] ) {
			echo $out;
		} else {
			return $out;
		}
	}
}

/**
 * Smarter text cutting
 *
 * @param string  $str : Content to cut.
 * @param string  $char : Characters number to show.
 * @param boolean $hellip : whether to show or not the hellip.
 * @return string Formated text.
 */
function smart_substr( $str, $char, $hellip = true ) {
	if ( strlen( $str ) > $char ) {
		$out = substr( strip_tags( $str ), 0, $char );
		$out = explode( ' ', $out );
		array_pop( $out );
		$out = implode( ' ', $out );
		if ( $hellip ) {
			$out .= ' [&hellip;]';
		}
	} else {
		$out = $str;
	}
	return $out;
}
