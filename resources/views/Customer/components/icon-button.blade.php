@props(['icon','label','badge'=>null])
@php $badge = $badge!==null ? '<span class="badge bg-danger position-absolute top-0 start-50 translate-middle">'.$badge.'</span>' : ''; @endphp
<a class="text-center text-decoration-none position-relative dark:text-light">
    <i class="bi bi-{{ $icon }} fs-4"></i>{!! $badge !!}<br><small>{{ $label }}</small>
</a>
