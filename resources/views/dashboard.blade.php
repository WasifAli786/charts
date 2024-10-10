<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Dashboard</title>
</head>

<body>
    <!-- This is the side header -->
    <x-sideheader />

    <main class="ms-9 xl:ms-[136px]">
        <!-- This is the top filter header
            to edit start from the inner div dont alter the first div
        -->
        <div class="bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-4">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Dashboard</p>
                </div>

                <!-- This is the notifications side -->
                <x-notification />
            </div>
        </div>

        <div class="mt-2 bg-eerie_black border rounded-lg border-outer_space-500 me-1">
            <div class="text-sm font-light flex justify-between items-center px-2 py-2">
                <p class="hover:cursor-pointer underline underline-offset-4">
                    Portfolio 1
                </p>

                <a href="addtrade" class="font-medium px-4 py-2 rounded-lg bg-teal-400 hover:bg-teal-500 text-black">Add
                    a Trade</a>
            </div>
        </div>
        <!-- This is where the real stuff is placed -->
        <section class="me-0">
            <div class="w-full md:flex md:space-x-2">
                <div class="md:max-w-sm h-full md:w-1/2 me-1">
                    <h2 class="pt-4 font-bold text-lg border-b border-outer_space-500">
                        Portfolio
                    </h2>
                    <div class="bg-eerie_black rounded-lg mb-2 mt-2 font-bold text-2xl">
                        <h2 class="px-2 py-5">Total Investment: Rs. {{ number_format($totalInvestment) }}
                        </h2>
                    </div>
                    <div class="bg-eerie_black rounded-lg mb-2 mt-2 font-bold text-2xl">
                        <h2 class="px-2 py-5">Open Position: Rs.
                            @if ($openPosition > 0)
                                {{ number_format($openPosition) }}
                            @else
                                0
                            @endif
                        </h2>
                    </div>
                    <div class="bg-eerie_black rounded-lg mb-2 mt-2 font-bold text-2xl">
                        <h2 class="px-2 py-5">Cash In Hand: Rs.
                            @if ($openPosition > 0)
                                {{ number_format($totalInvestment - $openPosition) }}
                            @else
                                {{ $totalInvestment }}
                            @endif
                        </h2>
                    </div>
                </div>

                <div class="w-full">
                    <h2 class="pt-4 font-bold text-lg border-b border-outer_space-500">
                        Your Stats
                    </h2>

                    <div class="flex space-x-2 mt-2">
                        <ul class="flex space-x-2 items-center font-light text-sm overflow-scroll">
                            <li class="hover:bg-teal-400 rounded-full bg-onyx py-1">
                                <a href="/dashboard/range/yesterday" class="px-3 whitespace-nowrap">Yesterday</a>
                            </li>
                            <li class="hover:bg-teal-400 rounded-full bg-onyx py-1">
                                <a href="/dashboard/range/thisweek" class="px-3 whitespace-nowrap">This week</a>
                            </li>
                            <li class="hover:bg-teal-400 rounded-full bg-onyx py-1">
                                <a href="/dashboard/range/lastweek" class="px-3 whitespace-nowrap">Last week</a>
                            </li>
                            <li class="hover:bg-teal-400 rounded-full bg-onyx py-1">
                                <a href="/dashboard/range/lastmonth" class="px-3 whitespace-nowrap">Last month</a>
                            </li>
                            <li class="hover:bg-teal-400 rounded-full bg-onyx py-1">
                                <a href="/dashboard/range/last3months" class="px-3 whitespace-nowrap">Last 3 months</a>
                            </li>
                            <li>
                                <a href="/dashboard" class="whitespace-nowrap underline">Reset filter</a>
                            </li>
                        </ul>
                    </div>

                    <div class="p-2 sm:p-4 me-1 bg-eerie_black rounded-lg mt-2">
                        <div class="flex items-center space-x-1 sm:space-x-6">
                            <div class="flex-grow">
                                <div class="max-w-[192px] bg-onyx rounded-lg">
                                    <div class="px-3 py-3">
                                        <p>PnL</p>
                                        <div class="mt-2 text-center mx-auto">
                                            <p @if ($statistics->pnl >= 0) class="text-green-500 font-bold text-lg tracking-wider">
                                            @else class="text-red-500 font-bold text-lg tracking-wider"> @endif
                                                Rs.
                                                @if (abs($statistics->pnl) > 1000) {{ round($statistics->pnl / 1000, 2) }} K
                                    @else
                                        {{ $statistics->pnl }} @endif
                                                </p>

                                                @php
                                                    $pnlpercentage =
                                                        (($statistics->pnl) / $totalInvestment) *
                                                        100;
                                                @endphp

                                                @if ($pnlpercentage >= 0)
                                                    <div
                                                        class="text-center bg-green-500 text-green-400 bg-opacity-20 rounded-full inline-block">
                                                    @else
                                                        <div
                                                            class="text-center bg-red-500 text-red-500 bg-opacity-20 rounded-full inline-block">
                                                @endif

                                            <p class="font-light text-sm px-5">
                                                @if ($statistics->closed == 0)
                                                    No trades done
                                                @else
                                                    {{ round($pnlpercentage, 2) }} %
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <div class="flex space-x-1 items-center">
                                <div class="flex w-28 justify-between bg-onyx px-4 py-3 rounded-xl">
                                    <p>Wins</p>
                                    <p class="text-green-500">{{ $statistics->wins }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="flex w-28 justify-between bg-onyx px-4 py-3 rounded-xl">
                                    <p>Loss</p>
                                    <p class="text-red-600">{{ $statistics->losses }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="hidden xxs:block">
                            <div class="flex flex-col space-y-2">
                                <div class="flex space-x-1 items-center">
                                    <div class="flex w-28 justify-between bg-onyx px-4 py-3 rounded-xl">
                                        <p>Long</p>
                                        <p class="text-green-500">{{ $statistics->long }}</p>
                                    </div>
                                </div>
                                <div class="flex space-x-1 items-center">
                                    <div class="flex w-28 justify-between bg-onyx px-4 py-3 rounded-xl">
                                        <p>Short</p>
                                        <p class="text-red-600">{{ $statistics->short }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-2 mt-2 overflow-scroll">
                        <div class="flex space-x-1 items-center">
                            <div class="flex w-28 justify-between bg-onyx px-6 py-3 rounded-xl">
                                <p>Win%</p>
                                <p class="text-green-500">
                                    @if ($statistics->wins + $statistics->losses != 0)
                                        {{ round($statistics->wins / ($statistics->wins + $statistics->losses), 2) * 100 }}
                                    @else
                                        0
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-1 items-center">
                            <div class="flex w-28 justify-between bg-onyx px-6 py-3 rounded-xl">
                                <p>Open</p>
                                <p class="text-green-500">{{ $statistics->open }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- Expert traders section start here -->

        <div class="me-1">
            <h2 class="ps-2 py-1 font-bold text-2xl bg-onyx rounded-lg">
                Subscribed Experts
            </h2>
            <div class="space-y-3 mt-2 mb-1">
                @foreach ($experts as $expert)
                    @php
                        $statistics = \App\Models\User::statistics($expert->id);
                    @endphp

                    <div class="bg-eerie_black rounded-lg">
                        <div class="px-4 py-2 border-b border-outer_space-500">
                            <div class="flex items-center space-x-4 py-2">
                                <img src="/uploads/{{ $expert->profile_image }}" alt=""
                                    class="rounded-full img" />
                                <p>{{ $expert->name }}</p>
                            </div>
                        </div>
                        <div class="px-4 py-4 text-sm">
                            <div class="grid grid-flow-row grid-cols-4 font-light">
                                <p>PnL</p>
                                <p>This Month</p>
                                <p>Last Month</p>
                                <p>Last 6 Month</p>
                            </div>
                            <div class="grid grid-flow-row grid-cols-4 font-bold">
                                <p>Rs. @if (abs($statistics->alltime->PnL) > 1000)
                                        {{ round($statistics->alltime->PnL / 1000, 2) }} K
                                    @else
                                        {{ $statistics->alltime->PnL }}
                                    @endif
                                </p>
                                <p>Rs. @if (abs($statistics->thismonth->PnL) > 1000)
                                        {{ round($statistics->thismonth->PnL / 1000, 2) }} K
                                    @else
                                        {{ $statistics->thismonth->PnL }}
                                    @endif
                                </p>
                                <p>Rs. @if (abs($statistics->lastmonth->PnL) > 1000)
                                        {{ round($statistics->lastmonth->PnL / 1000, 2) }} K
                                    @else
                                        {{ $statistics->lastmonth->PnL }}
                                    @endif
                                </p>
                                <p>Rs. @if (abs($statistics->last6months->PnL) > 1000)
                                        {{ round($statistics->last6months->PnL / 1000, 2) }} K
                                    @else
                                        {{ $statistics->last6months->PnL }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="py-3 px-4 flex items-center">
                            <a href="/trades/{{ $expert->id }}" class="ms-auto underline text-sm font-light">View Profile</a>
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                                height="1em" width="1.2em" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.146 4.646a.5.5 0 01.708 0l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708-.708L12.793 8l-2.647-2.646a.5.5 0 010-.708z"
                                    clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M2 8a.5.5 0 01.5-.5H13a.5.5 0 010 1H2.5A.5.5 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
</body>

</html>