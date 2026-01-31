<?php

namespace App\Http\Controllers\ClientRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest\CreateClientRequest;
use App\Http\Requests\ClientRequest\UpdateClientRequest;
use App\Models\Book;
use App\Models\ClientRequest;
use App\Models\Registration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ClientRequestController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('requests.view')) {
            abort(403, 'Unauthorized action.');
        }

        $clientRequests = ClientRequest::orderBy('created_at', 'DESC')
            ->when($request->display == "pending", function ($query) {
                $query->where('status', 'Pending');
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereYear('created_at', Carbon::now()->year);
            })
            ->get();

        return view('client-requests.index', compact('clientRequests'));
    }

    public function create(Request $request, Book $book)
    {
        if (!auth()->user()->can('requests.create')) {
            abort(403, 'Unauthorized action.');
        }

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

    public function store(Request $request)
    {
        $preview = session('request_preview');

        if (!$preview) {
            return redirect()->route('schools.index')
                ->withErrors('Session expired. Please try again.');
        }

        $requestId = $this->generateRequestId();

        DB::transaction(function () use ($preview, $request, $requestId) {
            $draftRequest = ClientRequest::where('client_id', $preview['client_id'])
                ->whereNull('book_id')
                ->whereNull('subject_id')
                ->whereNull('level_id')
                ->whereNull('unit_price')
                ->whereNull('quantity')
                ->first();

            $requestId = $draftRequest
                ? $draftRequest->request_id
                : $this->generateRequestId();

            if ($draftRequest) {
                ClientRequest::where('request_id', $requestId)->delete();
            }

            foreach ($preview['items'] as $item) {
                ClientRequest::create([
                    'request_id' => $requestId,
                    'client_id'  => $preview['client_id'],
                    'book_id'    => $item['book_id'],
                    'subject_id' => $item['subject_id'],
                    'level_id'   => $item['level_id'],
                    'unit_price' => $item['unit_price'],
                    'quantity'   => $item['quantity'],
                    'amount'     => $item['amount'],
                    'status'     => 'Pending',
                    'created_by' => $request->user()->id
                ]);
            }
        });

        session()->forget('request_preview');

        return redirect()->route('client-requests.index')->with('status', 'Book request submitted successfully.');
    }

    public function show(ClientRequest $clientRequest)
    {
        return view('client-requests.show', compact('clientRequest'));
    }

    public function edit(Request $request, ClientRequest $clientRequest)
    {
        if (!auth()->user()->can('requests.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (
            is_null($clientRequest->book_id) &&
            is_null($clientRequest->subject_id) &&
            is_null($clientRequest->level_id)
        ) {
            $client = Registration::where('reg_id', $clientRequest->client_id)->first();
            return redirect()->route('client-requests.make_book_request', $client);
        }

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

    public function make_request(Registration $client)
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('client-requests.make_request', compact('client', 'books'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'books' => 'required|array',
        ]);

        $selectedBooks = collect($request->books)
            ->filter(fn($book) => isset($book['selected']) && !empty($book['quantity']));

        if ($selectedBooks->isEmpty()) {
            return back()->withErrors('Please select at least one book with quantity.');
        }

        $items = [];
        $grandTotal = 0;

        foreach ($selectedBooks as $bookId => $data) {
            $book = Book::with(['subject', 'level'])->findOrFail($bookId);

            $quantity = (int) $data['quantity'];

            if ($quantity > $book->quantity) {
                return back()->withErrors(
                    "Requested quantity for {$book->subject->name} ({$book->level->name}) exceeds available stock ({$book->quantity})."
                );
            }

            $amount = $book->unit_price * $quantity;

            $items[] = [
                'book_id'    => $book->book_id,
                'subject_id' => $book->subject_id,
                'level_id'   => $book->level_id,
                'subject'    => $book->subject->name,
                'level'      => $book->level->name,
                'author'     => $book->author,
                'unit_price' => $book->unit_price,
                'quantity'   => $quantity,
                'amount'     => $amount,
            ];

            $grandTotal += $amount;
        }

        // Store in session for final submission
        session([
            'request_preview' => [
                'client_id' => $request->client_id,
                'items' => $items,
                'grand_total' => $grandTotal,
            ]
        ]);

        return view('client-requests.preview', compact('items', 'grandTotal'));
    }

    private function generateRequestId()
    {
        do {
            $requestId = rand(10000000, 99999999);
        } while (ClientRequest::where('request_id', $requestId)->exists());

        return $requestId;
    }
}
