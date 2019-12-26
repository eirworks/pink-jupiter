@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                @if($user->image)
                <div class="text-center">
                    <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="profile-image profile-main-image">
                </div>
                @endif

                <h3 class="text-center">{{ $user->name }}</h3>

                <div class="mb-3">Tentang Kami: {{ $user->description }}</div>

                <div class="mb-2">
                    <b>Lokasi</b>: {{ $user->city->name }}, {{ $user->city->province->name }}
                </div>
                <div class="mb-2">
                    <b>Kecamatan</b>: {{ $user->district }}
                    <br>
                    <b>Kelurahan</b>: {{ $user->village }}
                </div>
                <div class="mb-2">Views: {{ $user->visitors }}</div>

                <div class="btn-group mb-2">
                    <a class="btn btn-outline-primary" href="{{ route('listing.contact.wa', [$user]) }}" target="_blank">Whatsapp</a>
                    @if($user->contact_telegram)
                        <a class="btn btn-outline-primary" href="{{ route('listing.contact.tg', [$user]) }}" target="_blank">Telegram</a>
                    @endif
                </div>

                <div>
                    Layanan:
                </div>
                <ul class="list-unstyled">
                    @foreach($user->categories as $category)
                        <li class="mb-2">
                            <div><strong>{{ $category->name }}</strong></div>
                            <div class="text-success">
                                Rp{{ number_format($category->pivot->price, 2, '.', ',') }}
                            </div>
                            <div>
                                {{ $category->pivot->description }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('bottom_script')
    <script type="text/javascript">
        function wa(id){
            window.location = "{{ route('listing.contact.wa', [$user]) }}"
        }
    </script>
@endpush

