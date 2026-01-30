<?php

namespace App\Http\Controllers\NewStock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\NewStockBookRequest;
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

    public function show(Book $book)
    {
        return view('new-stocks.show', compact('book'));
    }

    public function edit() {}

    public function update() {}

    public function new_stock(Book $book)
    {
        return view('new-stocks.create', compact('book'));
    }

    public function save_new_stock(NewStockBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $bookData = [
            'quantity' => $data['quantity']
        ];

        $book->update($bookData);

        return redirect()->route('new-stocks.index')->with('status', 'New stock added successfully.');
    }
}
