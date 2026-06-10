@php
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
<div class="col-md-12">
    <label class="form-label">Short Description</label>
    <input type="text" name="excerpt" value="{{ old('excerpt', $blog->excerpt ?? '') }}" class="form-control" maxlength="500">
</div>
<div class="col-md-12">
    <label class="form-label">Main Content</label>
    <textarea name="content" class="form-control" rows="5" placeholder="Use this for simple text. Use blocks below for images, FAQs and page sections.">{{ old('content', $blog->content ?? '') }}</textarea>
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
