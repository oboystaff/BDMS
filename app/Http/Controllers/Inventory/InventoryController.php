<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\Book\NewStockBookRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('inventories.index', compact('books'));
    }

    public function create() {}

    public function store() {}

    public function show(Book $book)
    {
        return view('inventories.show', compact('book'));
    }

    public function edit() {}

    public function update() {}

    public function new_stock(Book $book)
    {
        return view('inventories.create', compact('book'));
    }

    public function save_new_stock(NewStockBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $bookData = [
            'quantity' => $data['quantity']
        ];

        $book->update($bookData);

        return redirect()->route('inventories.index')->with('status', 'New stock added successfully.');
    }
}
