@if(isset($bcItems) && count($bcItems) > 0)
    <ul class="breadcrumb">
        @foreach($bcItems as $bcItem)
            <li class="breadcrumb-item">
                @if(isset($bcItem['url']))
                <a href="{{ $bcItem['url'] }}">{{ $bcItem['name'] }}</a>
                @else
                {{ $bcItem['name'] }}
                @endif
            </li>
        @endforeach
    </ul>
@endif
