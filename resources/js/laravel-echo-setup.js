import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.loaction.hostname + ":" + window.laravel_echo_port
});
