const path = require('path');

module.exports = {
  mode: 'production', // or 'development' for dev mode
  entry: './src/sidebar.js', // Ensure this points to the correct entry file
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'sidebar.bundle.js', // The bundled JS file name
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
