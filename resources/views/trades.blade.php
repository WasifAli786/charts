<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Trades History</title>
</head>

<body>
    <x-sideheader />

    <main class="ms-9 xl:ms-[136px]">
        <!-- This is the top bar -->
        <div class="bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-4">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Expert Name</p>
                </div>

                <!-- This is the notifications side -->
                <x-notification />
            </div>
        </div>

        <!-- This is the filters area -->
        <div class="bg-eerie_black rounded-lg border border-outer_space-500 py-2 mt-2 me-1">
            <div class="text-sm font-light flex justify-end flex-wrap space-x-2 items-center me-1">
                <a class="hidden sm:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1" href="">Today</a>
                <a class="hidden sm:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1"
                    href="">Yesterday</a>
                <a class="mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1" href="">This week</a>
                <a class="mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1" href="">Last week</a>
                <a class="hidden xs:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1" href="">This
                    month</a>
                <a class="hidden xs:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1" href="">Last
                    month</a>
                <div id="calendarContainer"
                    class="flex space-x-1 items-center mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1 group">
                    <button>Select Date</button>
                    <svg id="selectDateSvg" stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z">
                        </path>
                    </svg>

                    <div id="calendarContainer1" class="hidden">
                        <form class="flex items-center absolute right-2 top-28 w-max border border-outer_space-500"
                            method="get" action="#" id="rangeForm" name="rangeForm">
                            <input class="py-1 px-4 outline-none w-max bg-onyx broder" type="date" name="range"
                                id="calendar" placeholder="Click to select range" />
                            <button type="submit" class="bg-teal-400 px-2 py-1 text-center text-black">
                                Get Trades
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="bg-eerie_black border border-outer_space-500 rounded-lg me-1 text-sm font-light flex justify-between items-center py-1 mt-2">
            <p class="p-4 hover:cursor-pointer underline underline-offset-4">
                {{ \App\Models\User::where('id', $id)->first()->name }}
            </p>
            @if ($id == Auth::id())
                <a href="/addtrade"
                    class="font-medium me-1 px-4 py-2 rounded-lg bg-teal-400 hover:bg-teal-500 text-black hover:cursor-pointer">
                    Add Trade
            @endif

            @if ($id != Auth::id())
                <a href="/subscribe/{{ $id }}"
                    class="font-medium me-1 px-4 py-2 rounded-lg bg-teal-400 hover:bg-teal-500 text-black hover:cursor-pointer">
                    Subscribe
            @endif
            </a>
        </div>

        <!-- This is where the real stuff is placed -->
        <section class="me-1">
            <div class="w-full md:pe-2">
                <div class="flex justify-between items-center">
                    <h2 class="py-4 font-bold text-xl ">
                        Your Trades
                    </h2>
                    <div class="pt-2">
                        {{ $trades->links() }}
                    </div>
                </div>
                <div>
                    <table class="w-full text-sm mb-1">
                        <thead class="bg-onyx">
                            <tr class="font-medium text-left">
                                <td class="py-2"></td>
                                <td class="py-2 ps-2">Call</td>
                                <td class="py-2">Symbol</td>
                                <td class="py-2 hidden xxs:table-cell">Per share</td>
                                <td class="py-2 hidden xxs:table-cell">Quantity</td>
                                <td class="py-2">Amount</td>
                                <td class="py-2">CSV</td>
                                <td class="py-2">Date</td>
                                <td class="py-2 hidden x:table-cell">Setups</td>
                                <td class="py-2 hidden x:table-cell">Mistakes</td>
                            </tr>
                        </thead>
                        <tbody class="bg-eerie_black divide-y divide-outer_space-500">
                            @if ($trades->count() != 0)
                                @php
                                    $totalInvestment = Auth::user()->total_investment;
                                @endphp
                                @foreach ($trades as $trade)
                                    <tr>
                                        <td class="w-3">
                                            <a class="flex items-center mx-1"
                                                href="/trade/{{ $id }}/{{ $trade->trades->id }}"><svg
                                                    stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 1024 1024" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z">
                                                    </path>
                                                    <path
                                                        d="M464 336a48 48 0 1 0 96 0 48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z">
                                                    </path>
                                                </svg></a>
                                        </td>
                                        {{-- Call --}}
                                        <td class="max-w-min">
                                            @if ($trade->call == 'buy')
                                                <p
                                                    class="py-1  uppercase text-primarygreen bg-secondarygreen bg-opacity-20 text-center font-bold rounded-full w-14 my-1">
                                                    {{ $trade->call }}
                                                </p>
                                            @else
                                                <p
                                                    class="px-2 py-1  uppercase text-primaryred bg-secondaryred bg-opacity-20 text-center font-bold rounded-full w-14 my-1">
                                                    {{ $trade->call }}
                                                </p>
                                            @endif
                                        </td>
                                        {{-- Symbol --}}
                                        <td>
                                            <a href="" class="text-blue-500"> {{ $trade->trades->symbol }} </a>
                                        </td>
                                        {{-- Price per unit --}}
                                        <td class="hidden xxs:table-cell">Rs. {{ $trade->priceperunit }}</td>
                                        {{-- Quantity --}}
                                        <td class="hidden xxs:table-cell">{{ $trade->quantity }}</td>
                                        {{-- Amount --}}
                                        <td>Rs. {{ $trade->priceperunit * $trade->quantity }}</td>
                                        {{-- CSV --}}
                                        <td>Rs.{{ $trade->stock->currentValue }}</td>
                                        {{-- Date --}}
                                        <td class="pe-2">{{ \Carbon\Carbon::parse($trade->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="max-w-[60px] hidden x:table-cell pe-2 relative">
                                            <div class="flex space-x-2 whitespace-nowrap overflow-hidden">
                                                @php
                                                    $setups = $trade->trades->notes->where('type', 'setup');
                                                @endphp
                                                @foreach ($setups as $setup)
                                                    <p data-id="{{ $setup->id }}"
                                                        onclick="showNote({{ $setup->id }})"
                                                        class="bg-primarygreen px-2 py-1 text-eerie_black font-medium hover:cursor-pointer">
                                                        {{ $setup->heading }}
                                                    </p>
                                                @endforeach
                                                @if ($setups->count() > 1)
                                                    <div data-name="setups" date-tradeId="{{ $trade->id }}"
                                                        class="notesBrowseBtn bg-seasalt text-eerie_black-100 bg-opacity-80 absolute right-0 top-1/2 transform -translate-y-1/2 rounded-md hover:cursor-pointer">
                                                        <p class="px-1">+{{ $setups->count() - 1 }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="max-w-[60px] hidden x:table-cell pe-2 relative">
                                            <div class="flex space-x-2 whitespace-nowrap overflow-hidden">
                                                @php
                                                    $mistakes = $trade->trades->notes->where('type', 'mistake');
                                                @endphp
                                                @foreach ($mistakes as $mistake)
                                                    <p onclick="showNote({{ $mistake->id }})"
                                                        data-id="{{ $mistake->id }}"
                                                        class="note bg-primaryred px-2 py-1 hover:cursor-pointer">
                                                        {{ $mistake->heading }}
                                                    </p>
                                                @endforeach
                                                @if ($mistakes->count() > 1)
                                                    <div data-name="Mistakes" date-tradeId="1"
                                                        class="notesBrowseBtn bg-seasalt text-eerie_black-100 bg-opacity-80 absolute right-0 top-1/2 transform -translate-y-1/2 rounded-md hover:cursor-pointer">
                                                        <p class="px-1">+{{ $mistakes->count() - 1 }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="ps-2 capitalize py-2 text-center" colspan="100%">No Trades found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-10 mb-5">
                    {{ $trades->links() }}
                </div>
            </div>
        </section>

        <div id="notesDiv"
            class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-eerie_black-100 border border-outer_space-500 w-[280px] hover:cursor-default">
            <div class="flex border-b border-outer_space-500 items-center px-2 py-2 bg-eerie_black-100 sticky top-0">
                <p id="titleDiv" class="flex-grow font-bold bg-eerie_black-100">
                    Note Heading
                </p>
                <button onclick="this.parentNode.parentNode.classList.toggle('hidden')">
                    <svg stroke="white" fill="white" stroke-width="0" viewBox="0 0 24 24" height="1.5em"
                        width="1.5em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" stroke="white" stroke-width="2" d="M7,7 L17,17 M7,17 L17,7"></path>
                    </svg>
                </button>
            </div>
            <div class=" bg-eerie_black-100">
                <div id="contentDiv" class="max-h-80 px-2 py-2 overflow-y-scroll"></div>
            </div>
        </div>
    </main>
</body>
<script src="{{ asset('js/notifications.js') }}"></script>
<script src="{{ asset('js/images.js') }}"></script>
<script src="{{ asset('js/calendar.js') }}"></script>
<script src="{{ asset('js/trades.js') }}"></script>

</html>
