/*返回顶部*/
function toTop(){
	var to01=$(".totop01");
	var to02=$(".totop02");
	var to=$(".totop");
	var toB=$(".indexfooter");
	
	to.hover(
		function() {
			$(this).find("div").fadeIn();
		},  
		function() { 
			$(this).find("div").hide();
		} 
	)

	$(window).scroll(function(){
		var st = $(window).scrollTop();
		if( st >document.documentElement.clientHeight){
			to01.show();
			var toT = parseInt(to01.offset().top);
			var toB1 = parseInt(toB.offset().top);
			var toSH = document.body.scrollHeight-380;
			// console.log(toT>toSH,toT,toSH,toB1);
			if(toT>toSH){
				//to01.hide();
				to02.show().css({"top":toB1-80+"px"});
			}else{
				//to01.show();
				to02.hide()
			}
		}else{
			to01.hide();
		}
		if(to02.is(":hidden")){to01.show();}else{to01.hide();}
		if(st<document.documentElement.clientHeight){to01.hide();}
	});	
}

/*锚点*/
function goto(s){
	
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');					   
		$(s).click(function() {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var $target = $(this.hash);
				$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
				if ($target.length) {
					var targetOffset = $target.offset().top - 100;
					$('html,body').animate({
						scrollTop: targetOffset
					},
					200);
					return false;
				}
			}
	});

}
//搜索获得焦点
function searchC(){
	$(".search-help-text").focus(function(){
           $(this).animate({"width":"460px"});
      }).blur(function(){
           $(this).animate({"width":"260px"});
      });
}
$(document).ready(function(){
	toTop();/*返回顶部*/
	
	searchC();/*搜索获得焦点*/
	
	goto(".totop");
})	