const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CopyPlugin = require('copy-webpack-plugin')

module.exports = {
  entry: './src/index.js',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'js/bundle.js'
  },
  module: {
    rules: [{
      test: /\.scss$/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            url: false
          }
        },
        {
          loader: 'sass-loader',
          options: {
            sourceMap: true,
          }
        },
        {
          loader: 'postcss-loader'
        }
      ]
    }]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '../../assets/css/styles.css'
    }),
  ]
}
