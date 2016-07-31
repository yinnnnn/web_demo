module.exports = {
  entry: "./src/main.js",
  output: {
    filename: "build/build.js"
  },
  module: {
    loaders: [
       //.css 文件使用 style-loader 和 css-loader 来处理
      { test: /\.css$/, loader: "style!css" }
    ]
  },
  plugins: []
};

