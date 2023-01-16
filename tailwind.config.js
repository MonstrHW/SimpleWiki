/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Libraries/CustomTagReplacer/BBCodeTags/*.php",
    ],
    future: {
        hoverOnlyWhenSupported: true,
    },
    theme: {
        extend: {},
    },
    plugins: [],
};
