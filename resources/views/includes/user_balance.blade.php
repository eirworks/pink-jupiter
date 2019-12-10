@if(isset($user) && $user->balance)
    Rp{{ number_format($user->balance, 2, ',', '.') }}
@endif
