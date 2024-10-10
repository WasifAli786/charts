
<div class="bg-eerie_black rounded-lg border border-outer_space-500 py-2 mt-2 me-1">
    <div class="text-sm font-light flex justify-end flex-wrap space-x-2 items-center me-1">
        <a class="hidden sm:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1"
            href="/trades/{{ $attributes['id'] }}/today">Today</a>
        <a class="hidden sm:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1"
            href="/trades/{{ $attributes['id'] }}/yesterday">Yesterday</a>
        <a href="/trades/{{ $attributes['id'] }}/thisweek" class="mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1">This week</a>
        <a href="/trades/{{ $attributes['id'] }}/lastweek" class="mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1">Last week</a>
        <a class="hidden xs:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1"
            href="/trades/{{ $attributes['id'] }}/thismonth">This
            month</a>
        <a class="hidden xs:block mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1"
            href="/trades/{{ $attributes['id'] }}/lastmonth">Last
            month</a>
        <div id="calendarContainer"
            class="flex space-x-1 items-center mb-1 rounded-full bg-onyx hover:bg-teal-400 px-2 py-1 relative group">
            <button>Select Date</button>
            <svg id="selectDateSvg" stroke="currentColor" fill="currentColor" stroke-width="0"
                viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M840.4 300H183.6c-19.7 0-30.7 20.8-18.5 35l328.4 380.8c9.4 10.9 27.5 10.9 37 0L858.9 335c12.2-14.2 1.2-35-18.5-35z">
                </path>
            </svg>
            <div id="calendarContainer1" class="hidden">
                <form class="flex items-center absolute right-0 top-9 w-max border border-outer_space-500"
                    method="get" action="/range/{{ $attributes['id'] }}" id="rangeForm" name="rangeForm">
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