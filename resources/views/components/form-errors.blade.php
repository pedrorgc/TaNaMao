@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-toast type="error" :message="$error" />
    @endforeach
@endif
