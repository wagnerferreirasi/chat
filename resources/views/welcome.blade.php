<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Chat</title>

    <!-- JavaScript -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="chat">
        <div class="top">
            <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="avatar">
            <div>
                <p>Ross Edlin</p>
                <small>Online</small>
            </div>
        </div>

        <div class="messages">
            @include('receive')
        </div>

        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit"></button>
            </form>
        </div>
    </div>
</body>
<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: 'sa1'
    });
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function(data) {
        $.post("/receive", {
                _token: '{{ csrf_token() }}',
                message: data.message,
            })
            .done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    //Broadcast messages
    $("form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #message").val(),
            }
        }).done(function(res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>

</html>
