/**
 * Responsive Tabs Front JS (minified)
 */

(function ($) {
    $(document).ready(function () {
        function setupTabs() {
            $(".gt").each(function () {
                var gt_def_colors = { backgroundColor: "" };
                gt_def_colors.backgroundColor = $(this).find(".gt_inactive_tab_background").html();
                var color = $(this).find(".gt_color").html();
                var breakpoint = $(this).find(".gt_breakpoint").html();
                var gtsize = $(this).width();
                if (gtsize > breakpoint) {
                    $(this).find(".gt_menu a").not(".active").css(gt_def_colors);
                    $(this).removeClass("gt_full");
                    $(this).find(".mobile_toggle").hide();
                    $(this).find('.gt_menu li:not(".mobile_toggle")').show();
                    $(this).find('.gt_menu li:not(".mobile_toggle")').css("display", "inline-block");
                } else {
                    $(this).addClass("gt_full");
                    $(this).find('.gt_menu li:not(".mobile_toggle")').css("display", "block");
                    $(this).find(".mobile_toggle").css("background", color);
                    $(this).find('.gt_menu li:not(".mobile_toggle")').hide();
                }
            });
            $(".gt").each(function () {
                var current_text = $(this).find("a.active").html();
                $(this).find(".mobile_toggle .data").empty();
                $(this).find(".mobile_toggle .data").append(current_text);
            });
        }
      
        setupTabs();
        var resizeTimerTwo;
        $(window).resize(function () {
            clearTimeout(resizeTimerTwo);
            resizeTimerTwo = setTimeout(function () {
                $(".gt").each(function () {
                    var breakpoint = $(this).find(".gt_breakpoint").html();
                    var gtsize = $(this).width();
                    if (gtsize > breakpoint) {
                        $(this).removeClass("gt_full");
                    } else {
                        $(this).addClass("gt_full");
                    }
                });
            }, 100);
        });
        var resizeTimerOne;
        $(window).resize(function () {
            clearTimeout(resizeTimerOne);
            resizeTimerOne = setTimeout(function () {
                $(".gt").each(function () {
                    var gt_def_colors = { backgroundColor: "" };
                    gt_def_colors.backgroundColor = $(this).find(".gt_inactive_tab_background").html();
                    var breakpoint = $(this).find(".gt_breakpoint").html();
                    var color = $(this).find(".gt_color").html();
                    var gtsize = $(this).width();
                    if (gtsize > breakpoint) {
                        $(this).removeClass("gt_full");
                        $(this).find(".mobile_toggle").hide();
                        $(this).find('.gt_menu li:not(".mobile_toggle")').show();
                        $(this).find('.gt_menu li:not(".mobile_toggle")').css("display", "inline-block");
                        $(this).find(".gt_menu li a").css(gt_def_colors);
                        $(this).find(".gt_menu li").find(".active").css("background", color);
                    } else {
                        $(this).addClass("gt_full");
                        $(this).find(".mobile_toggle").show();
                        $(this).find(".mobile_toggle").css("background", color);
                        $(this).find('.gt_menu li:not(".mobile_toggle")').css("display", "block");
                        $(this).find('.gt_menu li:not(".mobile_toggle")').hide();
                    }
                });
            }, 100);
        });
        $("body").on("click", ".mobile_toggle", function () {
            var color = $(this).closest(".gt").find(".gt_color").html();
            $(this).parent().children("li").not(".gt_menu li.mobile_toggle").slideToggle(90);
            $(this).siblings(".current").css("display", "none");
            $(this).css("background", color);
            $(this).siblings().find("a").css("background", "#f1f1f1");
            return !1;
        });
        $("body").on("click", ".gt_menu li > a", function () {
            var gt_def_colors = { backgroundColor: "" };
            gt_def_colors.backgroundColor = $(this).closest(".gt").find(".gt_inactive_tab_background").html();
            var color = $(this).closest(".gt").find(".gt_color").html();
            var breakpoint = $(this).closest(".gt").find(".gt_breakpoint").html();
            var gtsize = $(this).closest(".gt").width();
            if (gtsize > breakpoint) {
                $(this).addClass("active");
                $(this).css("background", color);
                $(this).parent().siblings().children().css(gt_def_colors);
                $(this).parent().siblings().children().removeClass("active");
                $(this).closest(".gt").children(".gt_content").hide();
                var current_id = $(this).attr("data-tab");
                $(current_id).fadeToggle(0);
                var current_text = $(this).closest(".gt").find("a.active").html();
                $(this).closest(".gt").find(".mobile_toggle .data").empty();
                $(this).closest(".gt").find(".mobile_toggle .data").append(current_text);
                $(this).parent().siblings().removeClass("current");
                $(this).parent().addClass("current");

                return !1;
            } else {
                $(this).closest(".gt").find(".gt_menu li").css("display", "block");
                $(this).addClass("active");
                $(this).parent().siblings().children().removeClass("active");
                $(this).closest(".gt").find(".gt_content").hide();
                var current_id = $(this).attr("data-tab");
                $(current_id).fadeToggle(0);
                $(this).closest(".gt").find(".gt_menu li").not(".mobile_toggle").slideToggle(0);
                var current_text = $(this).closest(".gt").find("a.active").html();
                $(this).closest(".gt").find(".mobile_toggle .data").empty();
                $(this).closest(".gt").find(".mobile_toggle .data").append(current_text);
                $(this).parent().siblings().removeClass("current");
                $(this).parent().addClass("current");
                return !1;
            }
        });
        $('.gt_content ul li.active').each(function(){
              $(this).parents(".gt_content").find(".gt-active-content").fadeIn(20);
		$(this).parents(".gt_content").find(".gt-active-content .data").html($(this).find(".contents").html());
        });
	$("body").on("click", ".gt_content ul li>div", function () {
if($(this).find(".contents").length>0){
	$(this).parents(".gt_content").find("li.active").removeClass("active");
	        $(this).parent().addClass("active");
	        $(this).parents(".gt_content").find(".gt-active-content").fadeIn(20);
		$(this).parents(".gt_content").find(".gt-active-content .data").html($(this).find(".contents").html());
}
	});
	$(".right-arrow").on("click",function(){
var content=$(this).parents(".gt_content");
if(content.find("ul li.active .contents").length>0){

		
		if(content.find("ul li.active").next().length>0){
		
		content.find("ul li.active").removeClass("active").next().addClass("active");
		content.find(".gt-active-content .data").html(content.find("ul li.active .contents").html());
		}
}
		
			
		
	});
	$(".left-arrow").on("click",function(){
		var content=$(this).parents(".gt_content");
if(content.find("ul li.active .contents").length>0){
		if(content.find("ul li.active").prev().length>0){
		
		content.find("ul li.active").removeClass("active").prev().addClass("active");
		
	
			
		content.find(".gt-active-content .data").html(content.find("ul li.active .contents").html());
		}
}
	});
    });
})(jQuery);
