$(document).ready(function(){
	
	/*******************************accordion********************************/
	
	$(".accordion-header").click(function(){
		if(!$(this).next(".accordion-body").hasClass("open")){
			$(".accordion-body").stop().slideUp(300).removeClass("open");
			$(this).next(".accordion-body").stop().slideDown(300).addClass("open");
		}
	});
	
	/*******************************modal********************************/
	
	$('[data-role="modal"]').click(function(){
		var target = $(this).attr("data-target");
		$("body").prepend("<div class='modal-blur'></div>");
		$(".modal-blur").css("visibility","visible");
		$(".modal-blur").animate({
			"opacity":".5"
		},600, function(){
			$(""+target+"").addClass("modal-open");
		});
	});
	
	$('[data-target="closeModal"]').click(function(){
		$(".modal-wrapper").removeClass("modal-open");
		$(".modal-blur").animate({
			"opacity":"0"
		},600, function(){
			$(".modal-blur").remove();
		})
	});
	
	
	/*******************************tab********************************/
	
	$(".tab-header").first().addClass("active-header");
	$(".tab-body").first().addClass("active-body");
	
	$(".tab-header").click(function(){
		if(!$(this).hasClass("active-header")){
			var target = $(this).attr("data-target");
			$(".tab-body").removeClass("active-body");
			$(""+target+"").addClass("active-body");
			$(".tab-header").removeClass("active-header");
			$(this).addClass("active-header");
		}
	});


/***********************************************Collapsible*******************************************/	


	$('[data-role="collapse"]').click(function(){
		var target = $(this).attr("data-target");
		if(!$(""+target+"").hasClass("opened")){
			$(""+target+"").slideDown(300).addClass("opened");
		}else{
			$(""+target+"").slideUp(300).removeClass("opened");
		}
		
	});


/***********************************************Light Box*******************************************/

	
	$(".lightbox").each(function(){
		var src = $(this).children("img").attr("src");
		$(this).css("background-image", "url("+src+")");
		$(this).children("img").hide();
		$(this).append("<div class='zoomico'><i class='el el-search'></i></div>");
	});

	var targetid;
	$(document).on('click', '.zoomico', function(){
		targetid = $(this).parent(".lightbox").attr("id");
		var src = $(this).prev("img").attr("src");
		$("body").prepend("<div class='modal-blur'></div>");
		$("body").append("<div class='lightbox-focus'><img src='"+src+"' /><a class='close' href='javascript:void(0)'><i class='el el-remove'></i></a> <a class='prev' href='javascript:void(0)'><i class='el el-chevron-left'></i></a> <a class='next' href='javascript:void(0)'><i class='el el-chevron-right'></i></a></div>");
		$(".modal-blur").css("visibility","visible");
		$(".modal-blur").stop().animate({
			"opacity":".5"
		},300, function(){
			$(".lightbox-focus").stop().animate({
				"opacity":"1",
				"top":"10%"
			});
		});
	});
	$(document).on('click', '.lightbox-focus .close', function(){
		$(".lightbox-focus").stop().animate({
			"opacity":"0",
			"top":"5%"
		},300, function(){
			$(".modal-blur").stop().animate({
				"opacity":"0"
			}, 300, function(){
				$(".modal-blur").remove();
				$(".lightbox-focus").remove();
			})
		})
	});
	var arr = [];
	var lightboxCounter = 0;
	$(".lightbox").each(function(){
		$(this).attr("id", lightboxCounter);
		arr[lightboxCounter] = $(this).children("img").attr("src");
		lightboxCounter++;
	});
	var currentid;
	$(document).on('click', '.lightbox-focus .next', function(){
		currentid = targetid;
		currentid = parseInt(currentid);
		if(currentid+1 < arr.length){
			currentid++;
			targetid = currentid;
			$(".lightbox-focus").children("img").attr("src", arr[currentid]);
		}else{
			currentid = 0;
			targetid = currentid;
			$(".lightbox-focus").children("img").attr("src", arr[currentid]);
		}
	});
	$(document).on('click', '.lightbox-focus .prev', function(){
		currentid = targetid;
		currentid = parseInt(currentid);
		if(currentid-1 > -1){
			currentid--;
			targetid = currentid;
			$(".lightbox-focus").children("img").attr("src", arr[currentid]);
		}else{
			currentid = arr.length - 1;
			targetid = currentid;
			$(".lightbox-focus").children("img").attr("src", arr[currentid]);
		}
	});

/***********************************************Dropdown*******************************************/
	
	$(".dropdown ul li").click(function(){
		var chosen = $(this).html();
		$(".selected").html(chosen);
	});
	
	$(".dropdown").each(function(){
		var initVal = $(this).children("ul").children("li").first().html();
		$(this).children(".selected").html(initVal);
	});

/***********************************************navbar*******************************************/
	
	var navToggler = false;
	$(".m-nav-toggler").addClass("icon-menu3");
	$(".m-nav-toggler").click(function(){
		if(navToggler == false){
			$("nav").stop().slideDown(300);
			navToggler = true;
		}else{
			$("nav").stop().slideUp(300);
			navToggler = false;
		}
	});
	
	$(window).resize(function(){
		var size = $(document).width();
		if(size > 720 && navToggler == false){
			$("nav").show();
		}
	});
	
/***********************************************Slider*******************************************/

	var slideCounter = 1;
	var top = -100;
	$(".slides").each(function(){
		slideCounter++;
	});
	
	$(".slides").each(function(){
		$(this).css("z-index", slideCounter);
		slideCounter--;
	});
	
	$(".slides").first().addClass("active-slide");
	$(window).load(function(){
		setSliderHeight();
	})
	
	function nextSlide(){
		if($(".active-slide").next().hasClass("slides")){
			$(".active-slide").next().addClass("active-slide");
			$(".active-slide").first().removeClass("active-slide");
		}else{
			$(".slides").first().addClass("active-slide");
			$(".active-slide").last().removeClass("active-slide");
		}
	}
	
	function prevSlide(){
		if($(".active-slide").prev().hasClass("slides")){
			$(".active-slide").prev().addClass("active-slide");
			$(".active-slide").last().removeClass("active-slide");
		}else{
			$(".slides").last().addClass("active-slide");
			$(".active-slide").first().removeClass("active-slide");
		}
	}
	
	var interval = setInterval(function(){
		nextSlide();
	}, 5000);
	
	
	$(".slideNext").click(function(){
		clearInterval(interval);
		nextSlide();
		setTimeout(function(){ 
			interval = setInterval(function(){
				nextSlide();
			}, 5000);
		}, 1000);
	});
	
	$(".slidePrev").click(function(){
		clearInterval(interval);
		prevSlide();
		setTimeout(function(){ 
			interval = setInterval(function(){
				nextSlide();
			}, 5000);
		}, 1000);
	});
	
	$( window ).resize(function() {
	  setSliderHeight();
	});
	
	function setSliderHeight(){
		var slideHeight = $(".active-slide").children("img").height();
		$(".slider").height(slideHeight);
	}

/***********************************************popup*******************************************/
	var popovertoggler = false;
	$('[data-type="popover"]').click(function(){
		if(popovertoggler==false){
			var content = $(this).attr("data-content");
			$(this).append("<span class='popover'>"+content+" <span class='el el-caret-down'></span> </span>");
			var pos = $(this).css("position");
			if(pos == "static"){
				$(this).attr("data-pos", pos);
				$(this).css("position", "relative");
			}
			var height = $(this).children(".popover").height();
			height = height + 35;
			$(this).children(".popover").css("top", -height+"px");
			$(this).children(".popover").css("left", "0px");
			$(this).children(".popover").show();
			popovertoggler = true;
		}else{
			var initpos = $(this).attr("data-pos");
			$(this).css("position", initpos);
			$(this).children(".popover").remove();
			popovertoggler = false;
		}
	});
	
/*******************************table responsiveness********************************/
	var done = false;
	responsiveTable();
	
	$(window).resize(function(){
		responsiveTable();
	});
	
	function responsiveTable(){
		var width = $(document).width();
		if(width < 721 && done == false){
			var heading = [];
			$("table tr th").each(function(){
				var content = $(this).html(); 
				heading.push(content);
			});
			var i = 0;
			$("table tr").each(function(){
				$(this).children("td").each(function(){
					$(this).prepend("<strong class='responsiveHeading'>"+heading[i]+"</strong>");
					i++;
				});
				i = 0;
			});
			done = true;
		}
	}
	
});