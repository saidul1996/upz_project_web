@if(session('success_message'))
    <x-alert type="success">{{ Str::title(session('success_message')) }}</x-alert>
@endif
@if(session('error_message'))
    <x-alert type="error">{{ Str::title(session('error_message')) }}</x-alert>
@endif
