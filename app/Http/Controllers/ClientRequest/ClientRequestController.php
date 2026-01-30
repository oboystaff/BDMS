<?php

namespace App\Http\Controllers\ClientRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest\CreateClientRequest;
use App\Http\Requests\ClientRequest\UpdateClientRequest;
use App\Models\Book;
use App\Models\ClientRequest;
use App\Models\Registration;
use Illuminate\Http\Request;
use Spatie\FlareClient\Http\Client;

class ClientRequestController extends Controller
{
    public function index()
    {
        $clientRequests = ClientRequest::orderBy('created_at', 'DESC')->get();

        return view('client-requests.index', compact('clientRequests'));
    }

    public function create(Request $request, Book $book)
    {
        $clients = Registration::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('region_id', $request->user()->region_id);
            })
            ->select('reg_id', 'name')
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->reg_id,
                    'name' => $client->name . " - " . $client->reg_id,
                ];
            });

        return view('client-requests.create', compact('book', 'clients'));
    }

    public function store(CreateClientRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['status'] = 'Pending';

        $pendingRequest = ClientRequest::where('client_id', $data['client_id'])
            ->where('book_id', $data['book_id'])
            ->where('status', 'Pending')
            ->first();

        if (!empty($pendingRequest)) {
            return redirect()->route('client-requests.index')->with('error', 'You already have pending request for the selected book, contact the admin.');
        }

        ClientRequest::create($data);

        return redirect()->route('client-requests.index')->with('status', 'Book request created successfully.');
    }

    public function show(ClientRequest $clientRequest)
    {
        return view('client-requests.show', compact('clientRequest'));
    }

    public function edit(Request $request, ClientRequest $clientRequest)
    {
        $clients = Registration::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('region_id', $request->user()->region_id);
            })
            ->select('reg_id', 'name')
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->reg_id,
                    'name' => $client->name . " - " . $client->reg_id,
                ];
            });

        return view('client-requests.edit', compact('clientRequest', 'clients'));
    }

    public function update(UpdateClientRequest $request, ClientRequest $clientRequest)
    {
        $clientRequest->update($request->validated());

        return redirect()->route('client-requests.index')->with('status', 'Book request updated successfully.');
    }

    public function book_request()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('client-requests.book', compact('books'));
    }
}
