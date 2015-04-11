/**
 * 
 */
$(function(){
	$('.js-add-topic').click(function(){	
		var type = $(this).attr('data-type');
		var topicOrder  = $('.topic-list-item').size() == '0' ? parseInt(1) : parseInt($('.topic-list-item:last').attr('data-order'))+1;
		var topicNum = $('.topic-list-item').size()+1;
		var topicHtml = '';
		topicHtml += '<li class="topic-list-item" data-tid="" data-order="'+topicOrder+'" data-sort="'+topicOrder+'" data-type="'+type+'">';
		topicHtml += '<div class="topic_item">';
		topicHtml += '<div class="topic_item_menu">';
		topicHtml += '<h4 class="text-center topic_num">Q'+topicNum+'</h4>';
		topicHtml += '<input type="hidden" name="topic['+topicOrder+'][topic_guid]" value="">';
		topicHtml += '<input type="hidden" name="topic['+topicOrder+'][topic_sort]" value="'+topicOrder+'">';
		topicHtml += '<input type="hidden" name="topic['+topicOrder+'][topic_type]" value="'+type+'">';
		topicHtml += '<ul class="operation_option unstyled">';
		if(type != 3){
			topicHtml += '<li class="text-center"><a class="js-add-topic-option" href="javascript:void(0);"><i class="fa fa-plus-square-o"></i></a></li>';
		}
		topicHtml += '<li class="text-center"><a class="js-del-topic" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a></li>';
		topicHtml += '</ul>';
		topicHtml += '</div>';
		switch(parseInt(type)){
			case 1:
			case 2:	
				topicHtml += '<div class="topic_item_con" data-type="'+type+'">';
				if(type == '1'){
					topicHtml += '<h4><input type="text" name="topic['+topicOrder+'][topic_title]" placeholder="单项选择题" class="form-control topic_title" value="单项选择题"></h4>';
				}else if(type == '2'){
					topicHtml += '<h4><input type="text" name="topic['+topicOrder+'][topic_title]" placeholder="多项选择题" class="form-control topic_title" value="多项选择题"></h4>';
				}
				topicHtml += '<ul class="ques_option_list unstyled">';
				for(var i=1; i<3; i++){
					topicHtml += '<li class="module" data-oid="" data-sort="'+i+'">';
					topicHtml += '<div class="ques_option_item">';
					topicHtml += '<div class="col-md-8 ques_option_input_item">';
					topicHtml += '<div class="input-icon right">';
					topicHtml += '<input type="text" name="topic['+topicOrder+'][option]['+i+'][title]" placeholder="选项'+i+'" class="form-control input-sm option_title" value="选项'+i+'">';
					topicHtml += '<input type="hidden" name="topic['+topicOrder+'][option]['+i+'][sort]" value="'+i+'">';
					topicHtml += '<input type="hidden" name="topic['+topicOrder+'][option]['+i+'][guid]" value="">';
					topicHtml += '</div>';
					topicHtml += '</div>';
					topicHtml += '<div class="col-md-4 ques_option_operation hiden">';
					topicHtml += '<a href="javascript:void(0);" class="js-del-option"><i class="fa fa-trash-o"></i></a>';
					topicHtml += '</div>';
					topicHtml += '</div>';
					topicHtml += '</li>';
				}
				topicHtml += '</ul>';
				topicHtml += '</div>';
				break;
			case 3:
				topicHtml += '<div class="topic_item_con" data-type="'+type+'">';
				topicHtml += '<h4><input type="text" name="topic['+topicOrder+'][topic_title]" placeholder="" class="form-control topic_title" value="单项填空题"></h4>';
				topicHtml += '<ul class="ques_option_list unstyled">';
				topicHtml += '<li class="module" data-oid="">';
				topicHtml += '<div class="ques_option_item">';
				topicHtml += '<div class="col-md-8 ques_option_input_item">';
				topicHtml += '<div class="input-icon right">';
				topicHtml += '<input type="text" disabled=true class="form-control input-sm" value="此处为用户录入表单展示">';
				topicHtml += '</div>';
				topicHtml += '</div>';
				topicHtml += '</div>';
				topicHtml += '</li>';
				topicHtml += '</ul>';
				topicHtml += '</div>';
			  break;
			case 4:
				topicHtml += '<div class="topic_item_con" data-type="'+type+'">';
				topicHtml += '<h4><input type="text" name="topic['+topicOrder+'][topic_title]" placeholder="" class="form-control topic_title" value="多项填空题"></h4>';
				topicHtml += '<ul class="ques_option_list unstyled">';
				for(var i=1; i<3; i++){
					topicHtml += '<li class="module" data-oid="">';
					topicHtml += '<div class="ques_option_item">';
					topicHtml += '<div class="col-md-3 ques_option_input_item">';
					topicHtml += '<div class="input-icon right">';
					topicHtml += '<input type="text" name="topic['+topicOrder+'][option]['+i+'][title]" placeholder="选项'+i+'" class="form-control input-sm option_title" value="选项'+i+'">';
					topicHtml += '<input type="hidden" name="topic['+topicOrder+'][option]['+i+'][sort]" value="'+i+'">';
					topicHtml += '<input type="hidden" name="topic['+topicOrder+'][option]['+i+'][guid]" value="">';
					topicHtml += '</div>';
					topicHtml += '</div>';
					topicHtml += '<div class="col-md-5 ques_option_input_item">';
					topicHtml += '<div class="input-icon right">';
					topicHtml += '<input type="text" disabled=true class="form-control input-sm" value="此处为用户录入表单展示">';
					topicHtml += '</div>';
					topicHtml += '</div>';
					topicHtml += '<div class="col-md-4 ques_option_operation hiden">';
					topicHtml += '<a href="javascript:void(0);" class="js-del-option"><i class="fa fa-trash-o"></i></a>';
					topicHtml += '</div>';
					topicHtml += '</div>';
					topicHtml += '</li>';
				}
				topicHtml += '</ul>';
				topicHtml += '</div>';
			  break;
		}
		topicHtml += '</div>';
		topicHtml += '</li>';
		$('.topic_list').append(topicHtml);
	})
	
	$('body').on('mouseover mouseout','.module',function(event){
		if(event.type == "mouseover"){
			$(this).find('.ques_option_operation').show();
		}else if(event.type == "mouseout"){
			$(this).find('.ques_option_operation').hide();
		}		
	})
	
	
	$('body').on('click','.js-add-topic-option',function(){
		var type=$(this).parents('.topic-list-item').attr('data-type');
		var order = $(this).parents('.topic-list-item').attr('data-order');
		var optionHtml = '';
		var optionIndex = $(this).parents('.topic-list-item').find('.module').size()+1;
		switch(parseInt(type)){
			case 1:
			case 2:
				optionHtml += '<li class="module" data-oid="" data-sort="'+optionIndex+'">';
				optionHtml += '<div class="ques_option_item">';
				optionHtml += '<div class="col-md-8 ques_option_input_item">';
				optionHtml += '<div class="input-icon right">';
				optionHtml += '<input type="text" name="topic['+order+'][option]['+optionIndex+'][title]" placeholder="选项'+optionIndex+'" class="form-control input-sm option_title" value="选项'+optionIndex+'">';
				optionHtml += '<input type="hidden" name="topic['+order+'][option]['+optionIndex+'][sort]" value="'+optionIndex+'">';
				optionHtml += '<input type="hidden" name="topic['+order+'][option]['+optionIndex+'][guid]" value="">';
				optionHtml += '</div>';
				optionHtml += '</div>';
				optionHtml += '<div class="col-md-4 ques_option_operation hiden">';
				optionHtml += '<a href="javascript:void(0);" class="js-del-option"><i class="fa fa-trash-o"></i></a>';
				optionHtml += '</div>';
				optionHtml += '</div>';
				optionHtml += '</li>';
				break;
			case 4:
				optionHtml += '<li class="module" data-oid="" data-sort="'+optionIndex+'">';
				optionHtml += '<div class="ques_option_item">';
				optionHtml += '<div class="col-md-3 ques_option_input_item">';
				optionHtml += '<div class="input-icon right">';
				optionHtml += '<input type="text" name="topic['+order+'][option]['+optionIndex+'][title]" placeholder="选项'+optionIndex+'" class="form-control input-sm option_title" value="选项'+optionIndex+'">';
				optionHtml += '<input type="hidden" name="topic['+order+'][option]['+optionIndex+'][sort]" value="'+optionIndex+'">';
				optionHtml += '<input type="hidden" name="topic['+order+'][option]['+optionIndex+'][guid]" value="">';
				optionHtml += '</div>';
				optionHtml += '</div>';
				optionHtml += '<div class="col-md-5 ques_option_input_item">';
				optionHtml += '<div class="input-icon right">';
				optionHtml += '<input type="text" disabled=true name="ques_option_title" placeholder="" class="form-control input-sm" value="此处为用户录入表单展示">';
				optionHtml += '</div>';
				optionHtml += '</div>';
				optionHtml += '<div class="col-md-4 ques_option_operation hiden">';
				optionHtml += '<a href="javascript:void(0);" class="js-del-option"><i class="fa fa-trash-o"></i></a>';
				optionHtml += '</div>';
				optionHtml += '</div>';
				optionHtml += '</li>';
				break;
		}
		$(this).parents('.topic_item').find('.ques_option_list').append(optionHtml);
	})
	
	
	$('body').on('click','.js-del-option',function(){
		var optionIndex = $(this).parents('.topic-list-item').find('.module').size();
		var oid = $(this).parents('.module').attr('data-oid');
		if(optionIndex<3){
			alertTips($('#tips-modal'), '本题至少要有2个选项');
		}else{
			$('#confirm_yes').attr('data-oid',oid);
			$('#confirm_yes').attr('data-type','deloption');
			alertModal($('#confirm-modal'), '确定要删除么?');
		}
	})
	
	$('body').on('click','.js-del-topic',function(){
		var tid = $(this).parents('.topic-list-item').attr('data-tid');
		if(tid == ''){
			$(this).parents('.topic-list-item').remove();
			$('.topic-list-item').each(function(i){
				$(this).find('.topic_num').html('Q'+(i+1));
			})
		}else{
			$('#confirm_yes').attr('data-tid',tid)
			$('#confirm_yes').attr('data-type','deltopic')
			alertModal($('#confirm-modal'), '确定要删除么?');
		}
	})
	
	$('#confirm_yes').click(function(){
		var type = $(this).attr('data-type');
		switch(type) {
		case 'deltopic':
			var tid = $(this).attr('data-tid');
			var data = {tid:tid}
			$.ajax({
				 url:YM['delTopic'],
				 type:'POST',
				 data:data,
				 dataType:'json',
				 beforeSend:function(){
					 
				 },
				 success:function(data){
				 	if(data.status == 'ok'){
				 		$('.topic-list-item[data-tid='+tid+']').remove();
				 	}else if(data.status == 'ko'){
				 		alertTips($('#tips-modal'), data.msg);
				 	}
				 },
				 complete:function(){
					 
				 }
			 });
		  break;
		case 'deloption':
			var oid = $(this).attr('data-oid');
			var data = {oid:oid}
			$.ajax({
				 url:YM['delOption'],
				 type:'POST',
				 data:data,
				 dataType:'json',
				 beforeSend:function(){
					 
				 },
				 success:function(data){
				 	if(data.status == 'ok'){
				 		$('.module[data-oid='+oid+']').remove();
				 	}else if(data.status == 'ko'){
				 		alertTips($('#tips-modal'), data.msg);
				 	}
				 },
				 complete:function(){
					 
				 }
			 });
		  break;
		}
	})
	
	
	
	$('body').on('blur','.topic_title',function(){
		if($(this).val()==''){
			$(this).val($(this).attr('placeholder'));
		}
	});
	
	$('body').on('blur','.option_title',function(){
		if($(this).val()==''){
			$(this).val($(this).attr('placeholder'));
		}
	});
	
	$('form#actForm').validate({
	    ignore: '',
	    errorPlacement: function(error, element){
	        element.parent().parent().next('.tishinr').html(error);
	    },
	    rules: {
	        name: {
	            required: true,
	            rangelength: [2, 50]
	        },
	        description:{
	            required: true,
	        },
	        conclusion:{
	            required: true,
	        },
	        startTime:{
	            required: true,
	            after_subject_start: true
	        },
	        endTime: {
	            required: true,
	            before_subject_end: true,
	            afterstart: true
	        }
	    },
	    messages: {
	        name: {
	            required: "问卷名称不能为空",
	            rangelength: "问卷名称不得少于两个字，不得多于五十个字"
	        },
	        description:{
	        	required: "问卷描述不能为空",
	        },
	        conclusion:{
	        	required: "问卷结束提示不能为空",
	        },
	        startTime:{
	            required: "文章开始时间不能为空"
	        },
	        endTime:{
	            required: "文章结束时间不能为空"
	        }
	    }
//	    submitHandler: function(form) { //通过之后回调
//	    	if($('.topic-list-item').size() == '0'){
//	    		alertTips($('#tips-modal'), '至少创建一组问卷选项');
//	    		return false;
//	    	}
//        }
	})
})