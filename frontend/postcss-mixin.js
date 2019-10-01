// mixins.js

let placeholder = (mixin, immediateSelector = true) => {
    let vendors = [
        '::-webkit-input-placeholder',
        ':-moz-placeholder',
        '::-moz-placeholder',
        ':-ms-input-placeholder',
    ];

    return vendors.reduce((prev, vendor) => {
        let selector = immediateSelector ? `&${vendor}` : vendor;

        prev[selector] = {
            '@mixin-content': {},
        };

        return prev;
    }, {});
};

module.exports = {
    placeholder,
};