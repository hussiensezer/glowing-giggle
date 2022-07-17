@props(['status'])

@if($status == 1)
    <span class="badge bg-light-success text-success w-100">مفعل</span>
@else
    <span class="badge bg-light-danger text-danger w-100">معطل</span>
@endif
