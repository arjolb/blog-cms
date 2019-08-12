const path=require('path');
module.exports={
    entry:{
        App2: './scripts/temp/app2.js'
    },
    output: {
        path: path.resolve(__dirname,"./scripts"),
        filename: "[name].js"
    },
    mode: "development",
    module: {
        rules: [
            {
                use:{
                    loader: "babel-loader",
                    options:{
                        presets: ['@babel/preset-env']
                    }
                },
                test : /\.js$/,
                exclude: /node_modules/
            }
        ]
    }
}