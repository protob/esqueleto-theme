// functions.js

let settings = require('./settings');

let rem = (pixels, context = settings.defaults.fontSizePxBase) => {
    pixels = parseFloat(pixels);

    let result = pixels / context;

    return `${result}rem`;
};

module.exports = {
    rem,
};