@include('layouts/header')
<div class="container">
    <h2 style="margin-top: 3%;">Update New Employee</h2>
    <form method="post" action="{{ route('employee.update',$employee) }}" style="margin-top:20px">
        @csrf
        @method('put')
        <div class="form-floating mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $employee->name }}" name="name" id="name" placeholder="employee name">
            @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="name">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->email }}" id="exampleInputEmail1">
            @error('email')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <label for="department">Department</label>
            <input type="text" class="form-control @error('department') is-invalid @enderror" value="{{ $employee->department }}" name="department" id="department" placeholder="employee department">
            @error('department')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <label>Gender </label>
        @error('gender')
        <p class="invalid-feedback">{{ $message }}</p>
        @enderror
        <div class="form-check ">
            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="Male" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Male
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" value="Female" name="gender" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
                Female
            </label>
        </div>
        <label>Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>