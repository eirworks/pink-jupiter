@if($service->city_id > 0)
    <strong>Kota</strong>: {{ $service->city->name }}, {{ $service->city->province->name }}
@else
    Kota belum di set
@endif
