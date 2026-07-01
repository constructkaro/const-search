<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hero_image_fit' => 'nullable|in:cover,contain',
            'hero_image_height' => 'nullable|in:small,medium,large',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'blocks' => 'nullable|array',
            'blocks.*.type' => 'nullable|in:heading,text,image,image_text,faq,cta',
            'blocks.*.heading' => 'nullable|string|max:255',
            'blocks.*.body' => 'nullable|string',
            'blocks.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'blocks.*.image_size' => 'nullable|in:small,medium,large,full',
            'blocks.*.image_position' => 'nullable|in:left,right',
            'blocks.*.image_alt' => 'nullable|string|max:255',
            'blocks.*.question' => 'nullable|string|max:255',
            'blocks.*.answer' => 'nullable|string',
            'blocks.*.button_text' => 'nullable|string|max:120',
            'blocks.*.button_url' => 'nullable|string|max:500',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['content'] = $this->cleanRichText($data['content'] ?? '');
        $data['hero_image_fit'] = $data['hero_image_fit'] ?? 'cover';
        $data['hero_image_height'] = $data['hero_image_height'] ?? 'medium';
        $data['is_published'] = $request->boolean('is_published');
        $data['content_blocks'] = $this->prepareBlocks($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog added successfully.');
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'hero_image_fit' => 'nullable|in:cover,contain',
            'hero_image_height' => 'nullable|in:small,medium,large',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'blocks' => 'nullable|array',
            'blocks.*.type' => 'nullable|in:heading,text,image,image_text,faq,cta',
            'blocks.*.heading' => 'nullable|string|max:255',
            'blocks.*.body' => 'nullable|string',
            'blocks.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'blocks.*.existing_image' => 'nullable|string|max:500',
            'blocks.*.image_size' => 'nullable|in:small,medium,large,full',
            'blocks.*.image_position' => 'nullable|in:left,right',
            'blocks.*.image_alt' => 'nullable|string|max:255',
            'blocks.*.question' => 'nullable|string|max:255',
            'blocks.*.answer' => 'nullable|string',
            'blocks.*.button_text' => 'nullable|string|max:120',
            'blocks.*.button_url' => 'nullable|string|max:500',
        ]);

        if ($blog->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $blog->id);
        }

        $data['content'] = $this->cleanRichText($data['content'] ?? '');
        $data['hero_image_fit'] = $data['hero_image_fit'] ?? 'cover';
        $data['hero_image_height'] = $data['hero_image_height'] ?? 'medium';
        $data['is_published'] = $request->boolean('is_published');
        $data['content_blocks'] = $this->prepareBlocks($request, $blog);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        if ($request->hasFile('hero_image')) {
            if ($blog->hero_image) {
                Storage::disk('public')->delete($blog->hero_image);
            }

            $data['hero_image'] = $request->file('hero_image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        if ($blog->hero_image) {
            Storage::disk('public')->delete($blog->hero_image);
        }

        $this->deleteBlockImages($blog->content_blocks ?? []);

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function uploadContentImage(Request $request)
    {
        $data = $request->validate([
            'content_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $path = $data['content_image']->store('blogs/content', 'public');

        return response()->json([
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $count = 1;

        while (Blog::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug.'-'.$count;
            $count++;
        }

        return $slug;
    }

    private function prepareBlocks(Request $request, ?Blog $blog = null): array
    {
        $blocks = [];
        $keptImages = [];

        foreach ($request->input('blocks', []) as $index => $block) {
            $type = $block['type'] ?? null;

            if (! in_array($type, ['heading', 'text', 'image', 'image_text', 'faq', 'cta'], true)) {
                continue;
            }

            $imagePosition = $block['image_position'] ?? 'left';
            $imageSize = $block['image_size'] ?? 'full';

            $prepared = [
                'type' => $type,
                'heading' => trim($block['heading'] ?? ''),
                'body' => trim($block['body'] ?? ''),
                'image_size' => in_array($imageSize, ['small', 'medium', 'large', 'full'], true) ? $imageSize : 'full',
                'image_position' => in_array($imagePosition, ['left', 'right'], true) ? $imagePosition : 'left',
                'image_alt' => trim($block['image_alt'] ?? ''),
                'question' => trim($block['question'] ?? ''),
                'answer' => trim($block['answer'] ?? ''),
                'button_text' => trim($block['button_text'] ?? ''),
                'button_url' => trim($block['button_url'] ?? ''),
            ];

            $existingImage = $block['existing_image'] ?? null;

            if ($request->hasFile("blocks.$index.image")) {
                $prepared['image'] = $request->file("blocks.$index.image")->store('blogs/content', 'public');
            } elseif ($existingImage) {
                $prepared['image'] = $existingImage;
                $keptImages[] = $existingImage;
            }

            if (! $this->blockHasContent($prepared)) {
                if (! empty($prepared['image']) && ! in_array($prepared['image'], $keptImages, true)) {
                    Storage::disk('public')->delete($prepared['image']);
                }

                continue;
            }

            $blocks[] = $prepared;
        }

        if ($blog) {
            $newImages = collect($blocks)->pluck('image')->filter()->all();

            foreach ($blog->content_blocks ?? [] as $oldBlock) {
                $oldImage = $oldBlock['image'] ?? null;

                if ($oldImage && ! in_array($oldImage, $newImages, true)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }

        return $blocks;
    }

    private function blockHasContent(array $block): bool
    {
        foreach (['heading', 'body', 'image', 'question', 'answer', 'button_text'] as $field) {
            if (! empty($block[$field])) {
                return true;
            }
        }

        return false;
    }

    private function cleanRichText(string $html): string
    {
        $html = trim($html);

        if ($html === '') {
            return '';
        }

        $allowedTags = '<p><div><br><strong><b><em><i><u><span><ul><ol><li><h2><h3><h4><a><img>';
        $html = strip_tags($html, $allowedTags);

        if (! class_exists(\DOMDocument::class)) {
            return $html;
        }

        $document = new \DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="UTF-8"><div>'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        $this->cleanRichTextNode($document->documentElement);

        $output = '';
        foreach ($document->documentElement->childNodes as $child) {
            $output .= $document->saveHTML($child);
        }

        return trim($output);
    }

    private function cleanRichTextNode(\DOMNode $node): void
    {
        if ($node instanceof \DOMElement) {
            $allowedAttributes = $node->tagName === 'a' ? ['href', 'target', 'rel'] : [];

            if ($node->tagName === 'span') {
                $allowedAttributes[] = 'style';
            }

            if ($node->tagName === 'img') {
                $allowedAttributes = ['src', 'alt', 'loading'];
            }

            foreach (iterator_to_array($node->attributes) as $attribute) {
                if (! in_array($attribute->name, $allowedAttributes, true)) {
                    $node->removeAttribute($attribute->name);
                }
            }

            if ($node->tagName === 'span' && $node->hasAttribute('style')) {
                $style = $this->cleanRichTextStyle($node->getAttribute('style'));

                if ($style === '') {
                    $node->removeAttribute('style');
                } else {
                    $node->setAttribute('style', $style);
                }
            }

            if ($node->tagName === 'a') {
                $href = $node->getAttribute('href');

                if (! preg_match('/^(https?:\/\/|mailto:|tel:|\/|#)/i', $href)) {
                    $node->removeAttribute('href');
                }

                $node->setAttribute('rel', 'noopener');
            }

            if ($node->tagName === 'img') {
                $src = $node->getAttribute('src');

                if (! preg_match('/^(https?:\/\/|\/storage\/|storage\/)/i', $src)) {
                    $node->parentNode?->removeChild($node);
                    return;
                }

                $node->setAttribute('loading', 'lazy');
            }
        }

        foreach (iterator_to_array($node->childNodes) as $child) {
            $this->cleanRichTextNode($child);
        }
    }

    private function cleanRichTextStyle(string $style): string
    {
        $safe = [];

        foreach (explode(';', $style) as $rule) {
            [$property, $value] = array_pad(explode(':', $rule, 2), 2, '');
            $property = strtolower(trim($property));
            $value = trim($value);

            if ($property === 'color' && preg_match('/^(#[0-9a-f]{3,6}|rgb\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}\s*\))$/i', $value)) {
                $safe[] = 'color: '.$value;
            }

            if ($property === 'font-size' && preg_match('/^(14|16|20|26)px$/', $value)) {
                $safe[] = 'font-size: '.$value;
            }
        }

        return implode('; ', $safe);
    }

    private function deleteBlockImages(array $blocks): void
    {
        foreach ($blocks as $block) {
            if (! empty($block['image'])) {
                Storage::disk('public')->delete($block['image']);
            }
        }
    }
}
