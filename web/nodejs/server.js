
var http = require('http');
var port = "8888";

function pages(req, res) {
	console.log("Received a Request for " + req.url);

	if (req.url == '/home') {
		res.writeHead(200, { 'Content-Type': 'text/html' });
		res.write("<h1>Welcome to the Home Page</h1>");
		res.end();

	} else if (req.url == "/getData") {
		res.writeHead(200, { "Content-Type": "application/json" });

		var myClass = {
			name: "Wayne H",
			class: "cs313"
		}

		var myJSON = JSON.stringify(myClass);
		res.write(myJSON);
		res.end();

	} else {
		res.writeHead(404, { 'Content-Type': 'text/html' });
		res.write("<p>Page not found</p>");
		res.end();
	}
};

var server = http.createServer(pages);
server.listen(port);

console.log("The server is now listening on port " + port + "...");