@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        
            <p class="fw-bold">{{ $error }}</p>
    </div>
    @endforeach

@endif