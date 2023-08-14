<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    public function index()
    {
        $employees = User::employee()->get(); // employee() is local scope
        $success = session('success');
        return view('employees.index', compact('employees', 'success'));
    }
    public function show()
    {
        $success = session('success');
        $id = Auth::id();
        $employee = User::find($id);
        $empName = $employee->name;

        $leaveRequests = LeaveRequest::where('status', 'submitted')->get();
        return view('requests.manageRequest', compact('leaveRequests', 'success', 'empName', 'employee'));
    }

    public function accept(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'accepted',
        ]);

        return redirect(route('employee.show', Auth::id()))->with('success', 'Leave request accepted.');
    }
    public function reject(Request $request, LeaveRequest $leaveRequest)
    {
        $this->validate($request, [
            'reason' => 'required|string|max:255',
        ]);

        $reason =  $request->input('reason');
        $leaveRequest->update([
            'status' => 'rejected',
            'reason' => $reason,
        ]);

        return redirect(route('employee.show', Auth::id()))->with('success', 'Leave request rejected.');
    }

    public function create()
    {
        return view('employees.create');
    }
    public function store(EmployeeRequest $request, User $employee)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make('password');
        $validated['image'] = $request->image;
        User::create($validated);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee has been created successfully');
    }
    public function edit(User $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    public function update(EmployeeRequest $request, User $employee)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make('password');

        $employee->update($validated);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee has been Updated successfully');
    }
    public function destroy(User $employee)
    {
        User::destroy($employee->id);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Employee has been deleted successfully');
    }
}
