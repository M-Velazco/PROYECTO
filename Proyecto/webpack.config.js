const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  // ... other configurations
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          // other loaders if needed
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
    // other plugins
  ],
};
