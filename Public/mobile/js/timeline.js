/**
 * 
 */
$(function(){
	
	var loadstatus = true;	//加载状态
	
	$('body').on('click','.js-lock',function(){
		var obj = $(this);
		var guid = $(this).parents('.lock-box').attr('data-guid');
		var type = $(this).attr('data-type');
		var data = {guid:guid, type:type};
		$.ajax({
			 url:YM['setLock'],
			 type:'POST',
			 data:data,
			 dataType:'json',
			 beforeSend:function(){
				obj.find('.lock-icon').hide();
				obj.append('<i class="lock-ajax fa fa-spinner fa-spin"></i>');
			 },
			 success:function(data){
				 if(data.status == 'ok'){
					 obj.hide();
					 switch(type){
						 case 'lock':
							 obj.parents('.lock-box').find('.unlock-btn').show();
						   break;
						 case 'unlock':
							 obj.parents('.lock-box').find('.lock-btn').show();
						   break;
					 }
				 }else{
					 alert('操作失败，请重试！');
				 }
			 },
			 complete:function(){
				 obj.find('.lock-icon').show();
				 obj.find('.lock-ajax').remove();
			 }
		 });
	})
	
	$(window).scroll(function () {
	    if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
	        if(loadstatus){
		        var id = $('.timeline-points:last').find('.lock-box').attr('data-id');
		        var data = {id:id,uid:YM['uid']};
		        var lastdate = $('.timeline-day:last').attr('data-date'); 
		        var lastyear = $('.timeline-years:last').attr('data-year');
	        	$.ajax({
					 url:YM['loadMoreInfo'],
					 type:'POST',
					 data:data,
					 dataType:'json',
					 beforeSend:function(){
						 loadstatus = false;
						 $('.read_all').hide();
						 $('.more_box').show();
					 },
					 success:function(data){
					 	if(data.status=='ok'){
					 		var html = '';
					 		for(var y in data.msg){
					 			if(lastyear!==y){
					 				html += '<div class="row timeline">';
				 					html += '<div class="timeline-years" data-year="'+y+'">'+y+'</div>';
			 						html += '</div>';
					 			}
					 			for(var date in data.msg[y]){
					 				if(lastdate!==date){
					 					html += '<div class="row timeline">';
					 					html += '<div class="timeline-day" data-date="'+date+'">';
				 						html += '<a>'+date.substring(4,6)+'月'+date.substring(6,8)+'日</a>';
				 						html += '</div>';
				 						html += '<div class="data_timeline_data">';
					 				}
					 				for(var detail in data.msg[y][date]){
					 					html += '<div class="timeline-points">';
					 					html += '<div class="main-right-btn lock-box" data-guid="'+data.msg[y][date][detail]['guid']+'" data-id="'+data.msg[y][date][detail]['id']+'">';
					 					switch(parseInt(data.msg[y][date][detail]['is_show'])){
						 					case 1:
							 					html += '<button type="button" class="js-lock btn btn-default btn-lock unlock-btn" data-type="unlock"><span class="unlock"></span></button>';
							 					html += '<button type="button" class="js-lock btn btn-default btn-lock lock-btn hiden" data-type="lock"><span class="lock"></span></button>';
						 					  break;
						 					case 0:
							 					html += '<button type="button" class="js-lock btn btn-default btn-lock unlock-btn hiden" data-type="unlock"><span class="unlock"></span></button>';
							 					html += '<button type="button" class="js-lock btn btn-default btn-lock lock-btn" data-type="lock"><span class="lock"></span></button>';
						 					  break;
					 					}
					 					html += '</div>';
					 					html += '<div class="main-time">'+php_date('H:i',data.msg[y][date][detail]['created_at'])+'</div>';
					 					html += '<div class="main-portrait-sm"><img src="'+YM['public']+'/mobile/images/entry.png" class="img-circle-sm"></div>';
					 					
					 					switch(parseInt(data.msg[y][date][detail]['obj_type'])){
						 					case 1:
						 						html += '<div class="main-text">加入 <strong>社团邦</strong></div>';
						 					  break;
						 					case 2:
						 						html += '<div class="main-text">加入社团 <strong>'+data.msg[y][date][detail]['content']+'</strong></div>';
						 					  break;
						 					case 3:
						 						html += '<div class="main-text">参加活动 <strong>'+data.msg[y][date][detail]['content']+'</strong></div>';
						 					  break;
						 					case 4:
						 						html += '<div class="main-text">与 <strong>'+data.msg[y][date][detail]['content']+'</strong> 加为好友</div>';
						 					  break;
						 					case 5:
						 						html += '<div class="main-text">创建群聊 <strong>'+data.msg[y][date][detail]['content']+'</strong></div>';
						 					  break;
						 					case 6:
						 						html += '<div class="main-text">删除好友 <strong>'+data.msg[y][date][detail]['content']+'</strong></div>';
						 					  break;
					 					}
					 					html += '</div>';
					 				}
									if(lastyear!==y){
					 					html += '</div>';
					 					html += '</div>';
					 				}
					 			}
					 		}
					 		$('.data_timeline_data').append(html);
					 	}else{
					 		$('.read_all').show();
					 	}
					 },
					 complete:function(){
						 loadstatus = true;
						 $('.more_box').hide();
					 }
				 });
	        }
	    }
	});
})