<?php
/**
 * FIXME: Edit Title Content
 *
 * FIXME: Edit Description Content
 *
 * Please do not edit this file. This file is part of the Response core framework and all modifications
 * should be made in a child theme.
 * FIXME: POINT USERS TO DOWNLOAD OUR STARTER CHILD THEME AND DOCUMENTATION
 *
 * @category Response
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

function response_init_carousel_post_type() {
	register_post_type( 'featured_posts',
		array(
			'labels' => array(
				'name' => __( 'Carousel', 'response'),
				'singular_name' => __( 'Posts', 'response'),
			),
			'public' => true,
			'show_ui' => true, 
			'supports' => array('custom-fields'),
			'taxonomies' => array( 'carousel_categories'),
			'has_archive' => true,
			'menu_icon' => get_template_directory_uri() . '/core/lib/images/custom-types/carousel.png',
			'rewrite' => array('slug' => 'slides')
		)
	);
	
	$meta_boxes = array();
		
	$mb = new Chimps_Metabox('Carousel', 'Featured Post Carousel', array('pages' => array('featured_posts')));
	$mb
		->tab("Featured Post Carousel Options")
			->text('post_title', 'Featured Post Title', '')
			->single_image('post_image', 'Featured Post Image', '')
			->text('post_url', 'Featured Post URL', '')
			->reorder('reorder_id', 'Reorder Name', 'Reorder Desc' )
		->end();
}
add_action( 'init', 'response_init_carousel_post_type' );