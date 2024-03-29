/**
 * Handle FLANCE Gutenberg Blocks
 *
 * @var {Object} yithGutenbergBlocks The Gutenberg blocks object.
 */

/**
 * External dependencies
 */
import React                            from 'react';
import md5                              from 'md5';

/**
 * WordPress dependencies
 */
import { registerBlockType }            from '@wordpress/blocks';
import { RawHTML }                      from '@wordpress/element';

/**
 * Internal dependencies
 */
import { flance_icon, generateShortcode } from './common';
import { createEditFunction }           from './edit';
import './common/actions-to-jquery-events';

for ( const [blockName, blockArgs] of Object.entries( yithGutenbergBlocks ) ) {
	registerBlockType( 'yith/' + blockName, {
		title      : blockArgs.title,
		description: blockArgs.description,
		category   : blockArgs.category,
		attributes : blockArgs.attributes,
		icon       : typeof blockArgs.icon !== 'undefined' ? blockArgs.icon : flance_icon,
		keywords   : blockArgs.keywords,
		edit       : createEditFunction( blockName, blockArgs ),
		usesContext: [
			'postId'
		],
		save       : ( { attributes } ) => {
			return blockArgs?.shortcode_name && !blockArgs.render_callback ? generateShortcode( blockArgs, attributes ) : null;
		},
		deprecated : [
			{
				attributes: blockArgs.attributes,
				save      : ( { attributes } ) => {
					const shortcode     = generateShortcode( blockArgs, attributes );
					const blockHash     = md5( shortcode );
					const shortcodeSpan = '<span class="flance_block_' + blockHash + '">' + shortcode + '</span>';

					return (
						<RawHTML>{shortcodeSpan}</RawHTML>
					)
				}
			}
		]
	} );
}