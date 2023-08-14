@include('layouts.header')

<div class="container">
    <h2 style="text-align: center; 
                font-family: Arial, sans-serif; 
                font-size: 34px;
                font-weight:bold;
                margin-top:5% ">
     Employee List</h2>

     @if($success)
     <div class="alert alert-success">{{ $success }}</div>
     @endif
    <table class="table table-hover" border="2" style="margin-top: 25px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Department</th>
                <th scope="col">Gender</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <th scope="row">{{ $employee->id }}</th>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->gender }}</td>
                <td>
                    <form method="get" action="{{ route('employee.edit',$employee) }}">
                        @csrf
                        <button type="submit" name="delete" class="btn btn-primary">Edit</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{ route('employee.destroy',$employee) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form method="get" action="{{ route('employee.create') }}">
              <button type="submit" class="btn btn-dark" >Create Employee</button>
    </form>
</div>