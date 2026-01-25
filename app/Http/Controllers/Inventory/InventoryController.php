<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Book;
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

    public function show() {}

    public function edit() {}

    public function update() {}
}
