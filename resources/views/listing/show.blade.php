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

                <div class="mb-3">{{ $user->description }}</div>

                <dl>
                    <dt>Tanggal bergabung</dt>
                    <dd>{{ \Carbon\Carbon::parse($user->created_at)->format("j M Y") }}</dd>
                </dl>
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

