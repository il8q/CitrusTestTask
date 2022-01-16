/**
 * 
 */
const express = require('express');
const twig = require("twig");
const app = express()
const port = 3000;

app.set("twig options", {
    allow_async: true, // Allow asynchronous compiling
    strict_variables: false
});

app.get('/', (req, res) => {
    res.render('index.twig', {
        message : "Hello World"
    });
})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})