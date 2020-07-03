<?php defined( 'ABSPATH' ) || exit; ?>
<div class="wp-block-advanced-gutenberg-blocks-product<?php echo esc_attr($customClass); ?>">
	<?php if ( $product->get_image() ): ?>
		<a href="<?php echo esc_url($url); ?>" class="wp-block-advanced-gutenberg-blocks-product__image">
			<?php echo esc_html($product->get_image()); ?>
		</a>
	<?php endif; ?>
	<div class="wp-block-advanced-gutenberg-blocks-product__content">
		<p class="wp-block-advanced-gutenberg-blocks-product__title">
			<a href="<?php echo esc_url($url); ?>"><?php echo esc_html($product->get_name()); ?></a>
		</p>
		<p class="wp-block-advanced-gutenberg-blocks-product__price" style="color: <?php echo esc_attr($attributes['priceColor']); ?>">
			<?php if($product->get_sale_price() == ""): ?>
				<?php echo wc_price( $product->get_price() ); ?></span>
			<?php else: ?>
		    <?php echo wc_price( $product->get_price() ); ?>
				<del class="wp-block-advanced-gutenberg-blocks-product__sale"><?php echo wc_price( $product->get_regular_price() ); ?></del>
			<?php endif; ?>
		</p>
		<div class="wp-block-advanced-gutenberg-blocks-product__description">
			<?php echo esc_html($description); ?>
		</div>
		<p class="wp-block-advanced-gutenberg-blocks-product__actions">
			<a class="wp-block-advanced-gutenberg-blocks-product__button" href="<?php echo esc_url($add_to_cart_url); ?>" style="background-color: <?php echo esc_attr($attributes['buttonBackgroundColor']); ?>">
				<span class="dashicons dashicons-cart"></span>
				<?php esc_html__( 'Add to cart', 'advanced-gutenberg-blocks' ); ?>
			</a>
		</p>
	</div>
</div>
