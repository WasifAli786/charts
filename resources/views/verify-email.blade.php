<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <x-head/>
    <title>Verify Email</title>
</head>

<body class="bg-eerie_black-100 text-center">
    <div class="max-w-lg absolute top-1/2 left-1/2 transfrom -translate-x-1/2 -translate-y-1/2">
        <h1 class="font-bold text-4xl pt-10">Verify your Email to continue.</h1>

        <div class="mt-8">
          <p>A email is sent to the {{ Auth::user()->email }} check your inbox to verify your email.</p>
        </div>

        <div class="mt-8">
          <p>Didn't recieved mail? <a class="underline" href="/resendverification">Resend mail</a></p>
        </div>
        
    </div>
</body>

</html>
