##directory

.
├── dist
│   ├── css
│   ├── fonts
│   ├── js
│   │   └── lib
│   └── svg
├── images
│   ├── common
│   └── top
├── src
│   ├── js
│   └── sass
│       ├── base
│       ├── component
│       ├── global
│       ├── layouts
│       └── pages
└── templates

## npm package basis
npm init

npm install sass

"sass": "sass src/sass:dist/css/ --style=compressed --watch"

npm install postcss-cli autoprefixer -D

"postcss": "postcss dist/css/style.css --use autoprefixer --dir dist/css/ --watch"

"browserslist": [
  "last 2 versions",
  "> 1% in JP"
]

