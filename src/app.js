const express = require('express');
const path = require('path');
const app = express();
const indexRouter = require('./routes/index');

app.use(express.static(path.join(__dirname, '../public')));

app.use('/', indexRouter);

module.exports = app;
