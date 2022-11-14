module.exports = {
    "env": {
        "browser": true,
        "es6": true,
        "amd": true
    },
    "extends": [
        "airbnb-base",
        "prettier",
        "plugin:vue/recommended"
    ],
    "plugins": [
        "prettier"
    ],
    "globals": {
        "Atomics": "readonly",
        "SharedArrayBuffer": "readonly"
    },
    "parserOptions": {
        "ecmaVersion": 2018,
        "sourceType": "module"
    },
    "rules": {
        "vue/html-self-closing": 0,

        "vue/array-bracket-spacing": "off",
        "vue/html-closing-bracket-newline": "off",
        "vue/html-closing-bracket-spacing": "off",
        "vue/html-end-tags": "off",
        "vue/html-indent": "off",
        "vue/html-quotes": "off",
        "vue/key-spacing": "off",
        "vue/max-attributes-per-line": "off",
        "vue/multiline-html-element-content-newline": "off",
        "vue/mustache-interpolation-spacing": "off",
        "vue/no-multi-spaces": "off",
        "vue/no-spaces-around-equal-signs-in-attribute": "off",
        "vue/object-curly-spacing": "off",
        "vue/script-indent": "off",
        "vue/singleline-html-element-content-newline": "off",
        "vue/space-infix-ops": "off",
        "vue/space-unary-ops": "off",

        "prettier/prettier": ["error", {
            "endOfLine":"auto"
        }],
        "no-unused-vars": 0,
        "no-console": "off",
        "import/no-extraneous-dependencies": ["error", {"devDependencies": true}],
        "global-require": 0 
    }
};