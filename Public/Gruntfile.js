module.exports = function(grunt) {

  "use strict";// ECMAScript 严格模式
  
  //在gruntfile.js的顶部，grunt.initConfig的上面，加上：
  require("matched").filterDev("grunt-*").forEach(grunt.loadNpmTasks);
  
  // Project configuration.
  //任务配置
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        src: 'src/<%= pkg.name %>.js',
        dest: 'build/<%= pkg.name %>.min.js'
      }
    },
    watch:{
      js:{
        files:['src/js/*.js'],
        tasks:['uglify']
      },
      css:{
        files:['src/css/*.css'],
        tasks:['buildcss']
      }
    },
    
    cssmin:{
      
      build:{
        src: 'src/<%= pkg.name %>.css',
        dest: 'build/<%= pkg.name %>.min.css'
      }
    }
  });

  // Load the plugin that provides the "uglify" task.
  // 插件加载声明
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Default task(s).
  // 定义任务组合
  grunt.registerTask('default', [uglify]);
  

};