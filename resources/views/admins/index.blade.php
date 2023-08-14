@include('layouts/header')

<div class="container">
    <h2 style="text-align: center; 
                font-family: Arial, sans-serif; 
                font-size: 34px;
                font-weight:bold;
                margin-top:5% ">
     Leave Type List</h2>

     @if($success)
     <div class="alert alert-success">{{ $success }}</div>
     @endif
    <table class="table table-hover" border="2" style="margin-top: 25px;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Leave Type</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->type }}</td>

                <td>
                    <form method="get" action="{{ route('admin.edit',$type) }}">
                        @csrf
                        <button type="submit" name="delete" class="btn btn-primary">Edit</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{ route('admin.destroy',$type) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $type->id }}" />
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form method="get" action="{{ route('admin.create') }}">
              <button type="submit" class="btn btn-dark" >Create Type</button>
    </form>
</div>