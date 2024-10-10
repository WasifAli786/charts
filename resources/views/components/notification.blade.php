<div class="flex space-x-4 items-center">
    <!-- This is the user profile menu -->
    <div class="relative group">
        <svg id="notificationsIcon" version="1.0" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"
            viewBox="0 0 399.000000 327.000000" preserveAspectRatio="xMidYMid meet">
            <metadata>
                Created by potrace 1.16, written by Peter Selinger 2001-2019
            </metadata>
            <g transform="translate(0.000000,327.000000) scale(0.100000,-0.100000)" fill="#f8f9fa" stroke="none">
                <path d="M1880 2844 c-45 -20 -87 -59 -111 -106 -15 -29 -19 -58 -19 -131 l0
                        -93 -67 -28 c-214 -88 -385 -282 -445 -503 -17 -66 -22 -121 -28 -368 -8 -312
                        -12 -340 -69 -460 -41 -89 -82 -145 -161 -225 -78 -77 -98 -123 -81 -187 14
                        -53 36 -80 81 -103 36 -19 60 -20 323 -20 l284 0 12 -43 c61 -206 267 -320
                        467 -259 121 38 213 128 251 248 l17 54 283 0 c263 0 287 1 323 20 45 23 67
                        50 81 103 17 64 -3 110 -81 187 -79 80 -120 136 -161 225 -57 120 -61 148 -69
                        460 -6 247 -11 302 -28 368 -60 221 -231 415 -444 503 l-68 28 0 93 c0 73 -4
                        102 -19 131 -53 102 -172 149 -271 106z m143 -115 c33 -25 50 -79 45 -142 l-3
                        -49 -105 0 -105 0 -3 49 c-7 100 35 163 108 163 22 0 48 -8 63 -21z m87 -315
                        c213 -50 396 -224 465 -444 14 -44 19 -113 25 -350 7 -281 9 -299 34 -385 46
                        -151 120 -274 232 -382 56 -53 65 -80 38 -107 -14 -14 -113 -16 -944 -16 -831
                        0 -930 2 -944 16 -26 25 -18 53 25 92 106 95 200 248 245 397 25 86 27 104 34
                        385 6 237 11 306 25 350 68 217 251 393 460 444 80 19 224 19 305 0z m105
                        -1816 c-34 -114 -134 -187 -255 -187 -121 0 -221 73 -255 187 l-6 22 261 0
                        261 0 -6 -22z" 
                />
            </g>
        </svg>
        <svg class="absolute top-1 right-1" id="notificationsAlertIcon" stroke="currentColor" fill="#c00"
            stroke-width="0" viewBox="0 0 16 16" height="0.6em" width="0.6em" xmlns="http://www.w3.org/2000/svg">
            <circle cx="8" cy="8" r="8"></circle>
        </svg>

        <div
            class="border border-outer_space-500 hidden group-hover:block absolute -right-20 sm:right-0 w-64 sm:w-96 bg-eerie_black rounded-lg max-h-96 overflow-y-scroll">
            <p class="ps-2 py-1 bg-eerie_black border-b border-outer_space-500 fixed w-64 sm:w-96">
                Notifications
            </p>
            <ul class="flex flex-col divide-y-2 divide-outer_space-500 pt-10">
                <li class="ps-4 pe-2 py-2">
                    <a href="#" class="flex space-x-4 items-center">
                        <p class="text-sm font-light">Edit notification data here.</p>
                    </a>
                    <p class="font-thin text-xxs text-slate-400">
                        12/2/24
                    </p>
                </li>
            </ul>
        </div>
    </div>

    <div>
        <a href="/profile">
            <img src="{{ asset('uploads/' . 'OIP.jpeg') }}" class="rounded-full img"
                alt="No image found">
        </a>
    </div>
</div>
