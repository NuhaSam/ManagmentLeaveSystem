@include('layouts.header',[$employee])
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
                <th scope="col">Employee Name</th>
                <th scope="col">Type</th>
                <th scope="col">Start date</th>
                <th scope="col">Duration</th>
                <th scope="col">Document</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($leaveRequests as $request)
            <tr>
                <th scope="row">{{ $request->id }}</th>
                <td>{{ $empName }}</td>
                <td>{{ $request->type }}</td>
                <td>{{ $request->start_date }}</td>
                <td>{{ $request->duration }}</td>
                <td> <a href="{{ route('request.show',$request->id) }}">View Document</a></td>
                <td>
                    <form action="{{ route('admin.accept',$request)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-success">Accept</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.reject',$request)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('put')
                        <input class="form-control me-2" name="reason" id="reason" type="text" placeholder="reject reason">
                        @error('reason') 
                        <p> {{ $message }} </p>
                        @enderror
                        <!-- <input type="text" name="reason" placeholder="Reason for rejection"> -->
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>