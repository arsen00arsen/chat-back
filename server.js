var app = require('express')();
var http = require('http').createServer(app);
const PORT = 8080;
var io = require('socket.io')(http, {
    cors: {
        origin: "*"
    }
});

http.listen(8080, () => {
    console.log(`listening on *:${PORT}`);
});

io.on('connection', (socket) => { /* socket object may be used to send specific messages to the new connected client */
    socket.on('send_message', function (msg, user) {
        const {name} = user
        io.emit('send_message', {msg, name})
    })
});
