$(function(){
	$('body').on('click','.js_accept_task',function(){
		var uid = YM['uid'];
		var taskid = YM['taskid'];
		var flowid = YM['flowid'];
		var type = YM['type'];
		var data = {uid:uid, taskid:taskid, flowid:flowid, type:type};
		$.ajax({
			 url:YM['acceptPath'],
			 type:'POST',
			 data:data,
			 dataType:'json',
			 success:function(data){
				 if(data.status=='ok'){
					 window.location.href= YM['redirectPath']+'/uid/' + uid + '/progress_guid/' + data.progress_guid; 
				 }
			 }
		 });
	});
});
