@if (session('success'))
    <x-toast :message="session('success')" />
@endif
