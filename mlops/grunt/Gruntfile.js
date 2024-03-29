module.exports = function (grunt) {
	const sass = require("node-sass");
	//var autoprefixer = require('autoprefixer');

	// Uncomment config to use the svg_sprite task
	const config = {
		dest: "assets/icons/renders",
		shape: {
			id: {
				separator: "",
				generator: ""
			},
		},
		mode: {
			symbol: {        // Create a «symbol» sprite
				inline: true, // Prepare for inline embedding
				sprite: "sprite.svg", // Sprite path and name
				example: true, // Create an HTML example document
				dest: "",
			},
		},
	};
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		watch: {
			// This is where we set up all the tasks we'd like grunt to watch for
			// changes.
			// files: ['<%= jshint.files %>'],
			// tasks: ['jshint', 'qunit'],
			// scripts: {
			//   files: ['js/**/{,*/}*.js'],
			//   tasks: ['uglify', 'concat'],
			//   options: {
			//     spawn: false,
			//   },
			// },
			css: {
				files: ["sass/{,*/}{,*/}{,*/}*.{scss,sass}", "template-parts/blocks/**/*.scss"],
				tasks: ["sass:dev", "postcss:dev"],
				options: {
					spawn: false,
				},
			},
		},
		svg_sprite: {
			minimal: {
				src: ["assets/icons/source/**/*.svg"],
				dest: "assets/icons/renders",
				options: config,
			},
		},
		// uglify: {
		//     // This is for minifying all of our scripts.
		//     options: {
		//       mangle: false,
		//       preserveComments: false
		//     },
		//     my_target: {
		//       files: [{
		//         expand: true,
		//         cwd: 'js/source',
		//         src: '{,*/}{,*/}{,*/}*.js',
		//         dest: 'js/build'
		//       }]
		//     }
		// },
		// concat: {
		//     options: {
		//       // define a string to put between each file in the concatenated output
		//       separator: ';\n'
		//     },
		//     dist: {
		//       // the files to concatenate
		//       src: [
		//             'js/build/vendor/jquery.youtubebackground.js',
		//             'js/build/vendor/smartmenus/jquery.smartmenus.js',
		//             'js/build/header.js',
		//             'js/build/main.js',
		//             ],
		//       // the location of the resulting JS file
		//       dest: 'js/scripts-all.js'
		//     }
		// },
		qunit: {
			files: ["test/**/*.html"],
		},
		// jshint: {
		//     // define the files to lint
		//     files: ['Gruntfile.js', 'src/**/*.js', 'test/**/*.js'],
		//     // configure JSHint (documented at http://www.jshint.com/docs/)
		//     options: {
		//       // more options here if you want to override JSHint defaults
		//       globals: {
		//         jQuery: true,
		//         console: true,
		//         module: true
		//       }
		//     }
		// },
		sass: {
			prod: {
				options: {
					implementation: sass,
					style: "compressed", // This controls the compiled css and can be changed to nested, compact or compressed
					sourceMap: false,
				},
				files: [
					{
						expand: true,
						cwd: "sass",
						src: ["*.scss", "../template-parts/blocks/**/*.scss"],
						dest: "css/",
						ext: ".css",
					},
				],
				tasks: ["postcss:prod"],
			},
			dev: {
				options: {
					implementation: sass,
					style: "compressed", // This controls the compiled css and can be changed to nested, compact or compressed
					sourceMap: true,
				},
				files: [
					{
						expand: true,
						cwd: "sass",
						src: ["*.scss", "../template-parts/blocks/**/*.scss"],
						dest: "css/",
						ext: ".css",
					},
				],
				tasks: ["postcss:dev"],
			},
		},
		postcss: {
			prod: {
				options: {
					map: false,
					processors: [
						require("pixrem")(), // add fallbacks for rem units
						//require('autoprefixer')(), // add vendor prefixes
						require("cssnano")(), // minify the result
					],
				},
				src: "css/*.css",
			},
			dev: {
				options: {
					map: true,
					processors: [
						require("pixrem")(), // add fallbacks for rem units
						//require('autoprefixer')(), // add vendor prefixes
						require("cssnano")(), // minify the result
					],
				},
				src: "css/*.css",
			},
		},
		// uncomment this for purifycss
		// purifycss: {
		//   options: {
		//     minify: true,
		//     whitelist: ['*align*', '*wp-*', '*woocommerce*', 'menu-about', 'menu-blog', 'menu-account', '*quantity*', '*gform*', '*ginput*', '*gfield*', '*ctf*', '*icon*']
		//      },
		//      target: {
		//     src: ['*.php', '**/*.php','js/scripts-all.js'],
		//     css: ['css/styles.css'],
		//     dest: 'css/purestyles.css'
		//   },
		//    },
	});

	// grunt.loadNpmTasks('grunt-contrib-uglify');
	// grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks("grunt-contrib-qunit");
	grunt.loadNpmTasks("grunt-contrib-watch");
	// grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks("grunt-postcss");
	grunt.loadNpmTasks("grunt-sass");
	//grunt.loadNpmTasks('grunt-purifycss');
	grunt.loadNpmTasks("grunt-svg-sprite");

	grunt.file.setBase("../");

	// this would be run by typing "grunt test" on the command line
	//grunt.registerTask('test', ['jshint', 'qunit']);

	// the default task can be run just by typing "grunt" on the command line. this will not output maps
	// run "grunt watch" when developing. this will output maps
	grunt.registerTask("default", ["sass:prod", "postcss:prod", "svg_sprite"]);
};
