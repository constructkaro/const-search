@php
    $contentValue = old('content', $blog->content ?? '');
    $editorContent = session()->hasOldInput('content') ? e($contentValue) : $contentValue;
    $blockPayload = collect($blocks)->map(function ($block) {
        if (! empty($block['image'])) {
            $block['image_url'] = \Illuminate\Support\Facades\Storage::disk('public')->url($block['image']);
        }

        return $block;
    })->values();
@endphp

<div class="col-md-6">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" class="form-control" required>
</div>
<div class="col-md-3">
    <label class="form-label">Published Date</label>
    <input type="date" name="published_at" value="{{ old('published_at', optional($blog?->published_at)->format('Y-m-d')) }}" class="form-control">
</div>
<div class="col-md-3">
    <label class="form-label">Blog Card Image</label>
    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    <small class="text-muted">Shown on Blogs / Articles listing.</small>
</div>
<div class="col-md-3">
    <label class="form-label">Heading Image</label>
    <input type="file" name="hero_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    <small class="text-muted">Shown at top of detail page.</small>
</div>
<div class="col-md-3">
    <label class="form-label">Heading Image Size</label>
    <select name="hero_image_height" class="form-control">
        @php($heroHeight = old('hero_image_height', $blog->hero_image_height ?? 'medium'))
        <option value="small" {{ $heroHeight === 'small' ? 'selected' : '' }}>Small</option>
        <option value="medium" {{ $heroHeight === 'medium' ? 'selected' : '' }}>Medium</option>
        <option value="large" {{ $heroHeight === 'large' ? 'selected' : '' }}>Large</option>
    </select>
</div>
<div class="col-md-3">
    <label class="form-label">Heading Image Fit</label>
    <select name="hero_image_fit" class="form-control">
        @php($heroFit = old('hero_image_fit', $blog->hero_image_fit ?? 'cover'))
        <option value="cover" {{ $heroFit === 'cover' ? 'selected' : '' }}>Fill Area</option>
        <option value="contain" {{ $heroFit === 'contain' ? 'selected' : '' }}>Show Full Image</option>
    </select>
</div>
<div class="col-md-12">
    <label class="form-label">Short Description</label>
    <input type="text" name="excerpt" value="{{ old('excerpt', $blog->excerpt ?? '') }}" class="form-control" maxlength="500">
</div>
<div class="col-md-12">
    <label class="form-label">Main Content</label>
    <div class="rich-editor-wrap js-rich-editor-wrap">
        <div class="rich-editor-toolbar" aria-label="Main content formatting tools">
            <button type="button" data-rich-command="bold" title="Bold"><i class="bi bi-type-bold"></i></button>
            <button type="button" data-rich-command="italic" title="Italic"><i class="bi bi-type-italic"></i></button>
            <button type="button" data-rich-command="underline" title="Underline"><i class="bi bi-type-underline"></i></button>
            <label class="rich-color-btn" title="Text color">
                <i class="bi bi-palette"></i>
                <input type="color" data-rich-color value="#f37021">
            </label>
            <select data-rich-size title="Font size">
                <option value="">Size</option>
                <option value="14px">Small</option>
                <option value="16px">Normal</option>
                <option value="20px">Large</option>
                <option value="26px">Heading</option>
            </select>
            <button type="button" data-rich-command="insertUnorderedList" title="Bullet list"><i class="bi bi-list-ul"></i></button>
            <button type="button" data-rich-command="insertOrderedList" title="Number list"><i class="bi bi-list-ol"></i></button>
        </div>
        <div class="rich-editor form-control js-rich-editor" contenteditable="true" data-placeholder="Use this for formatted text. Use blocks below for images, FAQs and page sections.">{!! $editorContent !!}</div>
        <textarea name="content" class="js-rich-editor-input d-none">{{ $contentValue }}</textarea>
    </div>
</div>
<div class="col-md-12">
    <label class="form-label fw-bold">Page Details / Flexible Sections</label>
    <div class="block-toolbar">
        <button type="button" data-add-block="heading"><i class="bi bi-type-h2"></i> Heading</button>
        <button type="button" data-add-block="text"><i class="bi bi-text-paragraph"></i> Text</button>
        <button type="button" data-add-block="image"><i class="bi bi-image"></i> Image</button>
        <button type="button" data-add-block="image_text"><i class="bi bi-layout-text-window"></i> Image + Text</button>
        <button type="button" data-add-block="faq"><i class="bi bi-question-circle"></i> FAQ</button>
        <button type="button" data-add-block="cta"><i class="bi bi-cursor-fill"></i> Button</button>
    </div>
    <div class="js-blocks-container" data-next-index="0"></div>
    <script type="application/json" class="js-existing-blocks">@json($blockPayload)</script>
</div>
<div class="col-md-3">
    <label class="form-label d-block">Status</label>
    <label class="form-check">
        <input type="checkbox" name="is_published" value="1" class="form-check-input" {{ old('is_published', $blog->is_published ?? true) ? 'checked' : '' }}>
        <span class="form-check-label">Published</span>
    </label>
</div>
