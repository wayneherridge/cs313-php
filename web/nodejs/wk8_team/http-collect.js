// var http = require('http')
// var bl = require('bl')

// http.get(process.argv[2], function (response) {
//     response.pipe(bl(function (err, data) {
//         if (err)
//             return console.error(err)
//         data = data.toString()
//         console.log(data.length)
//         console.log(data)
//     }))
// });

var http = require('http')
var url = process.argv[2]
var body = ''

http.get(url, function (response) {
    response.on('data', function (chunk) {
        body += chunk
    })
    response.on('end', function () {
        console.log(body.length)
        console.log(body)
    })
})