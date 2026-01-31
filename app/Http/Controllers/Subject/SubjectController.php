<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\CreateSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('subjects.view')) {
            abort(403, 'Unauthorized action.');
        }

        $subjects = Subject::orderBy('created_at', 'DESC')->get();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        if (!auth()->user()->can('subjects.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('subjects.create');
    }

    public function store(CreateSubjectRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        Subject::create($data);

        return redirect()->route('subjects.index')->with('status', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        if (!auth()->user()->can('subjects.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index')->with('status', 'Subject updated successfully.');
    }
}
