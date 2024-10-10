<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Name: {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>
    <p>Phone: {{ auth()->user()->phone }}</p>

    <h1>Subject</h1>
    <p>{{ $data['subject'] }}</p>

    <h1>Complaint</h1>
    <p>{{ $data['body'] }}</p>

</body>

</html>
