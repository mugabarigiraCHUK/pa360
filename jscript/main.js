function doRequest(url, method, data, completeFuntion, successFunction, failureFunction){
	var req = new Request({
		url: url,
		method: method,
		onSuccess: function(res){
			if (successFunction != null)
				successFunction(res);
		},
		onComplete: function(res){
			if (completeFuntion != null)
				completeFuntion(res);
		},
		onFailure: function (res){
			if (failureFunction != null)
				failureFunction(res);
		}
	}).send(data);
	return req;
}

//attach date picker
//@el (string) element reference (id / class etc..)
function dtpicker_attach(el, positionOffset, allowEmpty, dateRestrict, event){
	if (positionOffset==null){ positionOffset = {x:-6, y:-100}; }
	if (allowEmpty==null) { allowEmpty = true; }
	if (!$defined(dateRestrict)){ dateRestrict={}; }
	if (!$defined(dateRestrict.minDate)){ dateRestrict.minDate = null; }
	if (!$defined(dateRestrict.maxDate)){ dateRestrict.maxDate = null; }
	
	//event
	if (!$defined(event)){ event={}; }
	if (!$defined(event.onShow)){ event.onShow=$empty; }
	if (!$defined(event.onClose)){ event.onClose=$empty; }
	if (!$defined(event.onSelect)){ event.onSelect=$empty; }
	
	return new DatePicker(el, { 
		pickerClass: 'datepicker_vista', 
		format: 'd - F - Y', 
		positionOffset: positionOffset,
		allowEmpty: allowEmpty,	
		minDate: dateRestrict.minDate,
		maxDate: dateRestrict.maxDate,
		onShow: event.onShow,
		onClose: event.onClose,
		onSelect:event.onSelect
	});//inputOutputFormat: 'Y-m-d'
}

//attach spinner
//@el (string) element reference (id)
//@name (string) element name
//@minval (int) minimum value
//@maxval (int) maximum value
//@currentval (int) current value
function spinner_attach(el, name, minval, maxval, currentval, increment, decimals, styles){
	minval = minval==null? 0 : minval;
	maxval = maxval==null? 100 : maxval;
	currentval = currentval==null? 0 : currentval;
	increment = increment==null? 1 : increment;
	decimals = decimals==null? 0 : decimals; 
	styles= styles==null? {width:'30px', position:'relative', padding:'1px 0'} : styles;
	new DG.Spinner( {
		renderTo : el,
		name: name,
		increment:increment,
		shiftIncrement:5,
		decimals:decimals,
		minValue: minval,
		maxValue: maxval,
		value: currentval,
		disableWheel:true,
		disableArrowKeys:true,
		styles: styles
	});
}

//chk if an object is an array or not.
function isArray(obj) {
	//returns true is it is an array
	return obj.constructor.toString().indexOf("Array") == -1;
}

/**
 * \
 * @param e
 * @return
 */
function keypress(e) {
	//The usage:
	//<input type="text" name="textbox1" id="textbox1" onKeypress='keypress(event)'>

	if ([e.keyCode||e.which]==8) //this is to allow backspace
		return true;
	if ([e.keyCode||e.which] < 48 || [e.keyCode||e.which] > 57)
		e.preventDefault? e.preventDefault() : e.returnValue = false;
}
