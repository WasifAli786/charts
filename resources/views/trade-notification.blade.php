<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    
  <h1 style="color: #333;">Hello Trader!</h1>
  @foreach ($introLines as $line)
      <p style="color: #555;">{{ $line }}</p>
  @endforeach
  <br>

  <a style="display: inline-block; padding: 10px 20px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px;" href="{{ $actionUrl }}">{{ $actionText }}</a>

</body>

</html>
