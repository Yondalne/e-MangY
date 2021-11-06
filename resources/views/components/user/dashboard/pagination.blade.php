@if ($paginator->hasPages())
    <nav>
        @if (!$paginator->onFirstPage())
            <div><a href="{{$paginator->previousPageUrl()}}"><i class="fas fa-chevron-left"></i></a></div>
        @else
            <div style="visibility: hidden"><a href="#"><i class="fas fa-chevron-left"></i></a></div>
        @endif

        {{-- {{dd($elements)}} $elements has all of the url for the page of pagination  --}}
        @foreach ($elements[0] as $page => $url)
            <div><a href="{{$url}}">{{$page}}</a></div>
        @endforeach

        @if ($paginator->hasMorePages())
            <div><a href="{{$paginator->nextPageUrl()}}"><i class="fas fa-chevron-right"></i></a></div>
        @else
            <div style="visibility: hidden"><a href="#"><i class="fas fa-chevron-right"></i></a></div>
        @endif
    </nav>
@else
    <span>Il n'y en a pas plus e_e</span>
@endif
