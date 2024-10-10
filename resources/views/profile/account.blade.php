<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Personal Information</title>
</head>

<body>
    @isset($success)
    <div class="absolute top-2 w-full z-10">
        <div class="flex items-center justify-between bg-green-500 mx-2 px-2 rounded-md">
            <div>
                <p class="py-2 font-bold"> {{ $success }} </p>
            </div>
            <div>
                <svg onclick="this.parentNode.parentNode.parentNode.remove()" stroke="currentColor" fill="currentColor" stroke-width="4" viewBox="0 0 512 512" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    @endisset

    @isset($error)
    <div class="absolute top-2 w-full z-10">
        <div class="flex items-center justify-between bg-red-600 mx-2 px-2 rounded-md">
            <div>
                <p class="py-2 font-bold"> {{ $error }} </p>
            </div>
            <div>
                <svg onclick="this.parentNode.parentNode.parentNode.remove()" stroke="currentColor" fill="currentColor" stroke-width="4" viewBox="0 0 512 512" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    @endisset

    <x-profile-header />

    <main class="ms-9 xl:ms-[136px]">
        <div class="flex-grow bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-2">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Account</p>
                </div>

                <!-- This is the notifications side -->
                <x-notification />
            </div>
        </div>

        <div class="bg-eerie_black rounded-md p-4 mt-2 me-1">
            <h1 class="py-4 font-bold text-lg">Account Information</h1>
            <form class="space-y-2 max-w-sm" action="">
                <div>
                    <p class="font-light mb-1">Name</p>
                    <input
                        class="w-full px-2 py-1 bg-eerie_black-100 outline outline-1 outline-outer_space-500 rounded-md"
                        type="text" placeholder="Name" value="{{ $user->name }}" />
                </div>
                <div>
                    <p class="font-light mb-1">Email</p>
                    <input
                        class="w-full px-2 py-1 bg-eerie_black-100 outline outline-1 outline-outer_space-500 rounded-md"
                        type="text" placeholder="Email" value="{{ $user->email }}" />
                </div>
                <div class="pt-4">
                    <button class="px-2 py-1 rounded-md font-medium bg-teal-500 border border-teal-500 ms-auto">
                        Save Changes
                    </button>
                </div>
            </form>

            <div class="mt-4 flex flex-wrap">
                <div class="mt-2">
                    <button class="px-2 py-1 rounded-md font-medium border border-seasalt hover:bg-seasalt whitespace-nowrap hover:text-eerie_black-100 hover:cursor-pointer"
                    onclick="window.location.href='{{ route('profile.changepassword') }}'">
                        Change Password
                    </button>
                </div>
                <div class="mt-2 ms-2">
                    <button id="deleteAccountButton"
                        class="px-2 py-1 rounded-md font-medium border border-red-500 hover:bg-red-500 whitespace-nowrap hover:cursor-pointer">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </main>

    {{-- Delete account model --}}
    <div id="deleteAccountModal"
        class="hidden fixed top-1/2 left-1/2 transfrom -translate-x-1/2 -translate-y-1/2 max-w-sm bg-eerie_black-100 rounded-lg border border-outer_space-500">
        <h4 class="font-light text-lg px-2 py-2 border-b border-outer_space-500">
            Delete Account
        </h4>
        <div class="py-2 text-center">
            <p class="px-2 py-1 text-sm font-light">
                You are about to delete your account. This will remove all your data
                in our database. This action can't be undone.
            </p>
        </div>
        <div class="flex justify-around font-bold text-sm">
            <button id="keepAccountButton"
                class="bg-eerie_black rounded-full px-2 py-2 my-2 w-full mx-2 whitespace-nowrap">
                No, Keep it.
            </button>
            <button id="confirmDeletionButton"
                class="bg-red-500 rounded-full px-2 py-2 my-2 w-full mx-2 whitespace-nowrap">
                Yes, Delete
            </button>
        </div>
    </div>
</body>
<script src="js/notifications.js"></script>
<script src="js/images.js"></script>
<script src="js/account.js"></script>

</html>
