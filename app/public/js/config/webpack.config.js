
const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');


module.exports = {
    entry: {
        app: [path.resolve(__dirname, '..', 'src/app.js')],
    },
    output: {
        filename: '[name].bundle.js?v=[contenthash]', path: path.resolve(__dirname, '..', 'dist'), publicPath: '/webpack/dist/',
    },
    optimization: {
        minimizer: [
            new TerserPlugin({
                terserOptions: {
                    output: {
                        comments: false
                    }
                }
            })
        ]
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader'
                }
            },
            {
                test: /\.css/,
                use: {
                    loader: 'css-loader'
                }
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }
        ]
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.vue', '.json']
    },
}