@extends('layouts.admin')

@section('title', 'Blogs')
@section('page_title', 'Blogs / Page Builder')

@section('content')
<style>
    .blog-admin-grid { display: grid; gap: 18px; }
    .blog-panel {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }
    .blog-panel h5 { color: #1c2c3e; font-weight: 900; margin-bottom: 16px; }
    .blog-card {
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 16px;
        background: #fbfdff;
        margin-bottom: 16px;
    }
    .blog-thumb { width: 100%; max-height: 160px; object-fit: cover; border-radius: 10px; margin-bottom: 10px; }
    .save-btn, .add-block-btn {
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
    .block-toolbar { display: flex; flex-wrap: wrap; gap: 8px; margin: 8px 0 14px; }
    .block-toolbar button {
        border: 1px solid #d8e0eb;
        background: #fff;
        color: #1c2c3e;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 800;
    }
    .content-block {
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 12px;
        background: #fff;
    }
    .content-block-header {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        margin-bottom: 12px;
    }
    .content-block-title {
        margin: 0;
        color: #1c2c3e;
        font-size: 14px;
        font-weight: 900;
        text-transform: capitalize;
    }
    .remove-block-btn {
        border: none;
        background: #f1f5f9;
        color: #b91c1c;
        border-radius: 8px;
        padding: 7px 10px;
        font-weight: 800;
    }
    .current-block-image {
        display: block;
        width: 140px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-bottom: 8px;
    }
</style>

<div class="blog-admin-grid">
    @if(session('success'))
        <div class="alert alert-success mb-0">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-0">{{ $errors->first() }}</div>
    @endif

    <div class="blog-panel">
        <h5><i class="bi bi-plus-circle-fill text-warning me-2"></i>Add Blog / Page</h5>
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 js-block-form">
            @csrf
            @include('admin.blogs.partials.form-fields', ['blog' => null, 'blocks' => []])
            <div class="col-md-3 d-flex align-items-end">
                <button class="save-btn w-100" type="submit">Add Blog</button>
            </div>
        </form>
    </div>

    <div class="blog-panel">
        <h5><i class="bi bi-journal-text text-primary me-2"></i>All Blogs / Pages</h5>

        @forelse($blogs as $blog)
            <div class="blog-card">
                @if($blog->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($blog->image) }}" class="blog-thumb" alt="{{ $blog->title }}">
                @endif

                <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="row g-3 js-block-form">
                    @csrf
                    @include('admin.blogs.partials.form-fields', ['blog' => $blog, 'blocks' => $blog->content_blocks ?? []])
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

@push('scripts')
<script>
    const blockLabels = {
        heading: 'heading',
        text: 'text section',
        image: 'image',
        image_text: 'image + text',
        faq: 'FAQ',
        cta: 'button / CTA'
    };

    function escapeHtml(value) {
        return (value || '').toString()
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function blockFields(type, index, block = {}) {
        const value = (key) => escapeHtml(block[key]);
        const name = (field) => `blocks[${index}][${field}]`;
        const currentImage = block.image
            ? `<img src="${escapeHtml(block.image_url)}" class="current-block-image" alt="">
               <input type="hidden" name="${name('existing_image')}" value="${value('image')}">`
            : '';

        let html = `<input type="hidden" name="${name('type')}" value="${type}">`;

        if (['heading', 'text', 'image_text', 'cta'].includes(type)) {
            html += `<div class="col-md-6"><label class="form-label">Heading</label><input type="text" name="${name('heading')}" class="form-control" value="${value('heading')}"></div>`;
        }

        if (['text', 'image_text'].includes(type)) {
            html += `<div class="col-md-12"><label class="form-label">Details</label><textarea name="${name('body')}" class="form-control" rows="5">${value('body')}</textarea></div>`;
        }

        if (['image', 'image_text'].includes(type)) {
            html += `<div class="col-md-4"><label class="form-label">Image</label>${currentImage}<input type="file" name="${name('image')}" class="form-control" accept=".jpg,.jpeg,.png,.webp"></div>
                     <div class="col-md-8"><label class="form-label">Image Alt Text</label><input type="text" name="${name('image_alt')}" class="form-control" value="${value('image_alt')}"></div>`;
        }

        if (type === 'faq') {
            html += `<div class="col-md-5"><label class="form-label">Question</label><input type="text" name="${name('question')}" class="form-control" value="${value('question')}"></div>
                     <div class="col-md-7"><label class="form-label">Answer</label><textarea name="${name('answer')}" class="form-control" rows="3">${value('answer')}</textarea></div>`;
        }

        if (type === 'cta') {
            html += `<div class="col-md-4"><label class="form-label">Button Text</label><input type="text" name="${name('button_text')}" class="form-control" value="${value('button_text')}"></div>
                     <div class="col-md-8"><label class="form-label">Button URL</label><input type="text" name="${name('button_url')}" class="form-control" value="${value('button_url')}"></div>`;
        }

        return html;
    }

    function addBlock(form, type, block = {}) {
        const container = form.querySelector('.js-blocks-container');
        const index = Number(container.dataset.nextIndex || 0);
        container.dataset.nextIndex = index + 1;

        const wrapper = document.createElement('div');
        wrapper.className = 'content-block';
        wrapper.innerHTML = `
            <div class="content-block-header">
                <p class="content-block-title">${blockLabels[type]}</p>
                <button type="button" class="remove-block-btn" onclick="this.closest('.content-block').remove()">Remove</button>
            </div>
            <div class="row g-3">${blockFields(type, index, block)}</div>
        `;
        container.appendChild(wrapper);
    }

    document.querySelectorAll('.js-block-form').forEach((form) => {
        form.querySelectorAll('[data-add-block]').forEach((button) => {
            button.addEventListener('click', () => addBlock(form, button.dataset.addBlock));
        });

        const existingBlocks = JSON.parse(form.querySelector('.js-existing-blocks').textContent || '[]');
        existingBlocks.forEach((block) => addBlock(form, block.type, block));
    });
</script>
@endpush
