@include('layouts.EmployeeHeader')
<div class="container">
    <h2 style="margin-top: 3%;">Create New Request</h2>
    <form method="post" action="{{ route('request.store') }}" style="margin-top:20px" enctype="multipart/form-data">
        @csrf

        <select class="form-select" aria-label="Default select example" name="type" id="type" required>

            <!-- <option value=""></option> -->
            @foreach($types as $type)
            <option value="{{$type->type}}">{{ $type->type}}</option>
            @endforeach
        </select>

        <div class="form-floating mb-3">
            <label for="start_date">Start date</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" name="start_date" id="start_date">
            @error('start_date')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="duration">duration</label>
            <input type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" id="exampleInput1">
            @error('duration')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <label for="document">Document</label>
            <input type="file" name="document" id="document" value="{{ old('document') }}" class="form-control">
        @error('document')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>


       
        <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>