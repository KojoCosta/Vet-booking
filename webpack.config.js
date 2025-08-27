const path = require('path');

module.exports = {
  entry: './resources/js/app.js',
  output: {
    path: path.resolve(__dirname, 'public/js'),
    filename: 'app.js',
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: 'babel-loader',
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
};