<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Document</title>
</head>

<body>
    <x-profile-header />

    <main class="ms-9 xl:ms-[136px]">
        <div class="bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between item">
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Profile</p>
                </div>

                <x-notification />
            </div>
        </div>

        <div class="bg-eerie_black my-2">
            <h2 class="font-bold px-2 text-xl py-2">Profile Settings</h2>
            <form class="px-2 py-2" action="/edit">
                <div class="grid grid-cols-12 gap-4 justify-items-start">
                    <label class="text-white col-span-2">Name:</label>
                    <input type="text" class="col-span-10 bg-eerie_black-100 ps-1 py-2 outline-none lg:w-1/2" value="{{ Auth::user()->name }}"/>

                    <label class="text-white col-span-2">Email:</label>
                    <input type="email" class="col-span-10 bg-eerie_black-100 ps-1 py-2 outline-none lg:w-1/2" value="{{ Auth::user()->email }}"/>
                </div>

            </form>
        </div>
    </main>
</body>

</html>
