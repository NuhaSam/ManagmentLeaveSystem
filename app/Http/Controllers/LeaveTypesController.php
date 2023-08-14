<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveTypesController extends Controller
{
    public function index()
    {
        $types =  LeaveType::all();
        $user = User::find(Auth::id());
        $isAdmin = $user->type;
        $success = session('success');
        return view('admins.index', compact('types', 'success', 'user'));
    }
    public function show()
    {
    }
    public function create()
    {
        return view('admins.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required | string',
        ]);
        LeaveType::create($validated);
        return redirect()
            ->route('admin.index')
            ->with('success', "Type has been added Successfully");
    }
    public function edit(LeaveType $leaveType)
    {

        return view('admins.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $validated = $request->validate([
            'type' => 'required | string',
        ]);
        // $x="";
        //         $oldLeaveType = LeaveRequest::RequestWithOldType($leaveType->type)->get();
        //         // return $oldLeaveType;
        //         foreach($oldLeaveType as $leaveRequest){
        //             $x= 'xxxx';
        //             $leaveRequest->update(['type',$validated]);
        //         }
        $leaveType->update($validated);

        return redirect()
            ->route('admin.index')
            ->with('success', "Type has been updated Successfully");
    }
    public function destroy(Request $request,LeaveType $leaveType)
    {
        LeaveType::destroy($leaveType->id);

        return redirect()
            ->route('admin.index')
            ->with('success', "Type has been deleted Successfully");
    }
}
