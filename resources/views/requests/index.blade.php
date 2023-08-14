@include('layouts.EmployeeHeader')
<!-- Employee -->

<div class="container">
    <h2 style="text-align: center; 
                font-family: Arial, sans-serif; 
                font-size: 34px;
                font-weight:bold;
                margin-top:5% ">
     Leave Request List</h2>

     @if($success)
     <div class="alert alert-success">{{ $success }}</div>
     @endif
    <table class="table table-hover" border="2" style="margin-top: 25px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Start date</th>
                <th scope="col">Duration</th>
                <th scope="col">Document</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($leaveRequests as $request)
            <tr>
                <th scope="row">{{ $request->id }}</th>
                <td>{{ $request->type }}</td>
                <td>{{ $request->start_date }}</td>
                <td>{{ $request->duration }}</td>
                <td> <a href="{{ route('request.show',$request->id) }}">View Document</a></td>
                <td>{{ $request->status }}</td>      
                          <td>
                    <form method="get" action="{{ route('request.edit',$request->id) }}">
                        @csrf
                        <button type="submit" name="delete" class="btn btn-primary">Edit</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{ route('request.destroy',$request->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
    <form method="get" action="{{ route('request.create') }}">
              <button type="submit" class="btn btn-dark" >Create Leave Request</button>
    </form>
</div>