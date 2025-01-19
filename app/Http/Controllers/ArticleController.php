<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //
    public function index()
    {
        return view('create');
    }
    public function showAll()
    {
        $articles = Article::all();
        return view('welcome', compact('articles'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'required|mimes:jpeg,png',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);
        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imageName,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home')->with('success', 'Article uploaded successfully');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg',
        ]);

        $article = Article::findOrFail($id);


        $article->title = $validated['title'];
        $article->content = $validated['content'];


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // ini save di public/images
            // kalo folder images blm kebuat auto kebuat
            if ($article->image && file_exists(public_path('images/' . $article->image))) {
                unlink(public_path('images/' . $article->image));
            }

            $article->image = $imageName;
        }

        $article->save();

        return redirect()->route('home')->with('success', 'Article updated successfully');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        if ($article->image && file_exists(public_path('images/' . $article->image))) {
            unlink(public_path('images/' . $article->image));
        }
        $article->delete();
        return redirect()->route('home')->with('success', 'Article deleted successfully');
    }

}
