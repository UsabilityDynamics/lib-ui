/**
 * Build Library.
 *
 * @author potanin@UD
 * @param grunt
 */
module.exports = function( grunt ) {

  grunt.initConfig({

    // Get Project Details.
    pkg: grunt.file.readJSON( 'composer.json' ),

    // Compile LESS in app.css
    less: {
      production: {
        options: {
          yuicompress: true,
          relativeUrls: true
        },
        files: {
          'styles/ui.css': [ 'styles/src/ui.less' ],
          'styles/ui.markdown.css': [ 'styles/src/ui.markdown.less' ]
        }
      },
      development: {
        options: {
          yuicompress: false,
          relativeUrls: true
        },
        files: {
          'styles/ui.dev.css': [ 'styles/src/ui.less' ],
          'styles/ui.markdown.dev.css': [ 'styles/src/ui.markdown.less' ]
        }
      }
    },

    // Run Mocha Tests.
    mochacli: {
      options: {
        require: [ 'should' ],
        reporter: 'list',
        ui: 'exports'
      },
      all: [ 'test/*.js' ]
    },

    // Create AMD files.
    requirejs: {
      dev: {
        options: {
          name: 'app.dev',
          baseUrl: 'scripts',
          out: "scripts/app.js",
          paths: {
            "knockout": 'http://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js',
            lodash: 'http://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.2.1/lodash.min.js',
            async: 'http://cdnjs.cloudflare.com/ajax/libs/async/0.2.7/async.min.js'
          }
        }
      }
    },

    // Documentation.
    yuidoc: {
      compile: {
        name: '<%= pkg.name %>',
        description: '<%= pkg.description %>',
        version: '<%= pkg.version %>',
        url: '<%= pkg.homepage %>',
        options: {
          paths: 'lib',
          outdir: 'static/codex/'
        }
      }
    },

    // Monitor.
    watch: {
      options: {
        interval: 100,
        debounceDelay: 500
      },
      less: {
        files: [
          'styles/less/*.less'
        ],
        tasks: [ 'less' ]
      },
      js: {
        files: [
          'scripts/src/*.js'
        ],
        tasks: [ 'uglify' ]
      }
    },

    // Minify all JS Files.
    uglify: {
      production: {
        options: {
          preserveComments: false,
          wrap: false
        },
        files: [
          {
            expand: true,
            cwd: 'scripts/src',
            src: [ '*.js' ],
            dest: 'scripts'
          }
        ]
      }
    },

    // Markdown Generation.
    markdown: {
      all: {
        files: [
          {
            expand: true,
            src: 'readme.md',
            dest: 'static/',
            ext: '.html'
          }
        ],
        options: {
          markdownOptions: {
            gfm: true,
            codeLines: {
              before: '<span>',
              after: '</span>'
            }
          }
        }
      }
    },

    // Remove Things.
    clean: [
      "vendor"
    ]

  });

  // Load NPM Tasks.
  grunt.loadNpmTasks( 'grunt-markdown' );
  grunt.loadNpmTasks( 'grunt-mocha-cli' );
  grunt.loadNpmTasks( 'grunt-requirejs' );
  grunt.loadNpmTasks( 'grunt-contrib-yuidoc' );
  grunt.loadNpmTasks( 'grunt-contrib-uglify' );
  grunt.loadNpmTasks( 'grunt-contrib-watch' );
  grunt.loadNpmTasks( 'grunt-contrib-less' );
  grunt.loadNpmTasks( 'grunt-contrib-concat' );
  grunt.loadNpmTasks( 'grunt-contrib-clean' );
  grunt.loadNpmTasks( 'grunt-shell' );

  // Build for Use.
  grunt.registerTask( 'default', [ 'markdown', 'less', 'uglify', 'yuidoc' ] );

  // Build for Distribution.
  grunt.registerTask( 'distribution', [ 'markdown', 'less:production', 'uglify:production', 'yuidoc' ] );

  // Update Environment.
  grunt.registerTask( 'update', [] );

};