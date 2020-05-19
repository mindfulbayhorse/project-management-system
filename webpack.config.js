const path = require('path');

module.exports = {
  entry: './multilevel_structure/js/main.js',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'public'),
  }
};