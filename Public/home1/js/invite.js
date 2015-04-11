/**
 * 
 */
$(function(){
	$('body').on('click','.js_invite',function(){
		var obj = $(this)
		var user_guid = $(this).attr('data-guid');
		var data={user_guid:user_guid};
		$.ajax({
			 url:YM['invite'],
			 type:'POST',
			 data:data,
			 dataType:'json',
			 beforeSend:function(){
				 obj.button('loading');
			 },
			 success:function(data){
				 if(data.status=='ok'){
					 obj.parents('.state_wrap').html('<span class="org_status_in">已发出邀请</span>');
					 obj.remove();
				 }else if(data.status=='ko'){
					 alert('邀请失败,请重试');
				 }
			 },
			 complete:function(){
				 obj.button('reset');
			 }
		 });
	})
})