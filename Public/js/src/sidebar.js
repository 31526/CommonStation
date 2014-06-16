//sidebar.js
//边栏工具
//返回顶部-咨询反馈-快捷导航
define(['jquery', 'underscore'], function ($, _){
    
    "use strict";
    
    var sidebar = {
        
        init:function(options){
            console.log('sidebar init2000');
            
            this.build();
        },
        
        //构建html代码
        build:function(){
            
            var style = '';
            var html = '<div id="js_sidebar" class="sidebar fixed" style="'+ style +'">'
                     + '    <ul>'
                     + '        <li>标头</li>'
                     + '        <li>反馈</li>'
                     + '        <li>活动</li>'
                     + '        <li>顶部</li>'
                     + '    </ul>'
                     + '</div>';
            
            $('body').append(html);            
        },
        
        
        
        
        
        
        
    }
    
    return sidebar;    
});

