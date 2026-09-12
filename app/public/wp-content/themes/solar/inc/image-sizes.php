<?php

function register_hero_photo_size() {
    add_image_size( 'mobile-content', 400, 9999 );
    add_image_size( 'small-200', 200, 9999 );
    add_image_size( 'small-100', 100, 9999 );
    add_image_size( 'mobile-background', 450, 9999 );
}
add_action( 'after_setup_theme', 'register_hero_photo_size' );