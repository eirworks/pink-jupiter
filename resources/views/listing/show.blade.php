@extends('layouts.app')

@section('seo_description', $description)
@section('seo_keywords', $keywords)

@section('title')
    {{ $service->name }}
@endsection

@section('content')
    <div class="container" onload="onload">

        <ul class="breadcrumb d-none d-md-flex">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['city_id' => $service->city_id]) }}">{{ $service->city->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home', ['city_id' => $service->city_id, 'category_id' => $service->category_id]) }}">{{ $service->category->name }}</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{ \Storage::disk('public')->url($service->image) }}" alt="{{ $service->title }}" class="img-fluid">
                        </div>

                        <div class="font-weight-bold">{{ $service->name }}</div>

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

                <div class="my-3 d-none d-md-block">
                    <button class="btn btn-outline-secondary btn-block" data-toggle="modal" data-target="#phoneModal">Telp</button>
                    <a class="btn btn-outline-success btn-block" href="{{ route('listing.contact', [$service, 'type' => 'wa']) }}">Whatsapp</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('bottom_script')

    <div class="footer-btn-group d-flex d-md-none">
        <a class="btn btn-outline-secondary" href="{{ route('home', ['category_id' => $service->category_id, 'city_id' => $service->city_id]) }}">Kembali</a>
        <a class="btn btn-outline-secondary" href="{{ route('listing.contact', [$service, 'type' => 'phone']) }}">Telp</a>
        <a class="btn btn-outline-success" href="{{ route('listing.contact', [$service, 'type' => 'wa']) }}">Whatsapp</a>
    </div>

    <!-- Phone Number Modal -->
    <div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hubungi {{ $service->user->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="phoneCanvas" style="width: 400px; height: 150px;">Browser anda terlalu kuno</canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function wa(id){
            window.location = "{{ route('listing.contact', [$service, 'wa']) }}"
        }

        var canvas = document.getElementById("phoneCanvas");
        var ctx=canvas.getContext("2d");
        ctx.font="30px sans-serif";
        ctx.fillStyle = "black";
        ctx.textAlign = "center";
        ctx.fillText("{{ $service->user->contact }}", canvas.width/2, canvas.height/2);
    </script>
@endpush
