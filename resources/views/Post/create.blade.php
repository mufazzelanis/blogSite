<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <input type="text" name="title" placeholder="Title">

    <select name="category_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <textarea name="content"></textarea>

    <button type="submit">Publish</button>
</form>
