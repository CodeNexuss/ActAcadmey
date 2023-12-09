/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    // The location of an external file browser, that should be launched when "Browse Server" button is pressed in the Image dialog.
    config.filebrowserImageBrowseUrl = "javascript:void(0)";
    config.filebrowserImageBrowseLinkUrl = '';



    // Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: ['insert', 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
        { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,Table,HorizontalRule,SpecialChar';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre;div';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	//config.extraAllowedContent = 'div(*)';
	config.allowedContent = true;
};
