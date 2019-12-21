@if($post->post_category_id > 0)
    {{ $post->category->name }}
@else
    <em>Tanpa Kategori</em>
@endif
