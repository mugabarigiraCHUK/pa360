/**
 *	FBModal event initializer
 */
window.addEvent('domready',function() { 
	/* hide using opacity on page load */ 
  	$('fb-modal').setStyles({ 
    	opacity:0, 
    	display:'block' 
  	}); 
});

var FBMODAL_FOCUSEVENT = function(e) {
	if($('fb-modal').get('opacity') == 1 && !e.target.getParent('.generic_dialog')) { 
		FBModal_hide();
	} 
};
function FBModal_installFocusEvent(){
	$(document.body).addEvent('click',FBMODAL_FOCUSEVENT);
}
function FBModal_removeFocusEvent(){
	$(document.body).removeEvent('click',FBMODAL_FOCUSEVENT);
}

var FBMODAL_KEYEVENT = function(e) { if(e.key == 'esc') { FBModal_hide(); } };
function FBModal_installKeyEvent(){
	window.addEvent('keypress',FBMODAL_KEYEVENT);
}
function FBModal_removeKeyEvent(){
	window.removeEvent('keypress',FBMODAL_KEYEVENT);
}

/*********************************
 *	FBModal event utils
 *******************************/

/**
 * @deprecated
 * create indicator modal
 */
function FBModal_createIndicator(msg){
	var s = "" +
		"<h2 class=\"dialog_title\"><span>Validating...</span></h2>" +
		"<div class=\"dialog_content\"  style=\"padding: 10px 20px\">" +
		"<table>" +
		"<tbody>" +
			"<tr>" +
				"<td><div class=\"indicator\" ></div></td>" +
				"<td><h3 style=\"margin-left: 5px;\">Please Wait...</h3></td>" +
			"</tr>" +
		"</tbody>" +
		"</table>" +
		"</div>";
	
	return s;
}

/**
 * show modal whith specific content
 * @param content (string) - html content
 * @param keyEvent (boolean) - flag to install key event (hide on escape key)
 * @param focusEvent (boolean) - flag to install focus event (hide on lost focus)
 * @param timer (int) - timer before fade out (in miliseconds). if Null, no timer
 * @return
 */
function FBModal_show(content, keyEvent, focusEvent, timer){
	var container = $('fb-modal-content').empty().innerHTML = content;
	
	if (keyEvent) { FBModal_installKeyEvent(); }
	else{ FBModal_removeKeyEvent(); }
	
	if (focusEvent) { FBModal_installFocusEvent(); }
	else{ FBModal_removeFocusEvent(); }
	
	$('fb-modal').fade('in');

	if (timer != null) setTimeout("FBModal_hide()", timer);
}

/**
 * 
 * @param urlToLoad (string) - url 
 * @param method (string) - nama method
 * @param data (string) - data post/get
 * @param keyEvent (boolean) - install key event
 * @param mouseEvent (boolean) - install mouse event
 * @param timer (int) - timer before fade out (in miliseconds). if Null, no timer
 * @return
 */
function FBModal_show2(urlToLoad, method, data, keyEvent, focusEvent, timer, listener){
	var req = new Request({
		url: urlToLoad,
		method: method,
		onSuccess: function (res){
			//debug
//			alert(res);
			FBModal_show(res, keyEvent, focusEvent, timer);
			if (listener !=null && listener.onSuccess != null){
				listener.onSuccess(res);
			}
		}	
	}).send(data);
}

function FBModal_loading(title, message, keyEvent, focusEvent, timer){
	FBModal_show2(
			'lib/utils/fbModal.php', 
			'post', 
			"modalType=indicator_loading&title="+title+"&msg="+message,
			keyEvent, focusEvent, timer);
}

function FBModal_getContent(){
	return $('fb-modal-content').get('html');
}

function FBModal_hide(){
	$('fb-modal').fade('out');
	FBModal_removeFocusEvent();
	FBModal_removeKeyEvent();
}