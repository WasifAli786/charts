<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
    <title>Trades History</title>
</head>

<body>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    <form action="/addtrade" class="min-w-[280px] mx-auto my-8 bg-eerie_black p-5 rounded-lg" method="POST">
        @csrf
        <label class="block ps-1 py-2 font-bold">Symbol</label>
        <input value="{{ old('symbol') }}" type="text"
            class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" name="symbol" placeholder="Symbol"
            required>
        @error('symbol')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <label class="block ps-1 py-2 font-bold">Price</label>
        <input value="{{ old('priceperunit') }}" name="priceperunit"
            class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" placeholder="Price of single share"
            required />
        @error('priceperunit')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <label value="{{ old('quantity') }}" class="block ps-1 py-2 font-bold">Quantity</label>
        <input type="number" name="quantity" class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none"
            placeholder="Enter Amount" required />
        @error('quantity')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <label class="block ps-1 py-2 font-bold">Call</label>
        <select name="call" class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg" required>
            <option value="buy" {{ old('call') == 'buy' ? 'selected' : '' }}>Buy</option>
            <option value="sell" {{ old('call') == 'sell' ? 'selected' : '' }}>Sell</option>
        </select>
        @error('call')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <label class="block ps-1 py-2 font-bold">Date</label>
        <input class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" type="text" name="date" id="date"
            placeholder="dd/mm/YY" required />
        <label class="block ps-1 py-2 font-bold">Time</label>
        <input class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" name="time" id="time"
            placeholder="H:m" required />
        @error('amount')
            <p class="text-xs text-red-600 text-light mb-2 ms-1 mt-1">{{ $message }}</p>
        @enderror
        <div class="mb-2 mt-4">
            <button href="#"
                class="font-medium px-4 py-2 rounded-lg bg-green-400 hover:bg-green-500 text-black hover:cursor-pointer ms-auto">
                Open Trade
            </button>
        </div>
    </form>
    </div>
</body>
<script>
    flatpickr("#date", {
        dateFormat: "d/m/Y",
        maxDate: 'today',
        defaultDate: 'today'
    });
    flatpickr("#time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: '{{ \Carbon\Carbon::now()->format('H:m') }}'
    });
</script>

</html>
