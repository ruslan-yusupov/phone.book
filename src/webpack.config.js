const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: undefined !== process.env.NODE_ENV ? process.env.NODE_ENV : 'production',
    plugins: [new MiniCssExtractPlugin({
        filename: 'bundle.css',
    })],
    entry: './app/index.js',
    output: {
        path: path.resolve(__dirname + '/', 'dist'),
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: path.resolve(__dirname + '/', 'dist'),
                        },
                    },
                    'css-loader'
                ]
            }
        ]
    }
};