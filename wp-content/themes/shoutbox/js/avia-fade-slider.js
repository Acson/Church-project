/**
 * Avia Fade Slider - A simple jQuery image slider
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 */


(function($)
{
	var pluginNameSpace = 'avia_fade_slider',
		
		//methods used to create the slideshow
		methods = {
		
			/************************************************************************
			methods.init:
			
			initialize the slider by activating the image preloader if available and 
			then wait until images are loaded
			*************************************************************************/
			init: function()
			{
				//start preloading images if the preloader is available
				if(jQuery.fn.aviaImagePreloader)
				{
					this.aviaImagePreloader(methods.preloadingDone.apply( this ));
				}
				else
				{
					methods.preloadingDone.apply( this );
				}
			},
			
			/************************************************************************
			methods.preloadingDone:
			
			once images are pre loaded execute all necessary functions for the slider
			like applying controlls and starting autorotation
			*************************************************************************/
			preloadingDone: function()
			{
				//fetch slider data
				var data = this.data( pluginNameSpace );
				
				//allow animation of slides:
				data.animatingNow = false;
				
				//prepare slides
				methods.prepareSlides.apply( this );
				
				//append controlls and start autsolider if we got more than one slide and these options are set
				if(data.slideCount > 1)
				{
					if(data.options.appendControlls) methods.appendControlls.apply( this );
					if(data.options.autorotation) methods.autorotation.apply( this );
					
				}
				methods.bindEvents.apply( this );
				
				//show caption if available
				if(data.options.appendCaption) methods.appendCaption.apply( this );
				data.allcaptions = this.find('.'+data.options.captionClass).css({display:'none'});
				methods.showCaption.apply( this );
			},
			
			/************************************************************************
			methods.prepareSlides:
			
			addds classnames slides so we know if they are image slides, image slides
			with video beneath or embeded videos 
			*************************************************************************/
			prepareSlides :function()
			{
				var data = this.data( pluginNameSpace ), currentslide, imageslide, videoslide, classname;
				
				data.slides.each(function(i)
				{
					currentslide 	= $(this);
					imageslide 		= currentslide.find('img');
					videoslide		= currentslide.find('video, embed, object, iframe, .avia_video');
					
					if(imageslide.length && videoslide.length)
					{
						classname = 'comboslide';
					}
					else if(videoslide.length)
					{
						classname = 'videoslide';
					}
					else if(imageslide.length)
					{
						classname = 'imageslide';
					}
					
					currentslide.addClass(classname).append('<span class="slideshow_overlay"></span>');
										
					
				});
			},
			
			/************************************************************************
			methods.autorotation:
			
			start the slider autorotation
			*************************************************************************/
			autorotation: function()
			{ 
				var current = this,
					data = this.data( pluginNameSpace ),
					time = (parseInt(data.options.autorotationSpeed) * 1000);
					
					data.interval = setTimeout(function()
					{ 
						//switch slides
						methods.transition.apply( current, ['next'] );							
						
						//call this function again	
						methods.autorotation.apply( current );
					},
					time);
					
					if(data.options.appendControlls) data.arrowControlls.play.addClass('ctrl_active').text('Pause');
			},
			
			
			/************************************************************************
			methods.autorotationStop:
			
			stop the slider autorotation
			*************************************************************************/
			autorotationStop: function()
			{ 
				var data = this.data( pluginNameSpace );
				clearTimeout(data.interval);
				data.interval = false;
				
				if(data.options.appendControlls && data.arrowControlls && data.arrowControlls.length) data.arrowControlls.play.removeClass('ctrl_active').text('Play');
			},
			
			/************************************************************************
			methods.switchAutorotation:
			
			switch between active and inactive autorotation state
			*************************************************************************/
			switchAutorotation: function()
			{
				var data = this.data( pluginNameSpace );
				
				if(data.interval)
				{
					methods.autorotationStop.apply( this );
				}
				else
				{
					methods.transition.apply( this, ['next'] );
					methods.autorotation.apply( this );
				}
			},
			
			/************************************************************************
			methods.appendControlls:
			
			append direct controlls as well as arrow controlls to the slider
			*************************************************************************/
			appendControlls: function()
			{
				var data = this.data( pluginNameSpace ),
					first = 'class="active_item" ',
					singlecontroll = '',
					arrowcontroll  = '<a href="#" class="ctrl_back ctrl_arrow">Previous</a>';
					arrowcontroll += '<a href="#" class="ctrl_play ctrl_arrow">Play</a>';
					arrowcontroll += '<a href="#" class="ctrl_fwd  ctrl_arrow">Next</a>';
				
				for(var i = 0; i < data.slideCount; i++)
				{
					singlecontroll += '<a '+first+'href="#'+i+'">'+(i+1)+'</a>';
					first = '';
				}
				
				data.controllContainer = $('<div class="slidecontrolls">'+singlecontroll+'</div>').insertAfter(this);
				data.arrowControllContainer = $('<div class="arrowslidecontrolls">'+arrowcontroll+'</div>').insertAfter(this);
				data.controlls = data.controllContainer.find('a');
				data.arrowControlls = { 
										 prev: data.arrowControllContainer.find('.ctrl_back'), 
										 next: data.arrowControllContainer.find('.ctrl_fwd'), 
										 play: data.arrowControllContainer.find('.ctrl_play') 
									  }; 
			},
			
			/************************************************************************
			methods.setSlides:
			
			checks which slide should be displayed next and stores that information to
			the this.data.nextSlide var
			*************************************************************************/
			setSlides: function(selector)
			{
				//get slider data and set the current slide by selecting the one that is visible
				var data = this.data( pluginNameSpace ), newIndex;
				
				if(!data.animatingNow)
				{
					data.currentSlide = this.find(data.options.slides + ':visible');
					data.currentSlideIndex 	= data.slides.index(data.currentSlide);
					
					//based on the passed selector value (next/prev/integer value) get the number of the next slide
					switch (selector)
					{
						case 'next': newIndex = data.currentSlideIndex + 1 < data.slideCount  ? data.currentSlideIndex + 1 : 0;  break;
						case 'prev': newIndex = data.currentSlideIndex - 1 >= 0 ? data.currentSlideIndex - 1 : data.slideCount - 1; break;
						default: newIndex = selector;
					}
					
					//select the next slide and store it to data.nextSlide
					data.nextSlide = this.find( data.options.slides + ':eq('+newIndex+')');
					data.currentSlideIndex = newIndex;
					
					//check if the current slide is the same as the next one. if so skip the transition
					if(data.nextSlide[0] == data.currentSlide[0]) data.skipTransition = true;
				}
			},
			
			/************************************************************************
			methods.appendCaption:
			
			append a caption based on the image alt attribute
			*************************************************************************/
			appendCaption: function()
			{
				var data = this.data( pluginNameSpace ), description = false, splitdesc = [];
				
				data.slides.each(function()
				{
					var currentSlide = $(this);
					description 	 = currentSlide.find('img').attr('alt');
					
					if(description) splitdesc = description.split('::');
								
					if(splitdesc[0] != "" )
					{
						if(splitdesc[1] != undefined )
						{
							description = "<strong>"+splitdesc[0] +"</strong>"+splitdesc[1]; 
						}
						else
						{
							description = splitdesc[0];
						}
					}

					if(description)
					{
						$('<span></span>').addClass(data.options.captionClass)
										  .html(description)
										  .css({display:'none', 'opacity':data.options.captionOpacity})
										  .appendTo(currentSlide); 
					}
				});
				
			},
			
			/************************************************************************
			methods.showCaption:
			
			show the caption for the current slide once the slide has been revealed
			*************************************************************************/
			showCaption: function()
			{
				var data 		= this.data( pluginNameSpace );
				
				//hide all other captions
				data.allcaptions = this.find('.'+data.options.captionClass).css({display:'none'});
				
				//select current caption
				var caption 	= data.currentSlide.find('.'+data.options.captionClass).css({display:'block', opacity:0});
					
				caption.animate({opacity: data.options.captionOpacity});
			},
			
			/************************************************************************
			methods.switchSlides:
			
			visual slide transition via jQuerys animate function
			*************************************************************************/
			switchSlides: function()
			{
				var current = $(this), data = this.data( pluginNameSpace );
				
				if(!data.animatingNow && !data.skipTransition)
				{
					methods.beforeSwitch.apply( current );
					data.currentSlide.animate({opacity:0}, data.options.animationSpeed,  function(){ methods.switchComplete.apply( current ); });
					
					//check the controlls and apply the active class to the correct controll
					if(data.options.appendControlls) data.controlls.removeClass('active_item').filter(':eq('+data.currentSlideIndex+')').addClass('active_item');
				}
				
				if(data.skipTransition) data.skipTransition = false;
			},
			
			/************************************************************************
			methods.beforeSwitch:
			
			execute this before the slide switching starts
			*************************************************************************/
			beforeSwitch: function()
			{
				var data = this.data( pluginNameSpace );
				
				data.animatingNow = true;
				data.currentSlide.css({zIndex:3});
				data.nextSlide.css({zIndex:2, display:'block'});
			},
			
			/************************************************************************
			methods.switchComplete:
			
			execute this once the slides have been switched
			*************************************************************************/
			switchComplete: function()
			{
				var data = this.data( pluginNameSpace );
				
				data.animatingNow = false;
				data.currentSlide.css({zIndex:2, display:'none', opacity:1});
				data.nextSlide.css({zIndex:3});
				
				//set the current slide
				data.currentSlide = data.nextSlide;
				
				//show image caption
				methods.showCaption.apply( this );
			},
			
			/************************************************************************
			methods.transition:
			
			switch the slides
			*************************************************************************/
			transition: function(selector, autorotation)
			{
				methods.setSlides.apply( this, [selector] );	
				methods.switchSlides.apply( this );
				
				if('stop_autorotation' == autorotation)
				{
					methods.autorotationStop.apply(this);
				}
			},
			
			/************************************************************************
			methods.bindEvents:
			
			bind all events for the slider
			*************************************************************************/
			bindEvents: function()
			{ 
				var current = this, data = this.data( pluginNameSpace );
				
				//when any link within the slideshow is clicked stop the autorotation
				this.find('a').bind('click.'+pluginNameSpace, function(){ methods.autorotationStop.apply(current); });
				
				//show videos
				data.slides.bind('click.'+pluginNameSpace, function()
				{ 
					var clicked_item = $(this);
					
					if(clicked_item.is('.comboslide'))
					{
						methods.showvideo.apply(current, [clicked_item]); 
						methods.autorotationStop.apply(current);
						return false; 
					}
				});
				
				//bind controll clicks
				if(data.controlls && data.controlls.length)
				{
					//bind controll clicks
					data.controlls.bind('click.'+pluginNameSpace, function()
					{ 
						var selector = this.hash.substr(1); 
						methods.transition.apply(current, [selector, 'stop_autorotation']);
						return false;
					});
				}
				
				//bind arrowControll clicks
				if(data.arrowControlls && data.arrowControlls.next.length)
				{
					//bind arrowControll clicks
					data.arrowControlls.next.bind('click.'+pluginNameSpace, function(){ methods.transition.apply(current, ['next','stop_autorotation']); return false; });
					data.arrowControlls.prev.bind('click.'+pluginNameSpace, function(){ methods.transition.apply(current, ['prev','stop_autorotation']); return false; });
					data.arrowControlls.play.bind('click.'+pluginNameSpace, function(){ methods.switchAutorotation.apply(current); return false; });
				}
			},
			
			/************************************************************************
			methods.showvideo:
			
			hide image and show video instead
			*************************************************************************/
			showvideo: function(clicked_item)
			{
				var data = this.data( pluginNameSpace );
				
				clicked_item.find('img, canvas, .slideshow_overlay, .'+data.options.captionClass).stop().fadeOut();
				clicked_item.find('.slideshow_video').stop().fadeIn();
				
			},
			
			
			/************************************************************************
			methods.overwrite_defaults:
			
			lets you overwrite options for multiple sliders on one page with different 
			settings, without the need to call the slider function multiple times
			*************************************************************************/
			overwrite_options: function()
			{
				var data 	= this.data( pluginNameSpace ),
					optionsWrapper = this.parents('.slideshow_container:eq(0)');
					
					if(optionsWrapper.length)
					{
						var autoInterval = /autoslidedelay__(\d+)/;
						var matchInterval = autoInterval.exec(optionsWrapper[0].className);

						if(matchInterval != null) { data.options.autorotationSpeed = matchInterval[1]; }
						if(optionsWrapper.is('.autoslide_false')) 	data.options.autorotation = false;
						if(optionsWrapper.is('.autoslide_true')) 	data.options.autorotation = true;
						
					}
			}
			
		};



	$.fn.avia_fade_slider = function(options) 
	{
		return this.each(function()
		{
			var slider =  $(this), data = {},
			
			//default slideshow settings. can be overwritten by passing different values when calling the function 
			defaults = 
			{
				slides: 			'li',				// wich element inside the container should serve as slide
				animationSpeed: 	600,				// animation duration
				autorotation: 		true,				// autorotation true or false?
				autorotationSpeed:	3,					// duration between autorotation switch in Seconds
				appendControlls: 	true,				// should slidecontrolls be appended or should we use none/predefined,
				appendCaption: 		true,				// should a caption be created by using the slideshow images alt tag?,
				captionOpacity:		0.8,
				captionClass:		'slideshow_caption'	// caption class
			};
			
			//merge default options and options passed by the user, then collect some slider data
			data.options 		= $.extend(defaults, options);
			data.slides  		= slider.find(data.options.slides).css({display:'none'});
			data.slideCount 	= data.slides.length;
			data.currentSlide 	= slider.find(data.options.slides + ':eq(0)').css({display:'block'});
			data.nextSlide	 	= slider.find(data.options.slides + ':eq(1)');
			data.interval 		= false;
			data.animatingNow 	= true;
			
			
			//apply data to the slider to keep track of variables and states
			slider.data( pluginNameSpace, data );
			
			//overwrite options with slider specific options if necessary
			methods.overwrite_options.apply( slider );
			
			//initialize the slideshow
			methods.init.apply( slider );
		});
	};
})(jQuery);





























// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------


(function($)
{
	$.fn.aviaImagePreloader = function(variables, callback) 
	{
		var defaults = 
		{
			fadeInSpeed: 800,
			maxLoops: 10,
			data: ''
		};
		
		var options = $.extend(defaults, variables);
			
		return this.each(function()
		{
			var container 	= $(this),
				images		= $('img', this).css({opacity:0, visibility:'visible', display:'block'}),
				parent = images.parent().addClass('preloading'),
				imageCount = images.length,
				interval = '',
				allImages = images ;
							
			var methods = 
			{
				checkImage: function()
				{
					images.each(function(i)
					{
						if(this.complete == true) images = images.not(this);
					});
					
					if(images.length && options.maxLoops >= 0)
					{
						options.maxLoops--;
						setTimeout(methods.checkImage, 500);
					}
					else
					{
						methods.showImages();
					}
				},
				
				showImages: function()
				{
					allImages.each(function(i)
					{
						var currentImage = $(this);
						currentImage.animate({opacity:1}, options.fadeInSpeed, function()
						{
							currentImage.parents().removeClass('preloading');
							if(allImages.length == i+1) 
							{
								methods.callback(i);
							}
						});
					});
				},
				
				callback: function()
				{		
					if (variables instanceof Function) { callback = variables; }
					if (callback  instanceof Function) { callback.call(this, options.data);  }
				}
			};
			
			if(!images.length) { methods.callback(); return }
			methods.checkImage();

		});
	};
})(jQuery);