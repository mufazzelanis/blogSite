<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Category Name">
    <textarea name="description"></textarea>
    <button type="submit">Save</button>
</form>
