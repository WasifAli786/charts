<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Control Panel</title>
</head>

<body>
    <div id="alertDiv"
        class="hidden fixed max-w-sm w-full border border-outer_space-500 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-eerie_black rounded-lg">
        <div class="px-2 flex justify-between">
            <p class="pt-2 ps-1 font-bold rounded-t-lg">Alert Trader</p>
            <button id="alertDivCloseBtn">
                <svg stroke="white" fill="white" stroke-width="0" viewBox="0 0 24 24" height="1.5em" width="1.5em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill="none" stroke="white" stroke-width="2" d="M7,7 L17,17 M7,17 L17,7"></path>
                </svg>
            </button>
        </div>
        <div class="px-2 pb-2 rounded-lg">
            <p class="text-xs ps-1 pb-2 text-outer_space-700"><span id="currentWords">0</span>/88</p>
            <textarea id="notification" class="w-full rounded-lg resize-none outline-none py-1 bg-eerie_black-100 px-2"
                cols="30" rows="3" placeholder="Enter notification content" maxlength="88"></textarea>

            <div class="flex">
                <button type="button" id="notifyButton" onclick="notifyUser(event)"
                    class="bg-green-500 px-4 py-1 rounded-lg text-eerie_black-100 mt-2 ms-auto">Alert</button>
            </div>
        </div>
    </div>

    <!-- This is the side header -->
    <header class="h-screen fixed">
        <div class="bg-eerie_black h-full py-4 border-r border-outer_space-500">
            <div class="flex items-center space-x-4 px-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 59.818 96.64">
                    <g id="Group_74" data-name="Group 74" transform="translate(-936 -78.017)">
                        <g id="Group_73" data-name="Group 73">
                            <g id="other_phone" data-name="other phone" transform="translate(936 78.017)">
                                <path id="Path_151" data-name="Path 151"
                                    d="M304.075,300.221V267.639H244.28v32.582h59.795Z"
                                    transform="translate(-244.28 -235.68)" fill="#6344d3"></path>
                                <path id="Path_152" data-name="Path 152" d="M328.361,372.685v32.1l33.739-32.1H328.361Z"
                                    transform="translate(-302.282 -308.144)" fill="#522886"></path>
                                <path id="Path_153" data-name="Path 153" d="M278,164.6,244.28,196.56H278Z"
                                    transform="translate(-244.28 -164.601)" fill="#00ffb3"></path>
                                <path id="Path_154" data-name="Path 154" d="M328.361,382.65v-9.965h33.716Z"
                                    transform="translate(-302.282 -308.144)" fill="#2f1452"></path>
                                <path id="Path_155" data-name="Path 155" d="M278,235.51v9.965H244.28Z"
                                    transform="translate(-244.28 -213.517)" fill="#00bf85"></path>
                                <path id="Path_156" data-name="Path 156" d="M304.075,267.639,244.28,282.4V267.639Z"
                                    transform="translate(-244.28 -235.68)" fill="#fff" opacity="0.26"></path>
                            </g>
                        </g>
                    </g>
                </svg>
                <h1 class="pe-2 font-bold text-xl">Journal</h1>
            </div>

            <ul class="py-4 flex flex-col space-y-3 text-sm px-2 mt-4">
                <li><a href="/controlpanel">All Users</a></li>
                <li><a href="/controlpanel/subscribers">Subscribers</a></li>
                <li><a href="/controlpanel/nonsubscribers">Non Subscribers</a></li>
                <li><a href="/controlpanel/experts">Experts</a></li>
                <li><a href="/controlpanel/registersubscription">Register</a></li>
            </ul>
        </div>
    </header>

    <main class="ms-[136px]">
        <div class="bg-eerie_black rounded-b-lg me-1">
            <div class="flex justify-between items-center px-4 py-4">
                <p class="text-white font-bold text-lg">Control Panel</p>

                <div class="flex space-x-4 items-center">
                    <div><img src={{ asset('uploads/' . Auth::user()->profile_image ?? OIP . jpeg) }}
                            class="rounded-full img""></div>
                </div>
            </div>
        </div>

        <!-- This is where the real stuff is placed -->
        <section class="me-1">
            <div class="w-full h-16 my-2">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-4xl">Users</h2>
                    <input id="traderEmail"
                        class="bg-outer_space outline-none px-3 py-2 rounded-lg focus:ring focus:ring-opacity-50"
                        type="text" placeholder="Trader Email">
                </div>
                <div class="py-2">
                    {{ $users->links() }}
                </div>
                <table class="mt-8 w-full">
                    <thead class="border-b border-outer_space-500 bg-onyx">
                        <tr>
                            <td class="py-4 ps-2">User</td>
                            <td class="py-4">Email</td>
                            <td class="py-4">Phone</td>
                            <td class="py-4">Subscribed</td>
                            <td class="py-4">Class</td>
                            <td class="py-4">Status</td>
                            <td class="py-4">Alert</td>
                        </tr>
                    </thead>
                    <tbody id="table" class="divide divide-y divide-slate-600 text-sm bg-eerie_black">
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 ps-2">
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ asset('uploads/' . $user->profile_image ?? OIP . jpeg) }}"
                                            class="rounded-full img" alt="" />
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->subscriptions->count() }}</td>
                                <td class="relative group hover:cursor-pointer">
                                    <select onchange="updateClass(event, {{ $user->id }})"
                                        class="bg-eerie_black outline-none">
                                        <option value="0" {{ $user->class == 0 ? 'selected' : '' }}>User</option>
                                        <option value="1" {{ $user->class == 1 ? 'selected' : '' }}>Expert
                                        </option>

                                    </select>
                                </td>
                                <td class="relative group hover:cursor-pointer">
                                    <select onchange="updateStatus(event, {{ $user->id }})"
                                        class="bg-eerie_black outline-none">
                                        <option value="1"{{ $user->status == 1 ? 'selected' : '' }}>Allowed
                                        </option>
                                        <option value="0"{{ $user->status == 0 ? 'selected' : '' }}>Blocked
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <x-alert-user :id="$user->id" />
                                        <a target="_blank"
                                            href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}
                                        ">
                                            <x-mail-user />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
<script src="{{ asset('js/controlPanel.js') }}"></script>

</html>
