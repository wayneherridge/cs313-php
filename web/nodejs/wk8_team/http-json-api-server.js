// var http = require('http')
// var url = require('url')

// var port = process.argv[2]

// var parseTime = function (time) {
//   return {
//     hour: time.getHours(),
//     minute: time.getMinutes(),
//     second: time.getSeconds()
//   }
// }

// function unixTime (time) {
//   return {unixtime: time.getTime()}
// }

// var parseQuery = function (url) {
//   switch (url.pathname) {
//     case '/api/parsetime':
//       return parseTime(new Date(url.query.iso))
//     case '/api/unixtime':
//       return unixTime(new Date(url.query.iso))
//     default: return 'please enter a valid endpoint url'
//   }
// }

// http.createServer(function (request, response) {
//   if (request.method === 'GET') {
//     response.writeHead(200, {'Content-Type': 'application/json'})
//     url = url.parse(request.url, true)
//     response.end(JSON.stringify(parseQuery(url)))
//   } else {
//     response.writeHead(405)
//     response.end()
//   }
// }).listen(+port, function () {
//   console.log('Server listening on http://localhost:%s', port)
// })

var http = require('http')
var url = require('url')

function parsetime(time) {
    return {
        hour: time.getHours(),
        minute: time.getMinutes(),
        second: time.getSeconds()
    }
}

function unixtime(time) {
    return { unixtime: time.getTime() }
}

var server = http.createServer(function (req, res) {
    var parsedUrl = url.parse(req.url, true)
    var time = new Date(parsedUrl.query.iso)
    var result

    if (/^\/api\/parsetime/.test(req.url))
        result = parsetime(time)
    else if (/^\/api\/unixtime/.test(req.url))
        result = unixtime(time)

    if (result) {
        res.writeHead(200, { 'Content-Type': 'application/json' })
        res.end(JSON.stringify(result))
    } else {
        res.writeHead(404)
        res.end()
    }
})
server.listen(Number(process.argv[2]))