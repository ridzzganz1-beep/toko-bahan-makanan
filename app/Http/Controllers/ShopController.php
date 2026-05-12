<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $featured = Barang::when($search, fn ($query) => $query->where('nama', 'like', "%{$search}%"))
            ->when($category, fn ($query) => $query->where('nama', 'like', "%{$category}%"))
            ->latest()
            ->take(4)
            ->get();

        $popular = Barang::inRandomOrder()->take(4)->get();
        $categories = ['Bumbu', 'Sayur', 'Daging', 'Serealia', 'Minuman'];

        return view('user.dashboard', compact('featured', 'popular', 'categories', 'search', 'category'));
    }

    public function index(Request $request)
    {
        $categories = ['Bumbu', 'Sayur', 'Daging', 'Serealia', 'Minuman'];
        $search = $request->query('search');
        $category = $request->query('category');

        $barangs = Barang::when($search, fn ($query) => $query->where('nama', 'like', "%{$search}%"))
            ->when($category, fn ($query) => $query->where('nama', 'like', "%{$category}%"))
            ->orderBy('nama')
            ->paginate(12)
            ->withQueryString();

        return view('user.products', compact('barangs', 'categories', 'search', 'category'));
    }
}
