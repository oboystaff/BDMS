<?php

namespace App\Http\Controllers\Level;

use App\Http\Controllers\Controller;
use App\Http\Requests\Level\CreateLevelRequest;
use App\Http\Requests\Level\UpdateLevelRequest;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('levels.view')) {
            abort(403, 'Unauthorized action.');
        }

        $levels = Level::orderBy('created_at', 'DESC')->get();

        return view('levels.index', compact('levels'));
    }

    public function create()
    {
        if (!auth()->user()->can('levels.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('levels.create');
    }

    public function store(CreateLevelRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        Level::create($data);

        return redirect()->route('levels.index')->with('status', 'Level created successfully.');
    }

    public function show(Level $level)
    {
        return view('levels.show', compact('level'));
    }

    public function edit(Level $level)
    {
        if (!auth()->user()->can('levels.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('levels.edit', compact('level'));
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->validated());

        return redirect()->route('levels.index')->with('status', 'Level updated successfully.');
    }
}
