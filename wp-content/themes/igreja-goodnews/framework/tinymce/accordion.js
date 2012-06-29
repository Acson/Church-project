(function() {
    tinymce.create('tinymce.plugins.acc', {
        init : function(ed, url) {
            ed.addButton('acc', {
                title : 'Insert Accordion',
                image : url+'/images/acc.png',
                onclick : function() {

                     ed.selection.setContent('[accordions]<br />\
				[accordion title="Accordion 1"]Accordion 1 Content[/accordion]<br />\
				[accordion title="Accordion 2"]Accordion 2 Content[/accordion]<br />\
				[accordion title="Accordion 3"]Accordion 3 Content[/accordion]<br />\
		     [/accordions]');  

              }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('acc', tinymce.plugins.acc);
     
})();
