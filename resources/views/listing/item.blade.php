<a href="{{ route('listing.show', [$ad]) }}" class="d-block text-decoration-none">
    <div class="card my-4">
        <div class="card-body">

            @if($ad->image)
                <img src="{{ \Storage::disk('public')->url($ad->image) }}" alt="{{ $ad->name }}" class="img-thumbnail img-fluid">
            @endif
            <div>
                <strong>
                    @isset($ads)
                        <div style="font-size: 1.4rem">#{{ $loop->index + 1 + ($ads->perPage() * ($ads->currentPage() - 1)) }}</div>
                    @endisset
                    {{ $ad->name }}
                </strong>
            </div>
            <div class="text-muted">
                {{ $ad->city->name }},
                {{ $ad->city->province->name }}
            </div>

            <div>
                @include('includes.price_format', ['number' => $ad->price])
            </div>

        </div>
    </div>
</a>
