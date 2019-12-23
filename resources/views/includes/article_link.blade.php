@if(!$post->page)
    @if($post->published_at)
        <a href="{{ route('articles.show', ['slug' => $post->slug, $post]) }}">{{ $post->title }}</a>
    @else
        {{ $post->title }}
    @endif
@else
    {{ $post->title }}
@endif
