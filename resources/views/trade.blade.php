<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <x-head />
    <title>Trade</title>
</head>

<body>
    <div class="bg-onyx bg-opacity-50 h-full w-full fixed z-50 hidden" id="imageContainer">
        <img id="image" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 content-fit"
            src="" />
        <button onclick="this.parentElement.classList.add('hidden')" class="absolute top-2 right-2">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="2em"
                width="2em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                </path>
            </svg>
        </button>
    </div>

    <!-- This is the side header -->
    <x-sideheader />

    <main class="ms-9 xl:ms-[136px]">
        <!-- This is the top bar --->
        <div class="bg-eerie_black rounded-b-lg me-1 border border-outer_space-500 border-t-0">
            <div class="flex justify-between items-center px-4 py-4">
                <!-- This is the filters side -->
                <div class="flex items-center space-x-8">
                    <p class="inline font-bold text-lg">Trade Details</p>
                </div>

                <x-notification />
            </div>
        </div>

        <section class="me-1">
            <div>
                <div class="ps-2 mt-4">
                    <h1 class="text-6xl text-blue-400 uppercase">{{ $trade->symbol }}</h1>
                    <div class="flex justify-between items-center">
                        <p class="text-seasalt-300">
                            {{ \App\Models\Stocks::where('symbol', $trade->symbol)->first('name')->name ?? 'Unknown company' }}
                        </p>
                        @if ($trader == Auth::id())
                            <button class="px-1 text-sm text-seasalt-400 hover:underline hover:text-red-600"
                                onclick="deleteTrade({{ $trade->id }})">
                                Delete trade
                            </button>
                        @endif
                    </div>
                </div>

                <div>
                    <table class="w-full text-sm border-separate border-spacing-y-2 table-auto">
                        <thead class="bg-onyx">
                            <tr class="font-bold text-left">
                                <td class="ps-2 py-3 max-w-min" colspan="1">Status</td>
                                <td class="">Entry</td>
                                <td class="">Exit</td>
                                <td class="">Quantity</td>
                                <td class="">Portfolio%</td>
                            </tr>
                        </thead>
                        <tbody class="bg-eerie_black">
                            <tr>
                                {{-- Status --}}
                                <td class="ps-1 py-2 flex">
                                    <select name="status" id="status" onchange="updateStatus({{ $trade->id }})"
                                        class="{{ $trade->status == 'loss' ? 'bg-red-500 text-red-500': 'bg-green-500 text-green-500'}} bg-opacity-20 rounded-full font-bold px-2 py-1 capitalize flex items-center space-x-1 w-20 outline-none">
                                        <option class="bg-white text-eerie_black-100" value="open" {{ $trade->status == 'open' ? 'selected' : '' }}>Open</option>
                                        <option class="bg-white text-eerie_black-100" value="win" {{ $trade->status == 'win' ? 'selected' : '' }}>Win</option>
                                        <option class="bg-white text-eerie_black-100" value="loss" {{ $trade->status == 'loss' ? 'selected' : '' }}>Loss</option>
                                        <p>{{ $trade->status }}</p>
                                    </select>
                                </td>
                                <td>
                                    {{ $oldestHistory->priceperunit }}
                                </td>
                                <td>
                                    {{ $latestHistory->priceperunit }}
                                </td>
                                <td>
                                    @php
                                        $quantity = 0;

                                        foreach ($history as $entry) {
                                            if ($entry->call == 'buy') {
                                                $quantity += $entry->quantity;
                                            } else {
                                                $quantity -= $entry->quantity;
                                            }
                                        }
                                    @endphp
                                    {{ $quantity }}
                                </td>
                                <td>
                                    {{ $portfolioPersentage }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <div class="font-bold py-2">
                        <p>History</p>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-onyx">
                            <tr class="font-medium text-left">
                                <td class="ps-4 py-2">Call</td>
                                <td>Price</td>
                                <td>Qty</td>
                                <td>Amount</td>
                                <td>Date</td>
                                <td>Time</td>
                                @if (Auth::id() == $trader)
                                    <td class="">
                                        <svg onclick="addHistory(event, {{ $trade->id }})" stroke="currentColor"
                                            fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                            stroke-linejoin="round" height="1.5em" width="1.5em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect stroke="#4ade80" stroke-width="1" fill="none" x="1" y="1"
                                                width="18" height="18"></rect>
                                            <line stroke="white" x1="6" y1="10" x2="14"
                                                y2="10"></line>
                                            <line stroke="white" x1="10" y1="6" x2="10"
                                                y2="14"></line>
                                        </svg>
                                    </td>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-eerie_black divide-y divide-outer_space-500">
                            @if ($history->count() != 0)
                                @foreach ($history as $entry)
                                    <tr>
                                        <td class="max-w-min">
                                            <p
                                                @if ($entry->call == 'buy') class="ms-2 py-1 capitalize text-green-500 bg-green-600 bg-opacity-20 text-center font-bold rounded-full w-14 my-1"
                                                        @else
                                                        class="ms-2 px-2 py-1 capitalize text-red-500 bg-red-500 bg-opacity-20 text-center font-bold rounded-full w-14 my-1" @endif>
                                                {{ $entry->call }}
                                            </p>
                                        </td>
                                        <td>{{ $entry->priceperunit }}</td>
                                        <td>{{ $entry->quantity }}</td>
                                        <td>{{ round($entry->priceperunit * $entry->quantity) }}</td>
                                        <td class="">{{ \Carbon\Carbon::parse($entry->date)->format('d/m/Y') }}
                                        </td>
                                        <td class="">{{ \Carbon\Carbon::parse($entry->time)->format('H:m') }}
                                        </td>
                                        @if (Auth::id() == $trader)
                                            <td class="pe-2 pt-1">
                                                <svg onclick="removeHistory(event, {{ $entry->id }})"
                                                    stroke="currentColor" fill="none" stroke-width="2"
                                                    viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                                    height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
                                                    <rect stroke="#4ade80" stroke-width="1" fill="none" x="1" y="1"
                                                        width="18" height="18"></rect>
                                                    <line stroke="white" x1="6" y1="10" x2="14"
                                                        y2="10"></line>
                                                </svg>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td class="py-4" colspan="7">
                                        No record found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 mb-2">
                    <div class="bg-onyx">
                        <div class="font-bold px-2 py-2">
                            <p>Imgaes</p>
                        </div>
                    </div>
                    <div class="bg-eerie_black">
                        <div class="grid grid-flow-col overflow-x-auto justify-start py-6">
                            @foreach ($images as $image)
                                <div class="ps-2 h-48 w-48 relative group">
                                    <img onclick="showImage(this)" class="h-full w-full trades"
                                        src="{{ asset('uploads/' . $image->image_path) }}" alt="" />
                                    <div onclick="deleteImage(event, {{ $image->id }})"
                                        class="absolute top-1 right-1 rounded-full bg-eerie_black bg-opacity-80 hidden group-hover:block hover:bg-red-600 hover:cursor-pointer">
                                        <svg class="m-1" stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach

                            @if (Auth::id() == $trader)
                                <div onclick="getTradeImage()"
                                    class="h-48 w-48 ms-2 border border-dashed border-green-400 relative me-1 hover:cursor-pointer">
                                    <div class="absolute top-1/2 left-1/2 transfrom -translate-x-1/2 -translate-y-1/2">
                                        <svg stroke="white" fill="none" stroke-width="1" viewBox="0 0 24 24"
                                            stroke-linecap="round" stroke-linejoin="round" height="5em"
                                            width="5em" xmlns="http://www.w3.org/2000/svg">
                                            <line stroke="white" x1="12" y1="8" x2="12"
                                                y2="16"></line>
                                            <line stroke="white" x1="8" y1="12" x2="16"
                                                y2="12"></line>
                                        </svg>
                                        <p class="font-light text-sm">Add Image</p>
                                        <form id="imageForm" action="/image" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" name="tradeId" value="{{ $trade->id }}" hidden>
                                            <input type="file" name="trade_image" id="tradeImage"
                                                multiple="false" hidden />
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="w-full mt-2">
                        <div class="flex bg-onyx items-center justify-between w-full">
                            <h4 class="px-2 py-2 font-bold text-sm">Setups</h4>
                            @if ($trader == Auth::id())
                                <button class="w-28 bg-emerald-500 my-2 mx-2 py-2 px-2 rounded-md text-sm font-bold"
                                    onclick="openNoteForm('Setup')">Add Setup</button>
                            @endif
                        </div>
                        <div class="bg-eerie_black w-full flex flex-wrap py-2 px-2">
                            @if ($setups->count() != 0)
                                @foreach ($setups as $setup)
                                    <div class="flex space-x-2 bg-onyx border border-outer_space-500 items-center mb-1 me-1"
                                        data-id="{{ $setup->id }}">
                                        <div class="flex-grow hover:cursor-pointer"
                                            onclick="showNote({{ $setup->id }})">
                                            <p class="ps-2 py-1 line-clamp-1 font-bold max-w-[160px]">
                                                {{ $setup->heading }}
                                            </p>
                                        </div>
                                        @if (Auth::id() == $trader)
                                            <div class="pe-2 flex space-x-1 items-center">
                                                <button onclick="deleteNote(event, {{ $setup->id }})">
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 24 24" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center flex-grow">
                                    <p class="py-2 text-sm">This trade has no setups.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="w-full mt-2">
                        <div class="flex bg-onyx items-center justify-between w-full">
                            <h4 class="px-2 py-2 font-bold text-sm">Mistakes</h4>
                            @if ($trader == Auth::id())
                                <button class="w-28 bg-red-500 my-2 mx-2 py-2 px-2 rounded-md text-sm font-bold"
                                    onclick="openNoteForm('Mistake')">Add Mistake</button>
                            @endif
                        </div>
                        <div class="bg-eerie_black w-full flex flex-wrap py-2 px-2">
                            @if ($mistakes->count() != 0)
                                @foreach ($mistakes as $mistake)
                                    <div class="flex space-x-2 bg-onyx border border-outer_space-500 items-center mb-1 me-1"
                                        data-id="{{ $mistake->id }}">
                                        <div class="flex-grow hover:cursor-pointer"
                                            onclick="showNote({{ $mistake->id }})">
                                            <p class="ps-2 py-1 line-clamp-1 font-bold max-w-[160px]">
                                                {{ $mistake->heading }}
                                            </p>
                                        </div>
                                        @if (Auth::id() == $trader)
                                            <div class="pe-2 flex space-x-1 items-center">
                                                <button onclick="deleteNote(event, {{ $mistake->id }})">
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 24 24" height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center flex-grow">
                                    <p class="py-2 text-sm">This trade has no mistakes.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <form action="/addRecord/{{ $trade->id }}" id="addRecordDiv" method="POST"
        class="{{ $errors->any() ? '' : 'hidden' }} p-4 space-y-4 bg-eerie_black fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border border-outer_space-500 min-w-[280px]">
        <div class="hidden">
            @csrf
        </div>
        <div class="flex justify-between">
            <p class="font-bold text-lg">Add Record</p>
            <button type="button" id="closeRecord" onclick="addRecordDiv.classList.add('hidden')">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                    </path>
                </svg>
            </button>
        </div>
        <div>
            <p class="text-sm font-bold mb-1">Call</p>
            <select name="call" class="py-1 outline-none w-full bg-eerie_black-100 broder">
                <option value="buy" {{ old('call') == 'buy' ? 'selected' : '' }}>Buy</option>
                <option value="sell" {{ old('call') == 'sell' ? 'selected' : '' }}>Sell</option>
            </select>
            @error('call')
                <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <p class="text-sm font-bold mb-1"> Price </p>
            <input value="{{ old('priceperunit') }}" name="priceperunit" id="newRecordPricePerUnit"
                class="py-1 px-1 outline-none w-full bg-eerie_black-100 broder" type="number"
                placeholder="Price of a single stock" />
            @error('priceperunit')
                <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <p class="text-sm font-bold mb-1"> Quantity </p>
            <input value="{{ old('quantity') }}" name="quantity" id="newRecordQuantity"
                class="py-1 px-2 outline-none w-full bg-eerie_black-100 broder" type="number"
                placeholder="Number of stocks" />
            @error('quantity')
                <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <p class="text-sm font-bold mb-1"> Date </p>
            <input name="date" class="py-1 px-2 outline-none w-full bg-eerie_black-100 broder" type="text"
                id="date" placeholder="dd/mm/YY" />
        </div>
        <div>
            <p class="text-sm font-bold mb-1"> Time </p>
            <input name="time" class="py-1 px-2 outline-none w-full bg-eerie_black-100 broder" type="text"
                id="time" placeholder="H:m" />
        </div>
        <input name="tradeId" value="{{ $trade->id }}" type="text" hidden>
        @error('amount')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <div class="pt-1 flex">
            <button type="submit" class="ms-auto px-2 py-1 bg-teal-400 rounded-md">
                Add Record
            </button>
        </div>
    </form>

    <div id="noteDiv"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-eerie_black-100 border border-outer_space-500 min-w-[240px] max-w-xs">
        <div class="flex items-center justify-between border-b border-outer_space-500">
            <p id="noteHeading" class="font-bold py-2 px-2 bg-eerie_black-100 overflow-x-scroll w-full outline-none">
            </p>
            <button type="button" class="me-2" onclick="this.parentNode.parentNode.classList.add('hidden')">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                    </path>
                </svg>
            </button>
        </div>
        <p id="noteDescription" class="py-2 px-2 w-full bg-eerie_black-100 outline-none max-h-80 overflow-y-scroll">
        </p>
    </div>

    <form action="/note/{{ $trade->id }}" method="POST" id="noteForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-eerie_black-100 border border-outer_space-500 max-w-xs">
        @csrf
        <div class="flex items-center justify-between border-b border-outer_space-500">
            <input name="heading" class="font-bold py-2 bg-eerie_black-100 px-2 overflow-x-scroll w-full outline-none"
                id="newNoteHeading" placeholder="Heading" />
            <input type="hidden" name="type" id="newNoteType">
            <button type="button" class="me-2" onclick="noteForm.classList.add('hidden')">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z">
                    </path>
                </svg>
            </button>
        </div>
        <textarea name="content" rows="10" cols="10" class="py-2 px-2 w-full bg-eerie_black-100 mt-2 outline-none"
            id="newNoteDescription" placeholder="Description"></textarea>
        <div class="py-2 px-2 border-t border-outer_space-500 flex">
            <button type="submit" class="bg-white px-4 py-1 ms-auto rounded-md text-black font-bold">Add</button>
        </div>
    </form>

</body>
@if (session('errors') && session('errors')->has('tradeOwnershipError'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alert(@json(session('errors')->first('tradeOwnershipError')));
        });
    </script>
@endif
<script src="{{ asset('js/notifications.js') }}"></script>
<script src="{{ asset('js/trade.js') }}"></script>

</html>
