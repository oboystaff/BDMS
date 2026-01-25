<?php

namespace App\Http\Controllers\NewStock;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class NewStockController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('new-stocks.index', compact('books'));
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}
}
