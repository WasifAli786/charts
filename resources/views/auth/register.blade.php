<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <title>Document</title>
</head>

<body class="bg-eerie_black-100">
    <div class="absolute max-w-[280px] w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="bg-eerie_black-400 w-full">
            <form class="p-4 space-y-3 shadow-green-800 shadow-sm w-full rounded-md" method="POST"
                action="{{ route('register') }}">
                @csrf
                {{-- Name --}}
                <x-input-name/>

                {{-- Email --}}
                <x-input-email/>

                {{-- Password --}}
                <x-input-password/>

                {{-- Confirm Password --}}
                <x-input-confirmpassword/>
                

                <div class="flex justify-between items-center">
                    {{-- Remember me --}}
                    <div>
                        <input type="checkbox" name="remember" value="1" class="me-1">Remember me
                    </div>

                    {{-- Login buttone --}}
                    <button type="submit" class="bg-green-500 px-2 py-1">Log in</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>

</html>
