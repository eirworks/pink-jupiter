<a href="{{ route('listing.show', [$ad]) }}" class="d-block text-decoration-none">
    <div class="card my-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10 col-8">
                    <div>
                        <strong>{{ $ad->name }}</strong>
                    </div>
                    <div class="text-muted">
                        {{ $ad->city->name }},
                        {{ $ad->city->province->name }}
                    </div>

                    <div>
                        @include('includes.price_format', ['number' => $ad->price])
                    </div>
                </div>
                <div class="col-md-2 col-4 text-center">
                    @if($ad->image)
                        <img src="{{ \Storage::disk('public')->url($ad->image) }}" alt="{{ $ad->name }}" class="img-thumbnail img-fluid">
                    @endif
                    @isset($ads)
                        <div style="font-size: 1.4rem">#{{ $loop->index + 1 + ($ads->perPage() * ($ads->currentPage() - 1)) }}</div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</a>
