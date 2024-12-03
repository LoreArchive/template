const path = require('path');

module.exports = {
  mode: 'production', // Set mode to 'production'
  entry: './src/sidebar.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'sidebar.bundle.js',
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'],
          },
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'],
    modules: [path.resolve(__dirname, 'src'), 'node_modules'],
  },
};
