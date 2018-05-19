<?php

namespace AdvancedGutenbergBlocks\Services;

use AdvancedGutenbergBlocks\Helpers\Dashicons;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

/**
 * Handle blocks registration
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Blocks {

	// Blocks are ranked in categories
	protected $categories;

	public function __construct() {
		$this->set_categories();
	}

	public function get_registered_blocks() {
		global $AdvancedGutenbergBlocks;

		return $AdvancedGutenbergBlocks->get_blocks();
	}

	public function get_disabled_blocks() {
		$blocks = get_option( 'gutenberg-blocks-disabled' );

		// Disable WooCommerce blocks if Woo is not active
		if ( ! class_exists( 'WooCommerce' ) && isset( $this->registered_blocks ) ) {
			foreach ( $this->registered_blocks as $block ) {

				if ( $block['category'] == "woo" ) {
					$blocks[] = $block['id'];
				}
			}
		}

		if ( $blocks == "" ) {
			return array();
		}

		return $blocks;
	}

	public function get_disabled_blocks_js() {

		$blocks = $this->get_disabled_blocks();

		return json_encode($blocks);

	}

	public function set_disabled_blocks($blocks) {
		update_option('gutenberg-blocks-disabled', $blocks);
	}


	// Catégories

	public function set_categories() {
		$categories = array(
			'common'    => __( 'Common', 'gutenblobks' ),
			'woo' 	    => __( 'WooCommerce', 'gutenblobks' ),
			'marketing' => __( 'Marketing', 'gutenblobks' ),
			'apis' 	    => __( 'External content', 'gutenblobks' ),
		);

		$categories = apply_filters( 'gutenberg-blocks/register-block', $categories );

		$this->categories = $categories;
	}

	public function get_categories() {
		return $this->categories;
	}


	public function get_native_blocks_categories() {
		return array(
			'common' => __( 'Common', 'gutenblobks' ),
			'formatting' 	 => __( 'Formatting', 'gutenblobks' ),
			'layout' 	 => __( 'Layout', 'gutenblobks' ),
			'widgets' 	 => __( 'Widgets', 'gutenblobks' ),
			'embed' 	 => __( 'Embed', 'gutenblobks' ),
		);
	}

	public function get_native_blocks() {
		return array(
			__( 'Common', 'gutenblobks' ) => array(
				'audio' => array(
					'id' => 'core/audio',
					'name' => __( 'Audio' , 'advanced-gutenberg-blocks'),
					'icon' => 'dashicons-format-audio',
					'can_disable' => true,
				),
				'cover-image' => array(
					'id' => 'core/cover-image',
					'name' => __( 'Cover Image' , 'advanced-gutenberg-blocks'),
					'icon' => 'dashicons-format-image',
					'can_disable' => true,
				),
				'gallery' => array(
					'id' => 'core/gallery',
					'name' => __( 'Gallery' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-format-gallery',
					'can_disable' => true,
				),
				'heading' => array(
					'id' => 'core/heading',
					'name' => __( 'Heading' , 'advanced-gutenberg-blocks' ),
					'svg' => Dashicons::HEADING,
					'can_disable' => true,
				),
				'image' => array(
					'id' => 'core/image',
					'name' => __( 'Image' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-format-image',
					'can_disable' => true,
				),
				'list' => array(
					'id' => 'core/list',
					'name' => __( 'List' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-editor-ul',
					'can_disable' => true,
				),
				'paragraph' => array(
					'id' => 'core/paragraph',
					'name' => __( 'Paragraph' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-editor-paragraph',
					'can_disable' => false,
				),
				'quote' => array(
					'id' => 'core/quote',
					'name' => __( 'Quote' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-format-quote',
					'can_disable' => true,
				),
				'subhead' => array(
					'id' => 'core/subhead',
					'name' => __( 'Subhead' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-text',
					'can_disable' => true,
				),
				'video' => array(
					'id' => 'core/video',
					'name' => __( 'Video' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-format-video',
					'can_disable' => true,
				),
			),

			__( 'Formatting', 'gutenblobks' ) => array(
				'code' => array(
					'id' => 'core/code',
					'name' => __( 'Code' , 'advanced-gutenberg-blocks'),
					'icon' => 'dashicons-editor-code',
					'can_disable' => true,
				),
				'freeform' => array(
					'id' => 'core/freeform',
					'name' => __( 'Classic' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-editor-kitchensink',
					'can_disable' => true,
				),
				'html' => array(
					'id' => 'core/html',
					'name' => __( 'Custom HTML' , 'advanced-gutenberg-blocks' ),
					'svg' => Dashicons::HTML,
					'can_disable' => true,
				),
				'preformatted' => array(
					'id' => 'core/preformatted',
					'name' => __( 'Preformatted' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-text',
					'can_disable' => true,
				),
				'pullquote' => array(
					'id' => 'core/pullquote',
					'name' => __( 'Pullquote' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-format-quote',
					'can_disable' => true,
				),
				'table' => array(
					'id' => 'core/table',
					'name' => __( 'Table' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-editor-table',
					'can_disable' => true,
				),
				'verse' => array(
					'id' => 'core/verse',
					'name' => __( 'Verse' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-edit',
					'can_disable' => true,
				),
			),

			__( 'Layout', 'gutenblobks' ) => array(
				'button' => array(
					'id' => 'core/button',
					'name' => __( 'Button' , 'advanced-gutenberg-blocks'),
					'svg' => Dashicons::BUTTON,
					'can_disable' => true,
				),
				'columns' => array(
					'id' => 'core/columns',
					'name' => __( 'Columns' , 'advanced-gutenberg-blocks'),
					'svg' => Dashicons::COLUMNS,
					'can_disable' => true,
				),
				'more' => array(
					'id' => 'core/more',
					'name' => __( 'More' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-editor-insertmore',
					'can_disable' => false,
				),
				'separator' => array(
					'id' => 'core/separator',
					'name' => __( 'Separator' , 'advanced-gutenberg-blocks' ),
					'svg' => Dashicons::SEPARATOR,
					'can_disable' => true,
				),
				'text-columns' => array(
					'id' => 'core/text-columns',
					'name' => __( 'Text Columns' , 'advanced-gutenberg-blocks' ),
					'svg' => Dashicons::COLUMNS,
					'can_disable' => true,
				),
			),

			__( 'Widgets', 'gutenblobks' ) => array(
				'shortcode' => array(
					'id' => 'core/shortcode',
					'name' => __( 'Shortcode' , 'advanced-gutenberg-blocks'),
					'svg' => Dashicons::SHORTCODE,
					'can_disable' => true,
				),
				'categories' => array(
					'id' => 'core/categories',
					'name' => __( 'Categories' , 'advanced-gutenberg-blocks'),
					'icon' => 'dashicons-list-view',
					'can_disable' => true,
				),
				'latest-posts' => array(
					'id' => 'core/latest-posts',
					'name' => __( 'Latest posts' , 'advanced-gutenberg-blocks' ),
					'icon' => 'dashicons-list-view',
					'can_disable' => true,
				),
			),

			__( 'Embed', 'gutenblobks' ) => array(
			  'embed' => array(
			    'id' => 'core/embed',
			    'name' => 'Embed',
			    'svg' => Dashicons::EMBED_GENERIC,
			    'can_disable' => true,
			  ),
			  'twitter' => array(
			    'id' => 'core-embed/twitter',
			    'name' => 'Twitter',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'youtube' => array(
			    'id' => 'core-embed/youtube',
			    'name' => 'Youtube',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'facebook' => array(
			    'id' => 'core-embed/facebook',
			    'name' => 'Facebook',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'instagram' => array(
			    'id' => 'core-embed/instagram',
			    'name' => 'Instagram',
			    'svg' => Dashicons::EMBED_PHOTO,
			    'can_disable' => true,
			  ),
			  'wordpress' => array(
			    'id' => 'core-embed/wordpress',
			    'name' => 'WordPress',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'soundcloud' => array(
			    'id' => 'core-embed/soundcloud',
			    'name' => 'SoundCloud',
			    'svg' => Dashicons::EMBED_AUDIO,
			    'can_disable' => true,
			  ),
			  'spotify' => array(
			    'id' => 'core-embed/spotify',
			    'name' => 'Spotify',
			    'svg' => Dashicons::EMBED_AUDIO,
			    'can_disable' => true,
			  ),
			  'flickr' => array(
			    'id' => 'core-embed/flickr',
			    'name' => 'Flickr',
			    'svg' => Dashicons::EMBED_PHOTO,
			    'can_disable' => true,
			  ),
			  'vimeo' => array(
			    'id' => 'core-embed/vimeo',
			    'name' => 'Vimeo',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'animoto' => array(
			    'id' => 'core-embed/animoto',
			    'name' => 'Animoto',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'cloudup' => array(
			    'id' => 'core-embed/cloudup',
			    'name' => 'Cloudup',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'collegehumor' => array(
			    'id' => 'core-embed/collegehumor',
			    'name' => 'CollegeHumor',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'dailymotion' => array(
			    'id' => 'core-embed/dailymotion',
			    'name' => 'Dailymotion',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'funnyordie' => array(
			    'id' => 'core-embed/funnyordie',
			    'name' => 'Funny or Die',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'hulu' => array(
			    'id' => 'core-embed/hulu',
			    'name' => 'Hulu',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'imgur' => array(
			    'id' => 'core-embed/imgur',
			    'name' => 'Imgur',
			    'svg' => Dashicons::EMBED_PHOTO,
			    'can_disable' => true,
			  ),
			  'issuu' => array(
			    'id' => 'core-embed/issuu',
			    'name' => 'Issuu',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'kickstarter' => array(
			    'id' => 'core-embed/kickstarter',
			    'name' => 'Kickstarter',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'meetup-com' => array(
			    'id' => 'core-embed/meetup-com',
			    'name' => 'Meetup.com',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'mixcloud' => array(
			    'id' => 'core-embed/mixcloud',
			    'name' => 'Mixcloud',
			    'svg' => Dashicons::EMBED_AUDIO,
			    'can_disable' => true,
			  ),
			  'photobucket' => array(
			    'id' => 'core-embed/photobucket',
			    'name' => 'Photobucket',
			    'svg' => Dashicons::EMBED_PHOTO,
			    'can_disable' => true,
			  ),
			  'polldaddy' => array(
			    'id' => 'core-embed/polldaddy',
			    'name' => 'Polldaddy',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'reddit' => array(
			    'id' => 'core-embed/reddit',
			    'name' => 'Reddit',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'reverbnation' => array(
			    'id' => 'core-embed/reverbnation',
			    'name' => 'ReverbNation',
			    'svg' => Dashicons::EMBED_AUDIO,
			    'can_disable' => true,
			  ),
			  'screencast' => array(
			    'id' => 'core-embed/screencast',
			    'name' => 'Screencast',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'scribd' => array(
			    'id' => 'core-embed/scribd',
			    'name' => 'Scribd',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'slideshare' => array(
			    'id' => 'core-embed/slideshare',
			    'name' => 'Slideshare',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'smugMug' => array(
			    'id' => 'core-embed/smugMug',
			    'name' => 'SmugMug',
			    'svg' => Dashicons::EMBED_PHOTO,
			    'can_disable' => true,
			  ),
			  'speaker' => array(
			    'id' => 'core-embed/speaker',
			    'name' => 'Speaker',
			    'svg' => Dashicons::EMBED_AUDIO,
			    'can_disable' => true,
			  ),
			  'ted' => array(
			    'id' => 'core-embed/ted',
			    'name' => 'TED',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'tumblr' => array(
			    'id' => 'core-embed/tumblr',
			    'name' => 'Tumblr',
			    'svg' => Dashicons::EMBED_POST,
			    'can_disable' => true,
			  ),
			  'videopress' => array(
			    'id' => 'core-embed/videopress',
			    'name' => 'VideoPress',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			  'wordpress-tv' => array(
			    'id' => 'core-embed/wordpress-tv',
			    'name' => 'WordPress.tv',
			    'svg' => Dashicons::EMBED_VIDEO,
			    'can_disable' => true,
			  ),
			),
		);
	}
}
