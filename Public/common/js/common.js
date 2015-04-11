/**
 * 公共js
 *
 * CT: 2014-10-08 18:10 by YLX
 * UT: 2014-10-10 09:52 by YLX
 */


// 重写js alert 方法
function ym_alert($msg)
{
    alert($msg);
}

// 错误信息渐隐, 需传入渐隐element id
function ym_fadeout(id)
{
    var alert  = $('#'+id), time=3;
    var interval = setInterval(function(){
        time--;
        if(time <= 0) {
            alert.fadeOut(1000);
            clearInterval(interval);
        };
    }, 1000);
}


/**
 * JS模态框弹出
 *
 * CT: 2014-12-02 10:50 by QXL
 */
function alertTips(obj,msg,url){
	obj.modal('show');
	obj.find('.tips-msg').html(msg);
	var t=setTimeout(function(){
		if(url){
			location.href=url;
		}else{
			obj.modal('hide');
		}
		clearTimeout(t);
	},1800);
	
	$('#tips-modal').on('hidden.bs.modal', function (e) {
		if(url){
			location.href=url;
		}else{
			obj.modal('hide');
		}
	})
}

function alertConfirm(msg, url) {
    var obj = $('#confirm-modal');
    obj.modal('show');
    obj.find('.tips-msg').html(msg);
    $('#confirm_yes').click(function(){
        location.href=url;
    });
    $('#confirm_no').click(function(){
        obj.modal('hide');
    });
}

function alertModal(obj, msg){
	obj.modal('show');
	obj.find('.tips-msg').html(msg);
}

$(document).ready(function(){

	// 设置等高 -- START
	//等高列的小插件
	// function setEqualHeight(columns) {
	// 	var tallestColumn = 0;
	// 	columns.each(function(){
	// 		currentHeight = $(this).height();
	// 		if(currentHeight > tallestColumn) {
	// 			tallestColumn = currentHeight;
	// 		}
	// 	});
	// 	columns.height(tallestColumn);
	// }
	//调用写好的插件，基中“.container > div”是你需要实现的等高列
	// setEqualHeight($(".main > div"));
	// 设置等高 -- END

    // --------------
    // 复制到剪贴板
    // --------------
    var client = new ZeroClipboard( $(".copy-button") );
    client.on( "ready", function( readyEvent ) {
        // alert( "ZeroClipboard SWF is ready!" );
        client.on( "aftercopy", function( event ) {
            // `this` === `client`
            // `event.target` === the element that was clicked
            //event.target.style.display = "none";
            $('.copy-button').text('已复制');
            setTimeout("$('.copy-button').text('重新复制');", 2000);
            //alert("Copied text to clipboard: " + event.data["text/plain"] );
        } );
    } );
	
    // 删除消息 -- START
    function del_confirm(url, msg){
        if (confirm(msg)) {
            location.href=url;
        }
        return false;
    }
	$('.ym_del').click(function(){
        msg = $(this).attr('msg');
        if(!msg) msg = '确认要删除?';
        del_confirm($(this).attr('url'), msg);
        return false;
    });
    // 删除消息 -- END
	
	// 去消input自动填充
	$('input[autocomplete="off"]').each(function(){
        var input = this;
        var name = $(input).attr('name');
        var id = $(input).attr('id');

        $(input).removeAttr('name');
        $(input).removeAttr('id');      

        setTimeout(function(){ 
            $(input).attr('name', name);
            $(input).attr('id', id);            
        }, 1);
    });

	
});