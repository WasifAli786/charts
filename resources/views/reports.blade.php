<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <x-head />
    <title>Reports</title>
</head>

<body>
    <!-- This is the side header -->
    <x-sideheader />


    <main class="ms-9 xl:ms-[136px] me-1">

        <div class="bg-eerie_black rounded-b-lg border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-4">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Dashboard</p>
                </div>

                <!-- This is the notifications side -->
                <x-notification />
            </div>
        </div>


        @php
            $totalInvestment = Auth::user()->totalInvestment ?? 0;
        @endphp

        <div class="mb-2">
            <h1 class="font-bold py-4 text-xl">Return Rs</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Accumulative Return</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->PnL }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Account Balance</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if ($statistics->openPosition < 0)
                            -
                        @endif
                        {{ $totalInvestment - $statistics->openPosition }}
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Wins</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->returnOnWins }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Losses</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->returnOnLosses }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Long</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->returnOnLong }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Short</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->returnOnShort }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Biggest Win</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->biggestWin }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Biggest Loss</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">Rs. {{ $statistics->biggestLoss }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Profit/Loss Ratio</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    @php
                        $winRatio = $statistics->wins;
                        $lossRatio = $statistics->losses;

                        if ($statistics->wins != 0 && $statistics->losses != 0) {
                            $winRatio = round($statistics->wins / $statistics->losses, 2);
                            $lossRatio = round($statistics->losses / $statistics->wins, 2);
                        }
                    @endphp
                    <p class="mt-2 font-bold">{{ $winRatio }} : {{ $lossRatio }}</p>
                </div>
            </div>

            <h1 class="font-bold py-4 text-xl">Return %</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Accumulative Return %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($totalInvestment != 0)
                            {{ round(($statistics->PnL / $totalInvestment) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return on Wins%</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>

                    <p class="mt-2 font-bold">
                        @if ($statistics->returnOnWins != 0)
                            {{ round(($statistics->returnOnWins / $statistics->PnL) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return on Losses %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($statistics->returnOnLosses != 0)
                            {{ round(($statistics->returnOnLosses / $statistics->PnL) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Long %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($statistics->returnOnLong != 0)
                            {{ round(($statistics->returnOnLong / $statistics->PnL) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Return On Short %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($statistics->returnOnShort != 0)
                            {{ round(($statistics->returnOnShort / $statistics->PnL) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Biggest Win %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($statistics->PnL != 0)
                            {{ abs(round(($statistics->biggestWin / $statistics->PnL) * 100, 2)) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Biggest Loss %</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        @if ($statistics->PnL != 0)
                            {{ round(($statistics->biggestLoss / $statistics->PnL) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </p>
                </div>
            </div>

            <h1 class="font-bold py-4 text-xl">Average Return</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Return</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs
                        @if ($statistics->PnL != 0 && $statistics->soldShares != 0)
                            {{ $statistics->PnL / $statistics->soldShares }}
                        @else
                            0
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Daily Return</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if (\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) != 0)
                            {{ $statistics->PnL / \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                        @else
                        {{ $statistics->PnL }}
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Wins</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if (\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) != 0)
                            {{ $statistics->returnOnWins / \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                        @else
                        {{ $statistics->returnOnWins }}
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Loss</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if (\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) != 0)
                            {{ $statistics->returnOnLosses / \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                        @else
                        {{ $statistics->returnOnLosses }}
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Long</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if (\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) != 0)
                            {{ $statistics->returnOnLong / \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                        @else
                        {{ $statistics->returnOnLong }}
                        @endif
                    </p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Avg Short</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">
                        Rs.
                        @if (\Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) != 0)
                            {{ $statistics->returnOnShort / \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                        @else
                        {{ $statistics->returnOnShort }}
                        @endif
                    </p>
                </div>
            </div>

            <h1 class="font-bold py-4 text-xl">Trades</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Trades</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->open + $statistics->wins + $statistics->losses }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Closed Trades</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->wins + $statistics->losses }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Open Trades</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->open }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Wins</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->wins }}</p>
                </div>
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Losses</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->losses }}</p>
                </div>
            </div>

            <h1 class="font-bold py-4 text-xl">Trades Size</h1>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
                <div class="bg-eerie_black p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-sm">Total Shares</h2>
                        <div class="relative group">
                            <x-reports-info />

                            <div class="absolute -right-4 -top-5 bg-onyx hidden group-hover:block min-w-[150px] p-2">
                                <p class="font-light text-sm">This is info of this div</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 font-bold">{{ $statistics->totalShares }}</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
