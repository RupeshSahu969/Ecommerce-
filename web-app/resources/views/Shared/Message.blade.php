@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success alert-highlighted">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-highlighted">
        {{ session('warning') }}
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info alert-highlighted">
        {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-highlighted">
        {{ session('error') }}
    </div>
@endif