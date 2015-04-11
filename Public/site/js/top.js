function hidden(){
	var ymtop=$(".yunmai-header");
	var to=$(".yunmai-header");

	
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
			ymtop.show();
			var toT = parseInt(ymtop.offset().top);
			var toSH = document.body.scrollHeight-380;
			console.log(toT>toSH,toT,toSH);
			if(toT>toSH){
				ymtop.hide();
			}else{
				ymtop.show();
			}
		}else{
			ymtop.hide();
		}
	});	
}