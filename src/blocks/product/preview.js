import classnames from 'classnames'

const { Component } = wp.element

const { __ } = wp.i18n

export default class Preview extends Component {

  constructor( props ) {
    super( props )
  }

  render() {

		const product = this.props.product.data
		console.log(product)

		const getDescription = () => {
			const description = ( product.short_description !='' ) ? product.short_description : product.description;
  		return {__html: description }
		}

		const currency = gutenblocksWooGlobals.currency

		// Currency before / after
		const cb = ( currency == "$" ) ? currency : ''
		const ca = ( currency != "$" ) ? currency : ''

    return (
			!! product ? (
				<div className="wp-block-gutenblocks-product">
					{ !! product.images && (
						<a href={ product.permalink } className="wp-block-gutenblocks-product__image">
							<img src={ product.images[0].src } alt={ product.images[0].alt } />
						</a>
					) }
					<div className="wp-block-gutenblocks-product__content">
						<h2 className="wp-block-gutenblocks-product__title">
							<a href={ product.permalink }>{ product.name }</a>
						</h2>
						<p className="wp-block-gutenblocks-product__price">
							{ !! product.sale_price != "" ? (
								<span>
									<span>{ cb }{ product.sale_price }{ ca }</span>
									<del className="wp-block-gutenblocks-product__sale">{ cb }{ product.regular_price }{ ca }</del>
								</span>
								) : (
									<span>{ cb }{ product.price }{ ca }</span>
								)
							}
						</p>
						<div
							className="wp-block-gutenblocks-product__description"
							dangerouslySetInnerHTML={ getDescription() }>
						</div>
						<p>
							<a className="wp-block-gutenblocks-product__button" href={ '/?add-to-cart=' + product.id }>
								<span className="dashicons dashicons-cart"></span>
								{ __( 'Add to cart' ) }
							</a>
						</p>
					</div>
				</div>
			) : (
				<p class="gutenblocks-block-message">{ __( 'Loading product...' ) }</p>
			)
    )
  }
}