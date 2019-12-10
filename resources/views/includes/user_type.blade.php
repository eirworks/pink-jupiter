@if(isset($user_type))
    @if($user_type == \App\User::TYPE_ADMIN)
        <span class="badge badge-primary">Admin</span>
    @elseif($user_type == \App\User::TYPE_PARTNER)
        <span class="badge badge-success">Mitra</span>
    @endif
@endif
