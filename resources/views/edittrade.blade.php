<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/output.css') }}" />
    <title>Trades History</title>
</head>

<body>
    <main class="container mx-auto">
        <div class="border-b border-outer_space-500 me-2 text-sm font-light py-1 flex justify-between">
            <p class="p-4 hover:cursor-pointer underline underline-offset-4">
                Portfolio 1
            </p>
        </div>

        <section class="mx-2">
            <form action="/trade/{{ $trade['id'] }}" class="max-w-sm mx-auto my-8 bg-eerie_black p-5 rounded-lg"
                method="POST">
                @method('PUT')
                @csrf
                <div class="mb-2">
                    <label class="block ps-1 py-2 font-bold">Status</label>
                    <select name="status" class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg" required>
                        <option value="open" {{ $trade['status'] == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="close" {{ $trade['status'] != 'open' ? 'selected' : '' }}>Close</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block ps-1 py-2 font-bold">Symbol</label>
                    <input type="text" class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none"
                        name="symbol" value="{{ $trade['symbol'] }}" placeholder="Symbol" required>
                </div>
                <div class="mb-2">
                    <label class="block ps-1 py-2 font-bold">Side</label>
                    <select name="side" class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg" required>
                        <option value="short" {{ $trade['side'] == 'short' ? 'selected' : '' }}>Short</option>
                        <option value="long" {{ $trade['side'] == 'long' ? 'selected' : '' }}>Long</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="block ps-1 py-2 font-bold">Date</label>
                    <input class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" name="date"
                        id="date" placeholder="dd/mm/YY" value="{{ $trade['date'] }}" required />
                </div>
                <div class="mb-2">
                    <label class="block ps-1 py-2 font-bold">Time</label>
                    <input class="bg-eerie_black-100 w-full py-2 px-2 rounded-lg outline-none" name="time"
                        id="time" placeholder="H:m" value="{{ $trade['time'] }}" required />
                </div>
                <div class="mb-2 mt-4">
                    <button href="#"
                        class="font-medium px-4 py-2 rounded-lg bg-green-400 hover:bg-green-500 text-black hover:cursor-pointer ms-auto">
                        Save
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#date", {
        dateFormat: "d/m/Y",
        maxDate: 'today',
    });
    flatpickr("#time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>

</html>
