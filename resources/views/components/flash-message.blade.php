@props(['status' => 'info'])

@php
if(session('status') === 'info'){$bgColor = 'bg-blue-100';}
if(session('status') === 'alert'){$bgColor = 'bg-red-300';}
@endphp

@if(session('message'))
    <div class="{{ $bgColor }} w-1/3 mx-auto p-2 text-center rounded">
        {{ session('message') }}
    </div>
@endif
