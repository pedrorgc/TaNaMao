@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-toast :message="$error" />
    @endforeach
@endif
