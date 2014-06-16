require.config({
    
    //baseUrl: "public/js",
    baseUrl: '/public/js/'
    
    , paths: {
        "jquery": "jquery-1.9.1.min"
        ,"common": "common"
        ,"dialog": "lib/art/dialog"
        ,"backbone": "backbone-min"
        ,"underscore": "underscore-min"
        // "underscore": "lib/underscore-min",
        // "backbone": "lib/backbone-min"
    } 

    //特性说明
    , shim: {
        'underscore':{
            exports: '_'
        },
        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'bb'  //Backbone
        }
    }

    
});


/*

define(['moduledemo'],function(md){
    md.init();
});

require(['jquery', 'underscore', 'backbone'], function ($, _, bb){
    console.dir($);
    console.dir(_);
    console.dir(bb);

    console.log('require-main');
});

*/
