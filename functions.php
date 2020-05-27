<?php

namespace Taylor;

use Taylor\Bootstrapper;

include_once( get_stylesheet_directory() . '/inc/classes/class-bootstrapper.php' );

(new Bootstrapper)->init();