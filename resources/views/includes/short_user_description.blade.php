@isset($user)
    @php $maxChar = 200; @endphp
    @if(strlen($user->description) > $maxChar)
        {{ substr($user->description, 0, $maxChar) }}...
    @else
        {{ $user->description }}
    @endif
@endisset
