@include('layouts/header')
<div class="container">
    <h2 style="margin-top: 3%;">Update Leave Type</h2>
    <form method="post" action="{{ route('admin.store') }}" style="margin-top:20px">
        @csrf
        <div class="form-floating mb-3">
            <label for="type">Leave Type</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" name="type" id="type" placeholder="">
            @error('type')
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>

    </form>
</div>