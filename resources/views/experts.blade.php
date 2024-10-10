<!DOCTYPE html>
<html lang="en">

<head>
    <x-head/>
    <title>Experts</title>
</head>

<body>
    <x-sideheader />

    <main class="ms-9 xl:ms-[136px]">
        <div class="bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-4">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">{{ Auth::user()->name }}</p>
                </div>

                <!-- This is the notifications side -->
                <x-notification />
            </div>
        </div>

        <div class="bg-eerie_black my-2 me-2">
            <div class="flex justify-between py-4 px-2">
                <div class="w-full max-w-[248px]">
                    <p class="font-bold text-sm mb-2">Search Expert</p>
                    <form action="/experts/name" class="flex rounded-lg">
                        <input
                            class="bg-eerie_black-100 outline-none px-3 py-2 rounded-lg focus:ring focus:ring-opacity-50 w-full"
                            id="expertName" name="name" placeholder="Expert Name" type="text" />
                    </form>
                </div>
            </div>
        </div>

        <!-- This is where the real stuff is placed -->
        <section class="me-2">
            <div class="w-full md:flex md:space-x-4 md:divide md:divide-x divide-slate-600">
                <div class="md:w-1/2">
                    <div class="flex justify-between">
                        <h2 class="pt-3 pb-2 font-bold text-xl">Subscribed Traders</h2>
                        <div>
                            {{ $subscribed->links() }}
                        </div>
                    </div>

                    <table class="w-full border-separate border-spacing-y-2">
                        <thead class="bg-onyx">
                            <tr>
                                <td class="py-2 ps-2 rounded-s-full">Trader</td>
                                <td class="py-2">PnL</td>
                                <td class="py-2 pe-2 rounded-e-full">Profile</td>
                            </tr>
                        </thead>
                        <tbody class="bg-eerie_black">
                            @foreach ($subscribed as $expert)
                                @php
                                    $statistics = \App\Models\User::statistics($expert->id);
                                @endphp
                                <td class="ps-2 rounded-s-full">
                                    <div class="flex space-x-2 items-center py-2">
                                        <img class="rounded-full img"
                                            src="{{ asset('uploads/' . $expert->profile_image ?? 'OIP.jpeg') }}"
                                            alt="" />
                                        <p class="hidden xxs:block">{{ $expert->name }}</p>
                                    </div>
                                </td>
                                <td class="py-2 pe-2 ">
                                    @if ($statistics->alltime->PnL > 1000)
                                        {{ round($statistics->alltime->PnL / 1000, 2) }}K+
                                    @else
                                        {{ $statistics->alltime->PnL / 1000 }}
                                    @endif
                                </td>
                                <td class="py-2 pe-2 rounded-e-full">
                                    <a class="underline" href="/trades/{{ $expert->id }}">Profile</a>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="w-full md:ps-4 mb-2">
                    <h2 class="pt-3 pb-2 font-bold text-xl">Other Experts</h2>
                    {{ $experts->links() }}
                    <div class="flex flex-col space-y-3 mb-2">
                        @foreach ($experts as $expert)
                            @php
                                $statistics = \App\Models\User::statistics($expert->id);
                            @endphp
                            
                            <div class="bg-eerie_black rounded-lg">
                                <div class="px-4 py-2 border-b border-outer_space-500">
                                    <div class="flex items-center space-x-4 py-2">
                                        <img src="{{ asset('uploads/' . $expert->profile_image ?? OIP . jpeg) }}"
                                            alt="" class="rounded-full img" />
                                        <p>{{ $expert->name }}</p>
                                    </div>
                                </div>
                                <div class="px-4 py-4 text-sm">
                                    <div class="grid font- grid-flow-row grid-cols-4 font-light">
                                        <p>PnL</p>
                                        <p>This month</p>
                                        <p>Last month</p>
                                        <p>Last 6 months</p>
                                    </div>
                                    <div class="grid grid-flow-row grid-cols-4 font-bold">
                                        <p>Rs.
                                            @if ($statistics->alltime->PnL > 1000)
                                                {{ round($statistics->alltime->PnL / 1000) }}K+
                                            @else
                                                {{ round($statistics->alltime->PnL / 1000) }}
                                            @endif
                                        </p>
                                        <p>Rs.
                                            @if ($statistics->thismonth->PnL > 1000)
                                                {{ round($statistics->thismonth->PnL / 1000) }}K+
                                            @else
                                                {{ round($statistics->thismonth->PnL / 1000) }}
                                            @endif
                                        </p>
                                        <p>Rs.
                                            @if ($statistics->lastmonth->PnL > 1000)
                                                {{ round($statistics->lastmonth->PnL / 1000) }}K+
                                            @else
                                                {{ round($statistics->lastmonth->PnL / 1000) }}
                                            @endif
                                        </p>
                                        <p>Rs.
                                            @if ($statistics->last6months->PnL > 1000)
                                                {{ round($statistics->last6months->PnL / 1000) }}K+
                                            @else
                                                {{ round($statistics->last6months->PnL / 1000) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="py-3 px-4 flex items-center">
                                    <a href="/trades/{{ $expert->id }}"
                                        class="ms-auto underline text-sm font-light">View
                                        Profile</a>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                                        height="1em" width="1.2em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.146 4.646a.5.5 0 01.708 0l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708-.708L12.793 8l-2.647-2.646a.5.5 0 010-.708z"
                                            clip-rule="evenodd"></path>
                                        <path fill-rule="evenodd"
                                            d="M2 8a.5.5 0 01.5-.5H13a.5.5 0 010 1H2.5A.5.5 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="{{ asset('js/notifications.js') }}"></script>
<script src="{{ asset('js/experts.js') }}"></script>

</html>
