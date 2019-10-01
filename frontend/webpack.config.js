// Load the core node modules.
const path = require('path');

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
// include the css extraction and minification plugins
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const CleanWebpackPlugin = require('clean-webpack-plugin')
const CleanObsoleteChunks = require('webpack-clean-obsolete-chunks');
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const UnCSSPlugin = require('uncss-webpack-plugin');
const webpack = require("webpack");
const tailwind = require('tailwindcss')
const autoprefixer = require('autoprefixer');
const postcssenv = require('postcss-preset-env')()
const cssnano = require('cssnano')()
const uncss= require('postcss-uncss')


const uncssConfig = {
  html: [
    'http://skeleton.test',
    'http://skeleton.test/sample-page/'
    // Entire sitemap sould be added manually
  ]
};


module.exports = (env, argv) => {

  const isDevMode = argv.mode !== 'production'
  const sassLoaderPlugins = isDevMode ? [
    tailwind,
    autoprefixer,
    // postcssenv,
    // cssnano
  ] : [
    autoprefixer,
    postcssenv,
    cssnano,
    uncss(uncssConfig)
  ]


  const postcssLoaderPlugins = [
    tailwind,
    autoprefixer,
    postcssenv,
    cssnano,
    uncss(uncssConfig)

  ]


  const sassLoader = isDevMode ? 'style-loader' : MiniCssExtractPlugin.loader;
  const loaderArr = !isDevMode ? [
    sassLoader,
    {
      loader: 'css-loader',
      options: {
        importLoaders: 1,
        ident: 'postcss',
        plugins: [
          require('tailwindcss'),
          require('autoprefixer'),
        ],

      }
    }
  ] : [sassLoader]


  const devtool = isDevMode ?
      "eval-source-map" :
      "nosources-source-map";


  const moduleIdentifierPlugin = isDevMode ?
      new webpack.NamedModulesPlugin() :
      new webpack.HashedModuleIdsPlugin();

  return ({

    // entry: ['./app.js', './style.css'],
    entry: ['./app.js', './style.css'],
    output: {
      filename: './dist/app.min.[hash].js',
      path: path.resolve(__dirname)
    },
    // devtool: devtool,
    resolve: {
      alias: {
        "TweenLite": path.resolve('node_modules', 'gsap/src/uncompressed/TweenLite.js'),
        "TweenMax": path.resolve('node_modules', 'gsap/src/uncompressed/TweenMax.js'),
        "TimelineLite": path.resolve('node_modules', 'gsap/src/uncompressed/TimelineLite.js'),
        "TimelineMax": path.resolve('node_modules', 'gsap/src/uncompressed/TimelineMax.js'),
        "ScrollMagic": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js'),
        "animation.gsap": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js'),
        "debug.addIndicators": path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js'),
        '@': path.resolve('src'),
        vue: 'vue/dist/vue.js',
        'assets': path.resolve(__dirname, 'img')
      }
    },
    module: {
      rules: [
        //babel on all .js
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: "babel-loader",
            options: {
              presets: ['@babel/preset-env']
            }
          }
        },
        {
          test: /\.vue$/,
          loader: 'vue-loader',
          options: {
            loaders: {
              // https://vue-loader.vuejs.org/guide/scoped-css.html#mixing-local-and-global-styles
              css: ['vue-style-loader', {
                loader: 'css-loader',
              }],
              // js: [
              //     'babel-loader',
              // ],
            },
            cacheBusting: true,
          },

        },

        {
          test: /\.(sass|css|scss)$/,
          use: [

            ...loaderArr,
            {
              loader: "postcss-loader",
              options: {
                parser: "postcss-scss",

                ident: 'postcss',
                plugins: postcssLoaderPlugins,
                // plugins: (loader) => [
                //   ...postcssLoaderPlugins,
                //   // require('postcss-import')({
                //   //   root: loader.resourcePath
                //   // }),
                //
                //
                // ]


              }
            },
            {
              loader: 'sass-loader',
              options: {
                ident: 'postcss',
                plugins: sassLoaderPlugins,
                // plugins: (loader) => [
                //     ...sassLoaderPlugins,
                //   // require('postcss-import')({
                //   //   root: loader.resourcePath
                //   // })
                // ]
              }
            },
            // 'postcss-loader'
          ]
        },

        {
          test: /\.(png|jpg|gif)$/,
          use: [{
            loader: 'file-loader',
            options: {}
          }]
        }
        // {
        //   test: /\.(jpe?g|png|gif|svg)$/i,
        //   loaders: [
        //       'file?hash=sha512&digest=hex&name=images/[name].[ext]',
        //       'image-webpack?bypassOnDebug&optimizationLevel=7&interlaced=false'
        //   ]
        // }
      ]
    },
    plugins: [

      new VueLoaderPlugin(),
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery'
      }),

      new CleanObsoleteChunks(),
      new CleanWebpackPlugin(['dist/*']),
      // extract css into dedicated file
      new MiniCssExtractPlugin({
        filename: isDevMode ? '[name].css' : './dist/main.min.[hash].css'
      }),

    ],
    optimization: {
      minimizer: [

        new TerserPlugin({
          cache: true,
          parallel: true

        }),
        // enable the css minification plugin
        new OptimizeCSSAssetsPlugin({})
      ],

      // splitChunks: {
      //   chunks: "all"
      // },
      // runtimeChunk: "single"
    }
  });

};