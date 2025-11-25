<h1>All Posts</h1>
@foreach($posts as $post)
    <p>{{ $post->title }} ({{ $post->category->name }})</p>
@endforeach
