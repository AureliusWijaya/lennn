<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function advancedSearch(Request $request)
    {
        $query = $request->input('keyword');
        $categoryId = $request->input('category');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $sortOrder = $request->input('sort_order');

        // Build your query
        $results = product::query()
            ->when($query, fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($dateFrom, fn($q) => $q->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('created_at', '<=', $dateTo))
            ->when($sortOrder, function ($q) use ($sortOrder) {
                if ($sortOrder === 'asc' || $sortOrder === 'desc') {
                    $q->orderBy('title', $sortOrder);
                }
            })
            ->get();

        return view('search', compact('results'));
    }

}
