# WordPress Base file. classic theme

## Detail

WordPressのclassic-themeのベースフォルダです。

## Stack

PHP 8.0.0
TypeScript
SCSS

## Directory tree

<pre>
.
├── dist
│   ├── css
│   └── js
├── src
│   ├── fonts
│   ├── images
│   │   ├── common
│   │   ├── svg
│   │   └── top
│   ├── js
│   ├── libs
│   │   └── css
│   └── sass
│       ├── base
│       ├── component
│       ├── global
│       ├── layouts
│       └── pages
└── templates
</pre>

## Requirement

- "sass": "^1.66.1",
- "ts-loader": "^9.4.4",
- "webpack": "^5.88.2",
- "webpack-cli": "^5.1.4",
- "webpack-dev-server": "^4.15.1"
- "autoprefixer": "^10.4.15",
- "eslint": "^8.50.0",
- "eslint-config-airbnb": "^19.0.4",
- "eslint-config-airbnb-base": "^15.0.0",
- "postcss-cli": "^10.1.0",
- "prettier": "^3.0.3"

## Installation

```zsh
  npm ci
  npm install sass
  npm install postcss-cli autoprefixer -D
  npm install --save-dev eslint
  npm i -D eslint-config-airbnb
  npm i -D eslint-config-airbnb-base
  npm i -D prettier
```

```json
"scripts" {
  "build": "webpack --mode production",
  "lint": "eslint src/js/*.ts",
  "lint:fix": "eslint src/js/*.ts --fix",
  "format": "prettier --write .",
  "sass": "sass src/sass:dist/css/ --style=compressed --watch",
  "postcss": "postcss dist/css/style.css --use autoprefixer --dir dist/css/ --watch"
},
"browserslist": [
  "last 2 versions",
  "> 1% in JP"
]
```

## Usage

```zsh
npm run build
```

"webpack --mode production",
Webpack buildをするとsrc/js/ _.tsがdist/js/ _.jsにbuildされます。

ファイル名はwebpack.config.jsで指定したものになります。

```zsh
npm run lint
npm run lint:fix
```

.eslintrcで指定してlint、フォーマットが実行されます。
ベースは`eslint-config-airbnb-base`を使用しています。

```zsh
npm run format
```

pritterで設定したフォーマットが実行されます。

```zsh
npm run postcss
npm run sass
```

上記を実行すると更新時にコンパイルされます。

## Note

開発環境はLocal前提です。
https://localwp.com/

## Author

yu

## Feature Plans
