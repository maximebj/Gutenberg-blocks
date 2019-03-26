import "./style.scss";
import "./editor.scss";

import classnames from "classnames";
import Inspector from "./inspect";
import Tools from "./tools";

const { __ } = wp.i18n;
const { registerBlockType, createBlock } = wp.blocks;
const { RichText } = wp.editor;
const { Fragment } = wp.element;

export default registerBlockType("advanced-gutenberg-blocks/button", {
	title: __("Button", "advanced-gutenberg-blocks"),
	description: __("An advanced kind of button.", "advanced-gutenberg-blocks"),
	category: "agb",
	icon: { background: "#2F313A", foreground: "#DEBB8F", src: "carrot" },
	keywords: [
		__("button", "advanced-gutenberg-blocks"),
		__("cta", "advanced-gutenberg-blocks")
	],
	attributes: {
		label: {
			type: "string",
			source: "text",
			selector: "a"
		},
		url: {
			source: "attribute",
			attribute: "href",
			selector: "a"
		},
		isBlank: {
			type: "boolean",
			default: true
		},
		btnBackgroundColor: {
			type: "string",
			default: "#333333"
		},
		btnTextColor: {
			type: "string",
			default: "#ffffff"
		},
		buttonClass: {
			default: "start"
		},
		blockAlignment: {
			type: "string",
			default: "center"
		}
	},
	getEditWrapperProps({ blockAlignment }) {
		if (
			"left" === blockAlignment ||
			"right" === blockAlignment ||
			"center" === blockAlignment
		) {
			return { "data-align": blockAlignment };
		}
	},
	edit: props => {
		const {
			attributes: {
				url,
				buttonClass,
				btnBackgroundColor,
				btnTextColor,
				blockAlignment,
				isBlank,
				label
			},
			setAttributes
		} = props;

		return (
			<Fragment>
				<Inspector
					{...{
						url,
						isBlank,
						buttonClass,
						btnBackgroundColor,
						btnTextColor,
						setAttributes
					}}
				/>
				<Tools {...{ blockAlignment, setAttributes }} />

				<div className="wp-block-advanced-gutenberg-blocks-button">
					<div
						className={classnames(
							"editor-button",
							`button--${buttonClass}`
						)}
						style={{
							backgroundColor: btnBackgroundColor
						}}
					>
						<RichText
							tagname="span"
							placeholder="Inserisci testo"
							formattingControls={["bold", "italic"]}
							style={{
								color: btnTextColor
							}}
							value={label}
							onChange={label => setAttributes({ label })}
						/>
					</div>
				</div>
			</Fragment>
		);
	},
	save: props => {
		const {
			buttonClass,
			btnBackgroundColor,
			btnTextColor,
			label,
			url,
			isBlank,
			blockAlignment
		} = props.attributes;

		return (
			<div
				className={classnames(
					"wp-block-advanced-gutenberg-blocks-button",
					`align${blockAlignment}`
				)}
			>
				<a
					href={url}
					target={isBlank && "_blank"}
					className={classnames("button", `button--${buttonClass}`)}
					style={{
						color: btnTextColor,
						backgroundColor: btnBackgroundColor
					}}
					data-type={buttonClass}
				>
					<span>{label}</span>
				</a>
			</div>
		);
	}
});