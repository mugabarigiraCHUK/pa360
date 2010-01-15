var tabbedPane = new Class({
    initialize: function(id_element, options){
		this.options = Object.extend({
			//option here
		}, options || {});
		
		this.el = $(id_element);
		this.elid = id_element;
		
		//get the title
		this.titles = $$('#' + this.elid + ' ul.tabs_title li');
		this.titles.each(function(item) {
			item.addEvent('click', function(e){
				this.activate(item);
			}.bind(this));
		}.bind(this));
		
		var activeFirst = this.options.activate;
		this.activate(activeFirst==null?this.titles[0] : this.activeFirst);
    },
    
    //activate title
    activate: function(tabTitle){
    	if (this.activeTitle != null){
    		this.activeTitle.removeClass('active');
    	}
    
    	//new tab title
		tabTitle.addClass('active');
		this.activeTitle = tabTitle;
    		
    	//hide the previouse active panel
		if (this.activePanel != null){
			this.activePanel.removeClass('active');
    	}
		
		//show the new panel
		var panel = tabTitle.getProperty('title');
		panel = $(panel);
		panel.addClass('active');
		this.activePanel = panel;
    }
});

