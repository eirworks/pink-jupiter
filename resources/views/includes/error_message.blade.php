<?php
$states = ['error' => 'danger', 'success' => 'success', 'warning' => 'warning', 'info' => 'info'];
?>
@foreach($states as $state => $color)
    @if(session($state))
        <div class="container">
            <div class="alert alert-{{ $color }} my-2">
                {{ session($state) }}
            </div>
        </div>
    @endif
@endforeach
