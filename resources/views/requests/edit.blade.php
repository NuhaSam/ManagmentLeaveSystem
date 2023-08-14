@include('layouts.EmployeeHeader')
<div class="container">
    <h2 style="margin-top: 3%;">Update New Employee</h2>
    <form method="post" action="{{ route('request.update',$request->id) }}" style="margin-top:20px" enctype="multipart/form-data">
        @csrf
        @method('put')
        <select class="form-select" aria-label="Default select example" name="type" id="type" required>
           @foreach($types as $type)
            <option value="{{$type->type}}">{{ $request->type}}</option>
            @endforeach
        </select>
        <div class="form-floating mb-3">
            <label for="start_date">Start date</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" value="{{ $request->start_date->format('Y-m-d') }}" name="start_date" id="start_date">
            @error('start_date')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="duration">duration</label>
            <input type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ $request->duration }}" id="exampleInput1">
            @error('duration')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        {{ $request->document }}
        <div class="form-floating mb-3">
            <label for="document">Document</label>
            <input type="file" name="document" id="document" class="form-control">
            @error('document')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        @if($errors->any())
        @foreach($errors as $error)
        <p>{{ $error }}</p>
        @endforeach
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>