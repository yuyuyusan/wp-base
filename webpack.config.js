module.exports = {
  entry: {
    main: './src/js/index.ts',
    splide: './src/js/splide.ts',
  },
  output: {
    path: `${__dirname}/dist/js`,
    filename: '[name].bundle.js', 
  },
  mode: 'development',
  resolve: {
    extensions: ['.ts', '.js'],
  },
  devServer: {
    static: {
      directory: `${__dirname}/dist`,
    },
    open: true,
  },
  module: {
    rules: [
      {
        test: /\.ts$/,
        use: 'ts-loader',
      },
    ],
  },
};
