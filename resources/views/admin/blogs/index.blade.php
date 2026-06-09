@extends('layouts.admin')

@section('title', 'Blogs')
@section('page_title', 'Blogs')

@section('content')
<style>
    .blog-admin-grid {
        display: grid;
        gap: 18px;
    }

    .blog-panel {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }

    .blog-panel h5 {
        color: #1c2c3e;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .blog-card {
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 16px;
        background: #fbfdff;
        margin-bottom: 16px;
    }

    .blog-thumb {
        width: 100%;
        max-height: 160px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .save-btn {
        border: none;
        background: #f25c05;
        color: #fff;
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 900;
    }

    .delete-btn {
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 12px;
        padding: 10px 14px;
        font-weight: 900;
    }
</style>

<div class="blog-admin-grid">
    @if(session('success'))
        <div class="alert alert-success mb-0">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-0">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="blog-panel">
        <h5><i class="bi bi-plus-circle-fill text-warning me-2"></i>Add Blog</h5>
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Published Date</label>
                <input type="date" name="published_at" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Blog Card Image</label>
                <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <small class="text-muted">Upload the full card image shown on Blogs / Articles.</small>
            </div>
            <div class="col-md-3">
                <label class="form-label">Heading Image</label>
                <input type="file" name="hero_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <small class="text-muted">Shown at the top of the blog detail page.</small>
            </div>
            <div class="col-md-12">
                <label class="form-label">Short Description</label>
                <input type="text" name="excerpt" class="form-control" maxlength="500">
            </div>
            <div class="col-md-12">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="8" required></textarea>
            </div>
            <div class="col-md-3">
                <label class="form-label d-block">Status</label>
                <label class="form-check">
                    <input type="checkbox" name="is_published" value="1" class="form-check-input" checked>
                    <span class="form-check-label">Published</span>
                </label>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="save-btn w-100" type="submit">Add Blog</button>
            </div>
        </form>
    </div>

    <div class="blog-panel">
        <h5><i class="bi bi-journal-text text-primary me-2"></i>All Blogs</h5>

        @forelse($blogs as $blog)
            <div class="blog-card">
                @if($blog->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($blog->image) }}" class="blog-thumb" alt="{{ $blog->title }}">
                @endif

                <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ $blog->title }}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Published Date</label>
                        <input type="date" name="published_at" value="{{ optional($blog->published_at)->format('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Change Blog Card Image</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">This image is shown directly on Blogs / Articles.</small>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Change Heading Image</label>
                        <input type="file" name="hero_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">This image is shown at the top of the blog detail page.</small>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Short Description</label>
                        <input type="text" name="excerpt" value="{{ $blog->excerpt }}" class="form-control" maxlength="500">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="7" required>{{ $blog->content }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label d-block">Status</label>
                        <label class="form-check">
                            <input type="checkbox" name="is_published" value="1" class="form-check-input" {{ $blog->is_published ? 'checked' : '' }}>
                            <span class="form-check-label">Published</span>
                        </label>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="save-btn w-100" type="submit">Update Blog</button>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-primary w-100" target="_blank">View</a>
                    </div>
                </form>

                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="mt-2" onsubmit="return confirm('Delete this blog?')">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" type="submit">Delete Blog</button>
                </form>
            </div>
        @empty
            <div class="text-muted fw-semibold">No blogs added yet.</div>
        @endforelse

        {{ $blogs->links() }}
    </div>
</div>
@endsection
