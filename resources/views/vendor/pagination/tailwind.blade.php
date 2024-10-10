@if ($paginator->hasPages())
    <div class="flex justify-end items-center pb-2 space-x-2">
        @if ($paginator->onFirstPage())
            <span
                class="pagination-button rounded-full cursor-not-allowed px-3 py-1 border border-seasalt-900 text-outer_space font-light">«
                Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="pagination-button rounded-full px-3 py-1 border border-seasalt-900 text-seasalt-900 hover:bg-gray-100 hover:text-onyx-100 font-light">«
                Prev</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                @if ($element !== '...')
                    <span
                        class="pagination-button px-2 py-1 border border-seasalt-900 bg-gray-200 text-gray-600">{{ $element }}</span>
                @endif
            @endif

            @if (is_array($element))
                @php
                    $currentPage = $paginator->currentPage();

                    $range = 2;
                @endphp

                @foreach ($element as $page => $url)
                    @if ($page == $currentPage)
                        <span
                            class="hidden sm:block pagination-button px-3 py-1 bg-white underline text-onyx-100">{{ $page }}</span>
                    @elseif ($page >= $currentPage - $range && $page <= $currentPage + $range)
                        <a href="{{ $url }}"
                            class="hidden sm:block pagination-button px-3 py-1 text-seasalt-900 hover:underline hover:bg-seasalt-900 hover:text-onyx-100">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="pagination-button rounded-full px-3 py-1 border border-seasalt-900 text-seasalt-900 hover:bg-seasalt-900 hover:text-onyx-100 font-light">Next
                »</a>
        @else
            <span
                class="pagination-button rounded-full cursor-not-allowed px-3 py-1 border border-seasalt-900 text-seasalt-900 font-light">Next
                »</span>
        @endif
    </div>


@endif
