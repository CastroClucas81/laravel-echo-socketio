<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta meta="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container" id="app">
        <h1 class="text-muted">Laravel Broadcast Redis Socket.io</h1>
        <div id="chat-notification"></div>

        <script>
            window.laravelEchoPort = "{{ env('LARAVEL_ECHO_PORT') }}"
        </script>
        <script src="//{{ request()->getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            const userId = '{{ auth()->id() }}'
            window.Echo.channel('public-message-channel')
                .listen('.MessageEvent', (data) => {
                    $('#chat-notification').append('<div class="alert alert-warning">' + data.message + '</div>')
                })

            window.Echo.private('message-channel.' + userId)
                .listen('.MessageEvent', (data) => {
                    $("#chat-notification").append('<div class="alert alert-danger">' + data.message + '</div>')
                })
        </script>
    </div>
</body>

</html>
