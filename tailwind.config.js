/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/Libraries/CustomTagReplacer/BBCodeTags/*.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
