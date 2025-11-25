<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
    .custom-pagination .page-link {
        border-radius: 8px;
        padding: 8px 14px;
        margin: 0 4px;
        border: 1px solid #ddd;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .custom-pagination .page-link:hover {
        background-color: #e9ecef;
    }
</style>
</head>

<body>
<div class="container my-5">

    <h1 class="mb-4 text-center">All Posts</h1>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div id="successMessage" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
        // Hide success message after 2 seconds
        setTimeout(function () {
            let alertBox = document.getElementById('successMessage');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 2000);
    </script>


    <!-- ================= Create Post Form ================= -->
    <div class="card mb-5">
        <div class="card-header">Create a New Post</div>
        <div class="card-body">

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>

                <select name="category_id" class="form-select mb-2" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>



                <!-- ================= TAG SELECT DROPDOWN ================= -->
                <div class="dropdown mb-3">
                    <button class="btn btn-light border w-100 d-flex justify-content-between align-items-center"
                            type="button" id="tagsDropdown" data-bs-toggle="dropdown">
                        <span id="selectedTagsText">Choose Tags</span>
                        <span class="ms-2">&#x25BC;</span>
                    </button>

                    <ul class="dropdown-menu p-3 w-100" style="max-height:250px; overflow-y:auto;">
                        @foreach($tags as $tag)
                            <li class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input tag-checkbox"
                                           type="checkbox"
                                           name="tags[]"
                                           value="{{ $tag->id }}"
                                           id="tag{{ $tag->id }}">
                                    <label class="form-check-label" for="tag{{ $tag->id }}">
                                        {{ $tag->name }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tag Select JS -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let checkboxes = document.querySelectorAll('.tag-checkbox');
                        let displayText = document.getElementById('selectedTagsText');

                        checkboxes.forEach(function (cb) {
                            cb.addEventListener('change', function () {
                                updateSelectedTags();
                            });
                        });

                        function updateSelectedTags() {
                            let selected = [];
                            checkboxes.forEach(cb => {
                                if (cb.checked) selected.push(cb.nextElementSibling.innerText.trim());
                            });

                            displayText.innerText = selected.length > 0
                                ? selected.join(', ')
                                : 'Choose Tags';
                        }
                    });
                </script>


                <textarea name="content" class="form-control mb-2" rows="4" placeholder="Content" required></textarea>

                <button type="submit" class="btn btn-primary w-100">Publish</button>
            </form>

        </div>
    </div>
    <!-- ================= END Create Form ================= -->



    <!-- ================= POSTS LIST ================= -->
    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5>{{ $post->title }}</h5>

                        <p>{{ Str::limit($post->content, 150) }}</p>

                        <p><strong>Category:</strong>
                            {{ $post->category->name ?? 'N/A' }}
                        </p>

                        <p><strong>Tags:</strong>
                            @foreach($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </p>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $posts->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>

</div>


<!-- REQUIRED Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
