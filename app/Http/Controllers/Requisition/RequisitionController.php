<?php

namespace App\Http\Controllers\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookRequisition;
use App\Models\Subject;
use App\Models\Level;
use App\Models\ZonalSalesOfficer;
use Illuminate\Http\Request;


class RequisitionController extends Controller
{
    public function index()
    {
        $requisitions = BookRequisition::orderBy('created_at', 'DESC')->get();

        return view('requisitions.index', compact('requisitions'));
    }

    public function create(Request $request, Book $book)
    {
        $subjects = Subject::orderBy('name', 'ASC')->get();
        $levels = Level::orderBy('name', 'ASC')->get();
        $user = $request->user();

        $zonalSalesOfficer = ZonalSalesOfficer::where('id', $user->zso_id)->first();

        return view('requisitions.create', compact('subjects', 'levels', 'book'));
    }

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}

    public function index_book()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('requisitions.index_book', compact('books'));
    }
}
