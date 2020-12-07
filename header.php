<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
  <header class="main-header">
    <div class="container">
      <div class="brand">
        <h1 class="site-brand"><a href="<?php bloginfo('url') ?>"><span class="dashicons dashicons-pets"></span> NS</a></h1>
      </div>
      <nav class="main-navigation">
        <?php 
          wp_nav_menu(
            array(
              'theme_location'  => 'main-navigation',
              'depth'           => 2,
              'container'       => '',
              'menu_id'         => 'primary-menu',
              'items_wrap'      => '<ul id = "%1$s" class = "nav %2$s">%3$s</ul>',
              'walker'          => new bs4Navwalker(),
            )
          );
        ?>
      </nav>
    </div>
  </header>