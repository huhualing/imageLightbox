<?php
/*
Plugin Name: imageLightbox
Plugin URI: https://github.com/bjornjohansen/imageLightbox
Description: Image Lightbox, Responsive and Touch‑friendly
Version: 0.1
Author: Bjørn Johansen
Author URI: https://bjornjohansen.no
Text Domain: imagelightbox
License: GPL2

    Copyright 2014  Bjørn Johansen  (email : post@bjornjohansen.no)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

new BJ_ImageLightbox;

class BJ_ImageLightbox {

	const version = '0.1';

	function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ) );
		add_filter( 'bj_lazy_load_html', array( __CLASS__, 'filter' ), 10, 1 );
	}

	function enqueue_scripts_and_styles() {
		if ( defined( 'SCRIPT_DEBUG') && SCRIPT_DEBUG && false ) {
			wp_enqueue_script( 'imageLightbox', plugins_url( '/js/imagelightbox.js', __FILE__ ), array( 'jquery' ), self::version, true );
			wp_enqueue_script( 'imageLightbox-init', plugins_url( '/js/imagelightbox-init.js', __FILE__ ), array( 'jquery', 'imageLightbox' ), self::version, true );
		} else {
			wp_enqueue_script( 'imageLightbox', plugins_url( '/js/combined.min.js', __FILE__ ), array( 'jquery' ), self::version, true );
		}

		if ( apply_filters( 'imageLightbox_include_css', true ) ) {
			wp_enqueue_style( 'imagelightbox-styles', plugins_url( '/css/styles.css', __FILE__ ), null, self::version );
		}

	}

}
