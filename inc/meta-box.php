<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @usage: please read document at project homepage and meta-box-usage.php file
 * @version: 3.0.1
 */

add_action('init', 'initialize_the_meta_boxes');
function initialize_the_meta_boxes() {
	global $options;
	
	// Call taxonomies for select options
	
	$portfolio_terms = get_terms('portfolio_categories', 'hide_empty=0');
	$portfolio_options = array();
	foreach($portfolio_terms as $term) {
		$portfolio_options[$term->slug] = $term->name;
	}
	
	$carousel_terms = get_terms('carousel_categories', 'hide_empty=0');
	$carousel_options = array();
	foreach($carousel_terms as $term) {
		$carousel_options[$term->slug] = $term->name;
	}
	
	$slide_terms = get_terms('slide_categories', 'hide_empty=0');
	$slider_options = array();
	foreach($slide_terms as $term) {
		$slider_options[$term->slug] = $term->name;
	}
	
	$category_terms = get_terms('category', 'hide_empty=0');
	$blog_options = array();
	$blog_options['all'] = "All";
	foreach($category_terms as $term) {
		$blog_options[$term->slug] = $term->name;
	}
	
	// End taxonomy call
	
	$meta_boxes = array();
		
	$mb = new Chimps_Metabox('post_slide_options', __('Response Slider Options', 'response'), array('pages' => array('post')));
	$mb
		->tab("Slider Options")
			->single_image('response_slider_image', __('Slider Image', 'response'), '')
			->text('response_slider_text', __('Slider Text', 'response'), __('Enter your slider text here', 'response'))			
			->checkbox('slider_hidetitle', __('Title Bar', 'response'), '', array('std' => 'on'))
			->single_image('slider_custom_thumb', __('Custom Thumbnail', 'response'), __('Use the image uploader to upload a custom navigation thumbnail', 'response'))
			->sliderhelp('', __('Need Help?', 'response'), '')
		->end();

	$mb = new Chimps_Metabox('pages', 'Response Page Options', array('pages' => array('page')));
	$mb
		->tab("Page Options")
			->image_select('response_page_sidebar', 'Select Page Layout', '',  array('options' => array(TEMPLATE_URL . '/images/options/right.png', TEMPLATE_URL . '/images/options/tworight.png', TEMPLATE_URL . '/images/options/rightleft.png', TEMPLATE_URL . '/images/options/none.png', TEMPLATE_URL . '/images/options/left.png')))
			->checkbox('response_hide_page_title', 'Page Title', '', array('std' => 'on'))
			->section_order('response_page_section_order', 'Page Elements', '', array('options' => array(
					'breadcrumbs' => 'Breadcrumbs',
					'page_slider' => 'iFeature Slider',
					'callout_section' => 'Callout',
					'twitterbar_section' => 'Twitter Bar',
					'portfolio_element' => 'Portfolio',
					'custom_html_element' => 'Custom HTML',
					'product_element' => 'Product',
					'page_section' => 'Page',
					'box_section' => 'Boxes',
					'carousel_section' => 'Carousel',
					'page_nivoslider' => 'NivoSlider'		
					),
					'std' => 'breadcrumbs,page_section'
				))
			->pagehelp('', 'Need Help?', '')
		->tab("Response Slider Options")
			->select('page_slider_size', 'Select Slider Size', '', array('options' => array('Full-Width', 'Half-Width')) )
			->select('page_slider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select('slider_category', 'Custom Slide Category', '', array('options' => $slider_options) )
			->select('slider_blog_category', 'Blog Post Category', '', array('options' => $blog_options, 'all') )
			->text('slider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text('slider_height', 'Slider Height', '', array('std' => '330'))
			->text('slider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select('page_slider_animation', 'Slider Animation Type', '', array('options' => array('Horizontal-Push (default)', 'Fade', 'Horizontal-Slide', 'Vertical-Slide')) )
			->select('page_slider_navigation_style', 'Slider Navigation Style', '', array('options' => array('Dots (default)', 'Thumbnails', 'None')) )
			->select('page_slider_caption_style', 'Slider Caption Style', '', array('options' => array('None (default)', 'Bottom', 'Left', 'Right')) )
			->checkbox('hide_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox('enable_wordthumb', 'WordThumb Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Response NivoSlider Options")
			->select('page_nivoslider_size', 'Select Slider Size', '', array('options' => array('Full-Width', 'Half-Width')) )
			->select('page_nivoslider_type', 'Select Slider Type', '', array('options' => array('Custom Slides', 'Blog Posts')) )
			->select('nivoslider_category', 'Custom Slide Category', '', array('options' => $slider_options) )
			->select('nivoslider_blog_category', 'Blog Post Category', '', array('options' => $blog_options, 'all') )
			->text('nivoslider_blog_posts_number', 'Number of Featured Blog Posts', '', array('std' => '5'))
			->text('nivoslider_height', 'Slider Height', '', array('std' => '330'))
			->text('nivoslider_delay', 'Slider Delay Time (MS)', '', array('std' => '3500'))
			->select('page_nivoslider_animation', 'Slider Animation Type', '', array('options' => array('Random (default)', 'Slice Down', 'Slice Down-Left', 'Slice Up', 'Slice Up-Left', 'Slice Up-Down', 'Slice Up-Down-Left', 'Fold', 'Fade', 'Slide In-Right', 'Slide In-Left', 'Box Random', 'Box Rain', 'Box Rain-Reverse', 'Box Rain-Grow', 'Box Rain-Grow-Reverse')) )
			->select('page_nivoslider_navigation_style', 'Slider Navigation Style', '', array('options' => array('Dots (default)', 'Thumbnails', 'None')) )
			->select('page_nivoslider_caption_style', 'Slider Caption Style', '', array('options' => array('None (default)', 'Bottom', 'Left', 'Right')) )
			->checkbox('nivo_hide_arrows', 'Navigation Arrows', '', array('std' => 'on'))
			->checkbox('nivo_nav_autohide', 'Navigation Arrows Autohide', '', array('std' => 'on'))
			->checkbox('nivo_enable_wordthumb', 'WordThumb Image Resizing', '', array('std' => 'off'))
			->sliderhelp('', 'Need Help?', '')
		->tab("Product Options")
			->select('response_product_text_align', 'Text Align', '', array('options' => array('Left', 'Right')) )
			->text('response_product_title', 'Product Title', '', array('std' => 'Product'))
			->textarea('response_product_text', 'Product Text', '', array('std' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. '))
			->select('response_product_type', 'Media Type', '', array('options' => array('Image', 'Video')) )
			->single_image('response_product_image', 'Product Image', '', array('std' =>  TEMPLATE_URL . '/images/pro/product.jpg'))
			->textarea('response_product_video', 'Video Embed', '')
			->checkbox('response_product_link_toggle', 'Product Link', '', array('std' => 'on'))
			->text('response_product_link_url', 'Link URL', '', array('std' => home_url()))
			->text('response_product_link_text', 'Link Text', '', array('std' => 'Buy Now'))
		->tab("Callout Options")
			->text('callout_title', 'Callout Title', '')
			->textarea('callout_text', 'Callout Text', '')
			->checkbox('disable_callout_button', 'Callout Button', '', array('std' => 'on'))
			->text('callout_button_text', 'Callout Button Text', '')
			->text('callout_url', 'Callout Button URL', '')
			->checkbox('extra_callout_options', 'Custom Callout Options', '', array('std' => 'off'))
			->single_image('callout_image', 'Custom Button Image', '')
			->color('custom_callout_color', 'Custom Background Color', '')
			->color('custom_callout_title_color', 'Custom Title Color', '')
			->color('custom_callout_text_color', 'Custom Text Color', '')
			->color('custom_callout_button_color', 'Custom Button Color', '')
			->color('custom_callout_button_text_color', 'Custom Button Text Color', '')
			->pagehelp('', 'Need help?', '')
		->tab("Portfolio Options")
			->select('portfolio_row_number', 'Images per row', '', array('options' => array('Three (default)', 'Two', 'Four')) )
			->select('portfolio_category', 'Portfolio Category', '', array('options' => $portfolio_options) )
			->checkbox('portfolio_title_toggle', 'Portfolio Title', '')
			->text('portfolio_title', 'Title', '', array('std' => 'Portfolio'))
		->tab("Carousel Options")
			->select('carousel_category', 'Carousel Category', '', array('options' => $carousel_options) )
			->text('carousel_speed', 'Carousel Animation Speed (ms)', '', array('std' => '750'))
		->tab("Custom HTML")
			->textarea('custom_html', 'Enter your custom HTML', '')
		->tab("Twitter Options")
			->text('response_twitter_handle', 'Twitter Handle', 'Enter your Twitter handle if using the Twitter bar')
			->checkbox('response_twitter_reply', 'Show @ Replies', '')
		->tab("SEO Options")
			->text('response_seo_title', 'SEO Title', '')
			->textarea('response_seo_description', 'SEO Description', '')
			->textarea('response_seo_keywords', 'SEO Keywords', '')
			->pagehelp('', 'Need help?', '')
		->end();

	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}

}