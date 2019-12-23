@if($post->published_at)
    @if(!$post->page)
        <a href="{{ route('articles.show', ['slug' => $post->slug, $post]) }}" target="_blank">{{ $post->title }}</a>
    @else
        <a href="{{ route('page', ['slug' => $post->slug]) }}" target="_blank">{{ $post->title }}</a>
    @endif
@else
    {{ $post->title }}
@endif
