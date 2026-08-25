@extends('layouts.admin')

@section('title', 'Construction Education Posts')
@section('page_title', 'Construction Education Posts')

@section('content')
<style>
    .education-admin-grid { display: grid; gap: 18px; }
    .education-panel {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }
    .education-panel h5 {
        color: #1c2c3e;
        font-weight: 900;
        margin-bottom: 16px;
    }
    .education-card {
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 16px;
        background: #fbfdff;
        margin-bottom: 16px;
    }
    .education-thumb {
        width: 100%;
        max-height: 220px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 12px;
        border: 1px solid #e5e7eb;
    }
    .save-btn {
        border: none;
        background: #f25c05;
        color: #fff;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 900;
    }
    .delete-btn {
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 900;
    }
</style>

<div class="education-admin-grid">
    @if(session('success'))
        <div class="alert alert-success mb-0">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-0">{{ $errors->first() }}</div>
    @endif

    <div class="education-panel">
        <h5><i class="bi bi-plus-circle-fill text-warning me-2"></i>Add Instagram Education Post</h5>
        <form action="{{ route('admin.construction-education-posts.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-4">
                <label class="form-label fw-bold">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="What is Structural Engineering?" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Instagram Post URL</label>
                <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" class="form-control" placeholder="https://www.instagram.com/p/..." required>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Published</label>
                <div class="form-check mt-2">
                    <input type="checkbox" name="is_published" value="1" class="form-check-input" checked>
                    <label class="form-check-label">Show on page</label>
                </div>
            </div>
            <div class="col-md-9">
                <label class="form-label fw-bold">Image</label>
                <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/webp" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="save-btn w-100" type="submit">Add Post</button>
            </div>
        </form>
    </div>

    <div class="education-panel">
        <h5><i class="bi bi-images text-primary me-2"></i>All Education Posts</h5>

        @forelse($posts as $post)
            <div class="education-card">
                <div class="row g-3 align-items-start">
                    <div class="col-lg-3">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($post->image) }}" class="education-thumb" alt="{{ $post->title }}">
                        <a href="{{ $post->instagram_url }}" class="btn btn-outline-primary w-100" target="_blank" rel="noopener">Open Instagram</a>
                    </div>
                    <div class="col-lg-9">
                        <form action="{{ route('admin.construction-education-posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Post Title</label>
                                <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Instagram Post URL</label>
                                <input type="url" name="instagram_url" value="{{ old('instagram_url', $post->instagram_url) }}" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Sort</label>
                                <input type="number" name="sort_order" value="{{ old('sort_order', $post->sort_order) }}" class="form-control" min="0">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Replace Image</label>
                                <input type="file" name="image" class="form-control" accept="image/png,image/jpeg,image/webp">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="is_published" value="1" class="form-check-input" {{ $post->is_published ? 'checked' : '' }}>
                                    <label class="form-check-label">Show on page</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="save-btn w-100" type="submit">Update Post</button>
                            </div>
                        </form>

                        <form action="{{ route('admin.construction-education-posts.destroy', $post) }}" method="POST" class="mt-2" onsubmit="return confirm('Delete this education post?')">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn" type="submit">Delete Post</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-muted fw-semibold">No construction education posts added yet.</div>
        @endforelse

        {{ $posts->links() }}
    </div>
</div>
@endsection
