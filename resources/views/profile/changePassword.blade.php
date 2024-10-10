<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Change Password</title>
</head>

<body>
    <div class="font-bold text-white text-4xl text-center my-16">Journal</div>
    <form action="/profile/changepassword" method="POST" class="max-w-sm my-2 mx-auto px-2">
        @csrf
        @method('PATCH')
        <label for="old" class="ps-1 mt-2 text-sm">Old Password</label>
        <input type="password" name="old" id="old"
            class="text-slate-400 bg-slate-600 mb-2 px-2 py-1 w-full rounded-lg outline-none hover:ring-1 hover:ring-green-500"
            required /><br />
        @error('old')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror

        <label for="new" class="ps-1 mt-2 text-sm">New Password</label>
        <input type="password" name="new" id="new"
            class="text-slate-400 bg-slate-600 mb-2 px-2 py-1 w-full rounded-lg outline-none hover:ring-1 hover:ring-green-500"
            required /><br />
        @error('new')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror

        <div>
            <button type="submit" class="text-black bg-green-400 px-2 py-1 rounded-lg mt-4">
                Submit
            </button>
        </div>
    </form>

</body>

</html>
