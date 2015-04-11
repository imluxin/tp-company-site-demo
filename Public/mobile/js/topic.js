/**
 * 
 */
$(function(){
	  $('input').iCheck({
	    checkboxClass: 'icheckbox_square-blue',
	    radioClass: 'iradio_square-blue',
	    increaseArea: '20%' // optional
	  });
	  
	  $('.js-submit').click(function(){
		  var all_answer = true;
		  var error_msg = '';
		  $('.error-wrap').remove();
		  $('.topic-list-item').each(function(i){
			  var is_check = false;
			  switch(parseInt($(this).attr('data-type'))){
				  case 1:
					  error_msg = '请选择一个选项';
					  $(this).find('.list-group-item').each(function(i){
						  if($(this).find('.iradio_square-blue').hasClass('checked')){
							  is_check = true;
							  return true;
						  }
					  });
				    break;
				  case 2:
					  error_msg = '请至少选择一个选项';
					  $(this).find('.list-group-item').each(function(i){
						  if($(this).find('.icheckbox_square-blue').hasClass('checked')){
							  is_check = true;
							  return true;
						  }
					  });
				    break;
				  case 3:
					  error_msg = '请填写此项';
					  if($(this).find('input.option-text').val() !== ''){
						  is_check = true;
						  return true;
					  }
				    break;
				  case 4:
					  error_msg = '请完整填写此题';
					  $(this).find('.list-group-item').each(function(i){
						  if($(this).find('input.option-text').val() !== ''){
							  is_check = true;
						  }else{
							  is_check = false;
						  }
					  });
				    break;
			  }

			  if(!is_check){
				  all_answer = false;
				  var html='<div class="error-wrap"><h4 class="text-center error-msg">'+ error_msg +'</h4></div>';
				  $(this).parents('.topic_list').before(html);
				  var errorOffset = $('.error-wrap').offset();
				  $('body').scrollTop(errorOffset.top);
				  return false;
			  }else{
				  all_answer = true;
			  }
		  })
		  if(all_answer){
			  $('#form_topic').submit();
		  }
	  })
})