(function(){
    "use strict";
    
    var common = {
        
        init:function(){
            
            console.log(' this init..');
            
            this.destory();
        },
        
        destory:function(){
            
            console.log('this is destory');
        }
        
    }
    
    
    common.init();
    
})();