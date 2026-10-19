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
    .rich-editor-wrap {
        border: 1px solid #d8e0eb;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }
    .rich-editor-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
        padding: 6px 8px;
        border-bottom: 1px solid #e8edf4;
        background: #f8fafc;
    }
    .rich-editor-toolbar button,
    .rich-editor-toolbar select,
    .rich-color-btn,
    .rich-size-control {
        min-height: 42px;
        border: 1px solid #d8e0eb;
        border-radius: 8px;
        background: #fff;
        color: #1c2c3e;
        font-weight: 800;
    }
    .rich-editor-toolbar button,
    .rich-color-btn {
        width: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .rich-color-btn {
        position: relative;
    }
    .rich-editor-toolbar select {
        width: 126px;
        padding: 0 10px;
    }
    .rich-size-control {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 0 9px;
        cursor: text;
    }
    .rich-size-control input {
        width: 42px;
        padding: 0;
        border: 0;
        outline: 0;
        color: #1c2c3e;
        font: inherit;
        font-weight: 800;
        text-align: center;
    }
    .rich-size-control span {
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }
    .rich-color-btn input {
        position: absolute;
        right: 4px;
        bottom: 4px;
        width: 14px;
        height: 14px;
        padding: 0;
        border: 1px solid #cbd5e1;
        border-radius: 3px;
        cursor: pointer;
    }
    .rich-editor {
        height: 420px;
        min-height: 320px;
        max-height: 70vh;
        resize: vertical;
        border: 0;
        border-radius: 0;
        padding: 20px 22px;
        overflow-x: hidden;
        overflow-y: auto;
        line-height: 1.65;
        font-size: 16px;
        overflow-wrap: anywhere;
    }
    .rich-editor p,
    .rich-editor div {
        margin: 0 0 6px;
    }
    .rich-editor ul,
    .rich-editor ol {
        margin: 0 0 6px 18px;
        padding: 0;
    }
    .rich-editor li {
        margin: 0 0 3px;
    }
    .rich-editor img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 10px 0;
        border-radius: 10px;
    }
    .rich-editor:empty::before {
        content: attr(data-placeholder);
        color: #64748b;
    }
    .rich-editor:focus {
        box-shadow: 0 0 0 4px rgba(13, 110, 253, .18);
        outline: none;
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
    function syncRichEditor(wrapper) {
        const editor = wrapper.querySelector('.js-rich-editor');
        const input = wrapper.querySelector('.js-rich-editor-input');
        input.value = editor.innerHTML.trim();
    }

    function applyRichStyle(editor, styles, savedRange = null) {
        editor.focus();
        const selection = window.getSelection();

        if (savedRange && editor.contains(savedRange.commonAncestorContainer)) {
            selection.removeAllRanges();
            selection.addRange(savedRange);
        }

        if (!selection.rangeCount || !editor.contains(selection.anchorNode)) {
            return;
        }

        const range = selection.getRangeAt(0);
        const span = document.createElement('span');
        Object.entries(styles).forEach(([key, value]) => span.style[key] = value);

        if (range.collapsed) {
            span.textContent = '\u200b';
            range.insertNode(span);
            range.setStart(span.firstChild, 1);
            range.collapse(true);
            selection.removeAllRanges();
            selection.addRange(range);
            return;
        }

        span.appendChild(range.extractContents());
        range.insertNode(span);
        range.selectNodeContents(span);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    function restoreRichSelection(editor, savedRange) {
        if (!savedRange || !editor.contains(savedRange.commonAncestorContainer)) {
            return false;
        }

        editor.focus();
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(savedRange);
        return true;
    }

    const richImageUploadUrl = @json(route('admin.blogs.content-image.store'));
    const richImageUploadToken = @json(csrf_token());

    function selectionInsideEditor(editor) {
        const selection = window.getSelection();

        if (!selection.rangeCount) {
            return null;
        }

        const range = selection.getRangeAt(0);
        return editor.contains(range.commonAncestorContainer) ? range.cloneRange() : null;
    }

    function insertRichImage(editor, wrapper, imageUrl, range = null) {
        editor.focus();

        const selection = window.getSelection();
        selection.removeAllRanges();

        if (range) {
            selection.addRange(range);
        }

        const image = document.createElement('img');
        image.src = imageUrl;
        image.alt = '';
        image.loading = 'lazy';

        const spacer = document.createElement('p');
        spacer.appendChild(document.createElement('br'));

        const activeRange = selection.rangeCount ? selection.getRangeAt(0) : document.createRange();

        if (!selection.rangeCount) {
            activeRange.selectNodeContents(editor);
            activeRange.collapse(false);
        }

        activeRange.deleteContents();
        activeRange.insertNode(spacer);
        activeRange.insertNode(image);

        const nextRange = document.createRange();
        nextRange.setStart(spacer, 0);
        nextRange.collapse(true);
        selection.removeAllRanges();
        selection.addRange(nextRange);

        syncRichEditor(wrapper);
    }

    async function uploadRichImage(file) {
        const formData = new FormData();
        formData.append('content_image', file);

        const response = await fetch(richImageUploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': richImageUploadToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        if (!response.ok) {
            throw new Error('Image upload failed.');
        }

        return response.json();
    }

    function initRichEditors() {
        document.querySelectorAll('.js-rich-editor-wrap').forEach((wrapper) => {
            const editor = wrapper.querySelector('.js-rich-editor');
            const form = wrapper.closest('form');
            const imageButton = wrapper.querySelector('[data-rich-image]');
            const imageInput = wrapper.querySelector('[data-rich-image-input]');
            let savedRange = null;

            const rememberSelection = () => {
                savedRange = selectionInsideEditor(editor) || savedRange;
            };

            wrapper.querySelectorAll('.rich-editor-toolbar button, .rich-editor-toolbar select, [data-rich-color], [data-rich-size]').forEach((control) => {
                control.addEventListener('mousedown', () => {
                    savedRange = selectionInsideEditor(editor) || savedRange;
                });
            });

            wrapper.querySelectorAll('button[data-rich-command]').forEach((button) => {
                const runCommand = () => {
                    restoreRichSelection(editor, savedRange);
                    document.execCommand(button.dataset.richCommand, false, null);
                    savedRange = selectionInsideEditor(editor) || savedRange;
                    syncRichEditor(wrapper);
                };

                button.addEventListener('click', () => {
                    runCommand();
                });
            });

            wrapper.querySelector('[data-rich-command="fontName"]').addEventListener('change', (event) => {
                restoreRichSelection(editor, savedRange);
                document.execCommand('fontName', false, event.target.value);
                savedRange = selectionInsideEditor(editor) || savedRange;
                syncRichEditor(wrapper);
            });

            wrapper.querySelector('[data-rich-block]').addEventListener('change', (event) => {
                restoreRichSelection(editor, savedRange);
                document.execCommand('formatBlock', false, event.target.value);
                savedRange = selectionInsideEditor(editor) || savedRange;
                event.target.value = 'P';
                syncRichEditor(wrapper);
            });

            wrapper.querySelector('[data-rich-color]').addEventListener('input', (event) => {
                applyRichStyle(editor, { color: event.target.value }, savedRange);
                savedRange = selectionInsideEditor(editor) || savedRange;
                syncRichEditor(wrapper);
            });

            wrapper.querySelector('[data-rich-size]').addEventListener('input', (event) => {
                const size = Number(event.target.value);
                if (Number.isFinite(size) && size >= 8 && size <= 96) {
                    applyRichStyle(editor, { fontSize: `${size}px` }, savedRange);
                    savedRange = selectionInsideEditor(editor) || savedRange;
                    syncRichEditor(wrapper);
                }
            });

            imageButton.addEventListener('click', () => {
                savedRange = selectionInsideEditor(editor) || savedRange;
                imageInput.click();
            });

            imageInput.addEventListener('change', async (event) => {
                const file = event.target.files[0];

                if (!file) {
                    return;
                }

                imageButton.disabled = true;

                try {
                    const result = await uploadRichImage(file);
                    insertRichImage(editor, wrapper, result.url, savedRange);
                } catch (error) {
                    alert('Image upload failed. Please try another JPG, PNG or WebP image.');
                } finally {
                    imageButton.disabled = false;
                    imageInput.value = '';
                }
            });

            editor.addEventListener('input', () => syncRichEditor(wrapper));
            editor.addEventListener('keyup', rememberSelection);
            editor.addEventListener('mouseup', rememberSelection);
            editor.addEventListener('blur', rememberSelection);
            form.addEventListener('submit', () => syncRichEditor(wrapper));
            syncRichEditor(wrapper);
        });
    }

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
        const imageSize = ['small', 'medium', 'large', 'full'].includes(block.image_size) ? block.image_size : 'full';
        const imagePosition = ['left', 'right'].includes(block.image_position) ? block.image_position : 'left';
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
                     <div class="col-md-5"><label class="form-label">Image Alt Text</label><input type="text" name="${name('image_alt')}" class="form-control" value="${value('image_alt')}"></div>
                     <div class="col-md-3">
                        <label class="form-label">Image Size</label>
                        <select name="${name('image_size')}" class="form-control">
                            <option value="full" ${imageSize === 'full' ? 'selected' : ''}>Full Width</option>
                            <option value="large" ${imageSize === 'large' ? 'selected' : ''}>Large</option>
                            <option value="medium" ${imageSize === 'medium' ? 'selected' : ''}>Medium</option>
                            <option value="small" ${imageSize === 'small' ? 'selected' : ''}>Small</option>
                        </select>
                     </div>`;
        }

        if (type === 'image_text') {
            html += `<div class="col-md-4">
                        <label class="form-label">Image Position</label>
                        <select name="${name('image_position')}" class="form-control">
                            <option value="left" ${imagePosition === 'left' ? 'selected' : ''}>Image Left</option>
                            <option value="right" ${imagePosition === 'right' ? 'selected' : ''}>Image Right</option>
                        </select>
                    </div>`;
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

    initRichEditors();
</script>
@endpush
