/*!
 * common.js 通用方法
 *
 *
 */
define(function (require) {

var $ = require('jquery');
var dialog = require('dialog');


var common = {

    //刷新验证码的方法




    //js_refresh 刷新验证码
    //刷新验证码
    refresh_vcode:function(){
        var vcodeimg = $("img.vcode").attr("src");
        $('.js_refresh').click(function(){
            if( vcodeimg.indexOf('?')>0){
                $("img.vcode").attr("src", vcodeimg+'&random='+Math.random());
            }else{
                $("img.vcode").attr("src", vcodeimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    }

	//验证email的格式
    , is_email:function(text) {
        var reEmail = /^(?:\w+\.?)*\w+@(?:\w+\.)+\w+$/;
        return reEmail.test(text);
    }

    //验证昵称
    , is_nickname:function(text) {   	
        var reNickname = /^[\u4E00-\u9FA5A-Za-z0-9_]+$/;
        return reNickname.test(text);
    }

    //验证手机号码格式是否正确
    , is_mobile:function(text) {
        var reMobile = /^1[358]\d{9}$/;
        return reMobile.test(text);
    }


    //表格 table 隔行换色
    , tablecolor:function(handler) {
        if( $(handler + ' > thead').length > 0 ){
            $(handler + ' > tbody').each(function() {
                var self = this;
                $("tr:even", $(self)).addClass("even"); // 从标头行下一行开始的奇数行，行数：(1，3，5...)
                $("tr:odd", $(self)).addClass("odd"); // 从标头行下一行开始的偶数行，行数：(2，4，6...)
                // 鼠标经过的行变色
                $("tr", $(self)).hover(
                    function () { $(this).addClass('on'); },
                    function () { $(this).removeClass('on'); }
                );
                // 选择行变色
                $("tr", $(self)).click(function (){
                    $(self).find(".in").removeClass('in');
                    $(this).addClass('in');
                });
            });
        }else{
            $(handler).each(function() {
                var self = this;
                $("tr:first", $(self)).addClass("head"); //给没有thead的表格第一行加上head css
                $("tr:even:not(:first)", $(self)).addClass("odd"); // 从标头行下一行开始的奇数行，行数：(1，3，5...)
                $("tr:odd", $(self)).addClass("even"); // 从标头行下一行开始的偶数行，行数：(2，4，6...)
                // 鼠标经过的行变色
                $("tr:not(:first)", $(self)).hover(
                    function () { $(this).addClass('on'); },
                    function () { $(this).removeClass('on'); }
                );
                // 选择行变色
                $("tr", $(self)).click(function (){
                    $(self).find(".in").removeClass('in');
                    if ($(this).get(0) == $("tr:first", $(self)).get(0)){
                        return;
                    }
                    $(this).addClass('in');
                });
            });
        };

    }


    , tips:function(params){
        var conf = {
            'id':'common-dialog-tips',
            'this':null,
            'content':'',
            'align':'left',
            'padding':5
        }
        $.extend(conf, params);
        if(dialog.get(conf.id)){
            dialog.get(conf.id).close().remove();
        };
        dialog({
            id:conf.id,
            content:conf.content,
            align:conf.align,
            padding:conf.padding
        }).show(conf.this);
    }



    //更新提示
    , alert:function(params){
        var conf = {
            'id':'id-dialog-alert',
            'content':'',
            'icon':'i-success', 
            'time':3000,
            'padding':5
        }
        $.extend(conf,params);
        if(dialog.get(conf.id)){
            dialog.get(conf.id).close().remove();
        };
        html =  '<div class="dialog-alert">'+
                '   <span class="dialog-alert-icon">'+
                '       <i class="' + conf.icon + '"></i>'+
                '   </span>'+
                '   <span class="dialog-alert-text">' + conf.content + '</span>'+
                '</div>';

        var d = dialog({
            id:conf.id,
            content:html,
            padding:conf.padding
        }).show();

        setTimeout(function () {
            d.close().remove();
        }, conf.time);
    }


    /*
      //topbar的两个下拉框
      $('#topbar .topnav').mouseenter(function(){
        $(this).addClass('cur');
      }).mouseleave(function(){
        $(this).removeClass('cur');
      });
*/

}



return common
});