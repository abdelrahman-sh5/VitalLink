@forelse($errors->all() as $error)
    <div class="callout callout-danger">{{ $error }}</div>
@empty
@endforelse

