<?php

function rab_theme_support(){
  // Adds dynamic title tag support
  add_theme_support('title-tag');
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'rab_theme_support');

function rab_menus(){

  $locations = array(
    'primary' => "Desktop Primary Top Sidebar",
    'footer' => "Footer Menu Items"
  );

  register_nav_menus($locations);
}

add_action('init', 'rab_menus');

function rab_register_styles(){

$version = wp_get_theme()->get( 'Version' );
wp_enqueue_style('rab-style', get_template_directory_uri() . "/style.css", array('rab-bootstrap'), $version, 'all');
wp_enqueue_style('rab-bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css", array(), '4.4.1', 'all');
wp_enqueue_style('rab-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css", array(), '5.13.0', 'all');
}

add_action( 'wp_enqueue_scripts', 'rab_register_styles');

function rab_register_scripts(){

  wp_enqueue_script('rab-jquery', "https://code.jquery.com/jquery-3.4.1.slim.min.js", array(), '3.4.1', true);
  wp_enqueue_script('rab-popper', "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", array(), '1.16.0', true);
  wp_enqueue_script('rab-bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js", array(), '4.4.1', true);
  wp_enqueue_script('rab-main', get_template_directory_uri() . "/assets/js/main.js", array(), "1.0", true);
}

add_action( 'wp_enqueue_scripts', 'rab_register_scripts');

function rab_widget_areas(){

  register_sidebar(
    array(
      'before_title' => '<div class="widget-title">',
      'after_title' => '</div>',
      'before_widget' => '<ul class="social-list list-inline mx-auto">',
      'after_widget' => '</ul>',
      'name' => 'Sidebar Area',
      'id' => 'sidebar-1',
      'description' => 'Sidebar Widget Area'
    )
  );

  register_sidebar(
    array(
      'before_title' => '',
      'after_title' => '',
      'before_widget' => '',
      'after_widget' => '',
      'name' => 'Footer Area',
      'id' => 'footer-1',
      'description' => 'Footer Widget Area'
    )
  );
}

add_action( 'widgets_init', 'rab_widget_areas');

function set_offset($id, $main_post_id){
  $offset_post = wp_get_recent_posts(array(
    'numberposts' => 1,
    'category' => $id,
    'post_status' => 'publish'
  ));
  $offset_post_id;
  foreach($offset_post as $post):
    $offset_post_id = $post['ID'];
  endforeach;	
  if ($offset_post_id === $main_post_id) {
    return 1;
  } else {
    return 0;
  }
}

?>