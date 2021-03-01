{{-- <div class="row text-center pt-5 border-top">
    <div class="col-md-12">
        @for ($i = 0; $i < $paginator->count(); $i++)
            @if ($paginator->currentPage() == $i + 1)
                <span>{{ $paginator->currentPage() }}</span>
            @else
                <a href="{{ \Request::route()->getName() }}">{{ $i + 1 }}</a>
            @endif
        @endfor
        {{-- <div class="custom-pagination">
            <span>1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <span>...</span>
            <a href="#">15</a>
        </div> --}}
{{-- {!! $posts->links() !!} --}}
{{-- </div>
</div> --}}

@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="row text-center pt-5 border-top">
        <div class="col-md-12">
            <div class="custom-pagination">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    {{-- <span>
                        < </span> --}}
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}">
                                < </a>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span>{{ $page }}</span>
                            @elseif (($page == $paginator->currentPage() + 1 || $page ==
                                $paginator->currentPage() + 2 || $page == $paginator->currentPage() - 1 || $page ==
                                $paginator->currentPage() - 2)
                                || $page == $paginator->lastPage())
                                <a href="{{ $url }}">{{ $page }}</a>
                            @elseif ($page == $paginator->lastPage() - 1)
                                <span></span>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <span>></span>
                    </a>
                @elseif ($paginator->total() == $paginator->currentPage())
                @else   
                <span>></span>
                @endif
            </div>
        </div>
        <!-- Pagination -->
    </div>
    

@endif
