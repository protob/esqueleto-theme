// postcss.config.js
const purgecss = require('@fullhuman/postcss-purgecss')({

    // Specify the paths to all of the template files in your project 
    content: [
        './src/**/*.html',
        './src/**/*.vue',
        './src/**/*.jsx',
        // etc.
    ],

    // Include any special characters you're using in this regular expression
    defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
})


const uncssConfig = {
    html: [
        'http://Esqueleto-woo.test',
        // Your entire sitemap added manually
        // or some other way if you’re clever (wget is handy for this).
    ]
};

module.exports = {
    // syntax: 'postcss-scss',
    plugins: [
        require('precss'),
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
        'postcss-uncss': uncssConfig, // ← Add the plugin
        ...process.env.NODE_ENV === 'production' ? [purgecss] : [],


        ...process.env.NODE_ENV === 'production' ? require('cssnano') : false
    ]
}


