/**
 * 
 */
$(function(){	
	/**
	 * 修改VIP等级
	 *
	 * CT: 2014-12-04 14:34 by QXL
	 *
	 */
	$('body').on('click','.js-submit',function(){
		var obj=$(this);
		var key=YM['org_guid'];
		var vip=$('select[name=vip]').val();
		var data={key:key,vip:vip};
		$.ajax({
			 url:YM['change_level'],
			 type:'POST',
			 data:data,
			 dataType:'json',
			 beforeSend:function(){
				 obj.button('loading');
			 },
			 success:function(data){
				 if(data.code=='200'){
					 alertTips($('#tips-modal'),data.Msg,YM['redirectPath']);
				 }else if(data.code=='201'){
						alertTips($('#tips-modal'),data.Msg);
				 }
			 },
			 complete:function(){
				 obj.button('reset');
			 }
		 });
	});
});