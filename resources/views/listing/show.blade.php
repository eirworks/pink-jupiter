@extends('layouts.app')

@section('seo_description', $description)
@section('seo_keywords', $keywords)

@section('title')
    {{ $service->name }}
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb d-none d-md-flex">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['city_id' => $service->city_id]) }}">{{ $service->city->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['city_id' => $service->city_id, 'category_id' => $service->category_id]) }}">{{ $service->category->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{ \Storage::disk('public')->url($service->image) }}" alt="{{ $service->title }}">
                        </div>

                        <h2>{{ $service->name }}</h2>

                        <div class="text-muted my-2">
                            @include('includes.price_format', ['number' => $service->price ])
                            <span class="mx-2">
                                {{ $service->city->name }}, {{ $service->city->province->name }}
                            </span>
                        </div>

                        <div>
                            {{ $service->description }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if($service->image)
                            <div class="text-center">
                                <img src="{{ \Storage::disk('public')->url($service->user->image) }}" alt="{{ $service->name }}" class="profile-image">
                            </div>
                        @endif

                        <div class="font-weight-bold text-center mt-3">{{ $service->user->name }}</div>


                        <div class="small text-center text-muted">
                            <div>
                                Bergabung sejak {{ \Carbon\Carbon::parse($service->user->created_at)->format("j M Y") }}
                            </div>
                        </div>

                    </div>

                </div>
                <div class="my-3">
                    <button class="btn btn-outline-secondary btn-block">Telp</button>
                    <button class="btn btn-outline-success btn-block">Whatsapp</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('bottom_script')
    <script type="text/javascript">
        function wa(id){
            window.location = "{{ route('listing.contact', [$service, 'wa']) }}"
        }
    </script>
@endpush

