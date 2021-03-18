@if ($paginator->hasPages())
    <div class="row">
        <div class="column large-full">
            <nav class="pgn">
                <ul>

                    @if ($paginator->onFirstPage())
                        <li><span class="pgn__num current">Prev</span></li>
                    @else
                        <li><a class="pgn__prev" href="{{ $paginator->previousPageUrl() }}">Prev</a></li>
                    @endif

                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><span class="pgn__num current">{{ $page }}</span></li>
                                @elseif (($page == $paginator->currentPage() + 1 || $page ==
                                    $paginator->currentPage() + 2 || $page == $paginator->currentPage() - 1 || $page ==
                                    $paginator->currentPage() - 2)
                                    || $page == $paginator->lastPage())
                                    <li><a class="pgn__num" href="{{ $url }}">{{ $page }}</a></li>
                                @elseif ($page == $paginator->lastPage() - 1)
                                    <span></span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())

                        <li><a class="pgn__num" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
                    @else
                        <li><span class="pgn__num current">Next</span></li>

                    @endif

                    {{-- <a class="pgn__prev" href="{{ asset('Typerite/#0') }}">Prev</a>
                <li><a class="pgn__num" href="{{ asset('Typerite/#0') }}">1</a></li>
                <li><span class="pgn__num current">2</span></li>
                <li><a class="pgn__num" href="{{ asset('Typerite/#0') }}">3</a></li>
                <li><a class="pgn__num" href="{{ asset('Typerite/#0') }}">4</a></li>
                <li><a class="pgn__num" href="{{ asset('Typerite/#0') }}">5</a></li>
                <li><span class="pgn__num dots">…</span></li>
                <li><a class="pgn__num" href="{{ asset('Typerite/#0') }}">8</a></li>
                <li><a class="pgn__next" href="{{ asset('Typerite/#0') }}">Next</a></li> --}}
                </ul>
            </nav>
        </div>
    </div>


@endif
