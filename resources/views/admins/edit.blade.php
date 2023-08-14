@include('layouts/header')
<div class="container">
    <h2 style="margin-top: 3%;">Update Leave Type</h2>
    <form method="post" action="{{ route('admin.update',$leaveType) }}" style="margin-top:20px">
        @csrf
        @method('put')
        <div class="form-floating mb-3">
            <label for="type">Leave Type</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" value="{{ $leaveType->type }}" name="type" id="type" placeholder="">
            @error('type')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

    </form>
</div>