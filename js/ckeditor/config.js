/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,Image,List,About,Maxize,About,Resize,Font,Pastefromword';
	config.enterMode = CKEDITOR.ENTER_DIV; // inserts <div></div>
};
CKEDITOR.on('instanceReady', function (ev) {
	// Ends self closing tags the HTML4 way, like <br>.
	ev.editor.dataProcessor.htmlFilter.addRules(
	    {
	        elements:
	        {
	            $: function (element) {
	                // Output dimensions of images as width and height
	                if (element.name == 'img') {
	                    var style = element.attributes.style;

	                    if (style) {
	                        // Get the width from the style.
	                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
	                            width = match && match[1];

	                        // Get the height from the style.
	                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
	                        var height = match && match[1];

	                        if (width) {
	                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
	                            //element.attributes.width = width;
	                            element.attributes.width = 320;
	                        }

	                        if (height) {
	                            element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
	                            //element.attributes.height = height;
	                        }
	                    }
	                }



	                if (!element.attributes.style)
	                    delete element.attributes.style;

	                return element;
	            }
	        }
	    });
	});