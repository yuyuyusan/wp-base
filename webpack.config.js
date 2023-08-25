module.exports = {
  entry: './assets/js/index.ts',
  output: {
    path: `${__dirname}/dist`,
    filename: 'bundle.js',
  },
  mode : 'development',
  resolve: {
    extensions: ['.ts', '.js'],
  },
  devServer: {
    static : {
      directory : `${__dirname}/dist`,
    },
    open : true,
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
