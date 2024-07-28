<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/centrifuge@5.0.0/dist/centrifuge.js"></script>
</head>
<body>

<script>
    /*const centrifuge = new Centrifuge('ws://localhost:9000/connection/websocket', {
        token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI3IiwiZXhwIjoxNzIyMzk0MjY0LCJpbmZvIjp7InJvbGUiOiJ1c2VyIiwiMCI6WyJwdWJsaWMiLCJwcml2YXRlIl19fQ.0A2QW_-mm2Bl4DfzEqPfQcTX5okTQkKskdo2vLwwIPY"
    });

    /!*centrifuge.presence("public").then(function(resp) {
        console.log(resp);
    }, function(err) {
        console.log('presence error', err);
    });
*!/
    const sub = centrifuge.newSubscription('public');

    // React on `news` channel real-time publications.
    sub.on('publication', function(ctx) {
        console.log(ctx.data);
    });

    sub.subscribe();

    centrifuge.connect();*/
</script>
</body>
</html>
