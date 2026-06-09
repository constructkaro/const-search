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
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

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
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        if ($blog->title !== $data['title']) {
            $data['slug'] = $this->uniqueSlug($data['title'], $blog->id);
        }

        $data['is_published'] = $request->boolean('is_published');

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

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
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
}
