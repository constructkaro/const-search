<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConstructionEducationPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConstructionEducationPostController extends Controller
{
    public function index()
    {
        $posts = ConstructionEducationPost::orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view('admin.construction-education-posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'instagram_url' => 'required|url|max:500',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'nullable|boolean',
        ]);

        $data['image'] = $request->file('image')->store('construction-education', 'public');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = $request->boolean('is_published');

        ConstructionEducationPost::create($data);

        return redirect()->route('admin.construction-education-posts.index')
            ->with('success', 'Construction education post added successfully.');
    }

    public function update(Request $request, ConstructionEducationPost $constructionEducationPost)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'instagram_url' => 'required|url|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($constructionEducationPost->image);
            $data['image'] = $request->file('image')->store('construction-education', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = $request->boolean('is_published');

        $constructionEducationPost->update($data);

        return redirect()->route('admin.construction-education-posts.index')
            ->with('success', 'Construction education post updated successfully.');
    }

    public function destroy(ConstructionEducationPost $constructionEducationPost)
    {
        Storage::disk('public')->delete($constructionEducationPost->image);
        $constructionEducationPost->delete();

        return redirect()->route('admin.construction-education-posts.index')
            ->with('success', 'Construction education post deleted successfully.');
    }
}
