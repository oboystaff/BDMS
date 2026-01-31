<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Models\Book;
use App\Models\Level;
use App\Models\Region;
use App\Models\Registration;
use App\Models\Subject;
use App\Models\Territory;
use App\Models\ZonalSalesOfficer;
use App\Models\Zone;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('schools.view')) {
            abort(403, 'Unauthorized action.');
        }

        $schools = Registration::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('region_id', $request->user()->region_id);
            })
            ->when($request->display == "active", function ($query) {
                $query->where('status', 'Active');
            })
            ->when($request->display == "inactive", function ($query) {
                $query->where('status', 'InActive');
            })
            ->where('reg_type', 'school')
            ->get();

        return view('schools.index', compact('schools'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('schools.create')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = Region::orderBy('name', 'ASC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('id', $request->user()->region_id);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $territories = Territory::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Active')
            ->get();

        return view('schools.create', compact('regions', 'regions', 'zones', 'territories', 'zonalSalesOfficers'));
    }

    public function store(CreateSchoolRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['reg_type'] = 'school';

        Registration::create($data);

        return redirect()->route('schools.index')->with('status', 'Schhol created successfully.');
    }

    public function show(Registration $school)
    {
        return view('schools.show', compact('school'));
    }

    public function edit(Request $request, Registration $school)
    {
        if (!auth()->user()->can('schools.update')) {
            abort(403, 'Unauthorized action.');
        }

        $regions = Region::orderBy('name', 'ASC')
            ->when(!empty($request->user()->region_id), function ($query) use ($request) {
                $query->where('id', $request->user()->region_id);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $territories = Territory::orderBy('name', 'ASC')->where('status', 'Active')->get();
        $zonalSalesOfficers = ZonalSalesOfficer::orderBy('name', 'ASC')
            ->when(!empty($request->user()->zso_id), function ($query) use ($request) {
                $query->where('created_by', $request->user()->id);
            })
            ->where('status', 'Active')
            ->get();

        return view('schools.edit', compact('school', 'regions', 'zones', 'territories', 'zonalSalesOfficers'));
    }

    public function update(UpdateSchoolRequest $request, Registration $school)
    {
        $school->update($request->validated());

        return redirect()->route('schools.index')->with('status', 'School record updated successfully.');
    }

    public function make_request(Registration $school)
    {
        $books = Book::orderBy('created_at', 'DESC')->get();

        return view('schools.make_request', compact('school', 'books'));
    }
}
