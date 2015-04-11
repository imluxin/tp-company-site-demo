/**
 * Created by Admin on 2015/2/27.
 */
    $(document).ready(function(){
        var ue = UE.getEditor('ym_editor',{
            initialFrameHeight:450,
            serverUrl : YM['ueditor_server_url']
        });

        //表单验证
        $('#article_form').submit(function() {
            UE.getEditor('ym_editor').sync();
        }).validate({
            ignore: '',
            errorPlacement: function(error, element){
                element.parent().parent().next('.tishinr').append(error);
            },
            rules: {
                name: {
                    required: true,
                    rangelength: [2, 50]
                },
                startTime: {
                    required: true,
                    after_subject_start: true
                },
                endTime: {
                    required: true,
                    before_subject_end: true,
                    afterstart: true
                },
                content: {
                    required: true,
                    rangelength:[2,10000]
                }
            },
            messages: {
                name: {
                    required: "文章名称不能为空",
                    rangelength: "文章名称不得少于两个字，不得多于五十个字"
                },
                startTime: {
                    required: "文章开始时间不能为空"
                },
                endTime: {
                    required: "文章结束时间不能为空"
                },
                content: {
                    required: "文章内容不能为空",
                    rangelength: "文章内容不能少于两个字或不能多于一万个字"
                }
            }
        }).focusInvalid = function() {
            if( this.settings.focusInvalid ) {
                try {
                    var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                    if (toFocus.is("textarea")) {
                        UE.getEditor('ym_editor').focus()
                    } else {
                        toFocus.filter(":visible").focus();
                    }
                } catch(e) {
                }
            }
        };
    });