<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>
<body>
    <h1>Posts</h1>
    <hr>
    <ul>
        {%for post in posts%}
        <h2>{{post.title}}</h2>
        <p>{{post.content}}</p>
        {%endfor%}
    </ul>
</body>
</html>