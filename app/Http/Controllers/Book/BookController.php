<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\NewStockBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name', 'ASC')->get();
        $levels = Level::orderBy('name', 'ASC')->get();

        return view('books.create', compact('subjects', 'levels'));
    }

    public function store(CreateBookRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $message = '';

        $book = Book::where('subject_id', $data['subject_id'])
            ->where('level_id', $data['level_id'])
            ->first();

        if (empty($book)) {
            $message = 'Book created successfully.';
            Book::create($data);
        } else {
            $message = 'Book updated successfully.';
            $totalQuantity = (float) $book->quantity + (float) $data['quantity'];
            $bookData = [
                'unit_price' => $data['unit_price'],
                'quantity' => $totalQuantity ?? 0,
                'minimum_stock_level' => $data['minimum_stock_level']
            ];

            $book->update($bookData);
        }

        return redirect()->route('books.index')->with('status', $message);
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $subjects = Subject::orderBy('name', 'ASC')->get();
        $levels = Level::orderBy('name', 'ASC')->get();

        return view('books.edit', compact('book', 'subjects', 'levels'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('books.index')->with('status', 'Book updated successfully.');
    }

    public function new_stock(Book $book)
    {
        return view('books.new_stock', compact('book'));
    }

    public function save_new_stock(NewStockBookRequest $request, Book $book)
    {
        $data = $request->validated();

        $bookData = [
            'quantity' => $data['quantity']
        ];

        $book->update($bookData);

        return redirect()->route('books.index')->with('status', 'New stock added successfully.');
    }
}
