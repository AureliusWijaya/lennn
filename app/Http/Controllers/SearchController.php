<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function advancedSearch(Request $request)
{
    $query = $request->input('keyword');
    $category = $request->input('category');
    $dateFrom = $request->input('date_from');
    $dateTo   = $request->input('date_to');
    $sortOrder = $request->input('sort_order');

    // Build your query
    $results = Article::query()
        ->when($query, fn($q) => $q->where('title', 'like', "%{$query}%"))
        ->when($category, fn($q) => $q->where('category', $category))
        ->when($dateFrom, fn($q) => $q->whereDate('created_at', '>=', $dateFrom))
        ->when($dateTo, fn($q) => $q->whereDate('created_at', '<=', $dateTo))
        ->when($sortOrder, function($q) use($sortOrder) {
            if ($sortOrder === 'asc' || $sortOrder === 'desc') {
                $q->orderBy('title', $sortOrder);
            }
        })
        ->get();

    return view('search', compact('results'));
}

}
