<?php

namespace AdvancedGutenbergBlocks\Blocks;

use AdvancedGutenbergBlocks\Helpers\Consts;
use AdvancedGutenbergBlocks\Helpers\Extend;


class AdText {

  public function run() {

		// Register hooks
		add_action( 'enqueue_block_editor_assets', array( $this, 'arguments_for_js' ) );

		// Register Block in the Gutenblocks settings page
		$args = array(
			'icon' => 'dashicons-align-right',
			'category' => 'marketing',
			'preview_image' => Consts::get_url() . 'admin/img/blocks/ad.jpg',
			'description' => __( 'Monetize your website by inserting Ads in your content. This blocks allows you to write a text on the left and display ad on the right. All you need is to grab a script from Google Adsense or other and paste it below. Best use for Rectangle ads.', 'advanced-gutenberg-blocks' ),
			'options_callback' => array( $this, 'settings' ),
		);

		Extend::register_block( 'gutenblocks/adtext', __( 'Text + Rectangle Ad', 'advanced-gutenberg-blocks' ), $args );

		// Register settings
		Extend::register_setting( 'gutenblocks-adtext-script' );
  }

	public function settings() {
		echo '
		<div class="gutenblocks-block__settings__option">
			<div class="gutenblocks-block__settings__label">
				<label for="gutenblocks-adtext-script"> ' . __( 'Js script', 'advanced-gutenberg-blocks' ) . '</label>
			</div>

			<div class="gutenblocks-block__settings__field">
				<textarea name="gutenblocks-adtext-script" rows="4">' . get_option('gutenblocks-adtext-script') . '</textarea>
			</div>
		</div>
		';
	}

	public function arguments_for_js() {
		wp_localize_script(
      'gutenblocks-block',
      'gutenblocksAdTextSettings',
      array(
        'script' => get_option('gutenblocks-adtext-script'),
      )
    );
	}
}
