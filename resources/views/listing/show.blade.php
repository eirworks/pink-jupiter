@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card" style="margin-top: 130px">
            <div class="card-body">
                @if($user->image)
                    <div class="text-center">
                        <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="profile-image profile-main-image">
                    </div>
                @endif

                <h3 class="text-center">{{ $user->name }}</h3>

                <div class="text-center text-muted mb-2">
                    {{ $user->city->name }}, {{ $user->city->province->name }}
                    <br>
                    <b>Kecamatan</b>: {{ $user->district }}, <b>Kelurahan</b>: {{ $user->village }}
                </div>

                <div class="mb-3">Tentang Kami: {{ $user->description }}</div>

{{--                <div class="mb-2">Views: {{ $user->visitors }}</div>--}}

                <h4>
                    Layanan
                </h4>
                <ul class="list-unstyled">
                    @foreach($user->categories as $category)
                        <li class="mb-2">
                            <div><strong>{{ $category->name }}</strong></div>
                            <div class="btn-group my-2">
                                <a class="btn btn-outline-primary" href="{{ route('listing.contact', [$user, 'wa', $category->id]) }}" target="_blank">Whatsapp</a>
                                @if($user->contact_telegram)
                                    <a class="btn btn-outline-primary" href="{{ route('listing.contact', [$user, 'tg', $category->id]) }}" target="_blank">Telegram</a>
                                @endif
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
            window.location = "{{ route('listing.contact', [$user, 'wa']) }}"
        }
    </script>
@endpush

