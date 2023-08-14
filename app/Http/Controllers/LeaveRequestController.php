<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $employee = User::find($id);
        $leaveRequests = $employee->leaveRequests;
        $success = session('success');
        return view('requests.index', compact('leaveRequests', 'success'));
    }
    public function create()
    {
        $types  = $this->getLeaveTypes();
        return view('requests.create', compact('types'));
    }
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'type' => 'required | exists:leave_types,type',
            'start_date' => 'required | date ',
            'duration' => 'required | integer | min:1',
            'document' => 'required',
        ]);
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $path =  $file->storeAs('empImages', $filename, 'public');
        }
        $validated['status'] = 'submitted';
        $validated['document'] = '/storage//' . $path;
        $validated['user_id'] = Auth::id();
        LeaveRequest::create($validated);
        return redirect()->route('request.index')->with('success', 'Request Submitted');
    }

    public function show($id)
    {
        $request = LeaveRequest::find($id);

        $request->document;
        // $path =  public_path('storage')  . "\\" . $request->document; 
        // return $path;
        // $fileContent =  file_get_contents($path); // Replace with the actual path to your file
        return view('requests.show', ['fileContent' =>  $request->document]);
    }
    public function edit($id)
    {
        $request = LeaveRequest::find($id);
        $types  = $this->getLeaveTypes();
        return view('requests.edit', compact('request', 'types'));
    }
    public function update(Request $request, $id)
    {
        $validated  = $request->validate([
            'type' => 'required | exists:leave_types,type',
            'start_date' => 'required | date',
            'duration' => 'required | integer | min:1',
            'document' => 'required',
        ]);
        $request = LeaveRequest::find($id);
        $request->update($validated);

        return redirect()->route('request.index')->with('success', 'Request Updated Successfully');
    }

    public function destroy($id)
    {
        LeaveRequest::destroy($id);
        return redirect()->route('request.index')->with('success', 'Request deleted successfully');
    }
    public function getLeaveTypes()
    {
        $types = LeaveType::all();
        return $types;
    }
}
