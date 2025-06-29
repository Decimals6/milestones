@php
    $name = request('name', 'All Categories');
@endphp

<div class="container py-4">
    <h2 class="mb-4 fw-bold">{{ $name }}</h2>

    {{-- Simulasi tampil produk --}}
    <div class="row g-3">
        @for ($i = 0; $i < 6; $i++)
            <div class="col-6 col-md-4">
                <div class="card shadow-sm border-0">
                    <img src="https://picsum.photos/seed/{{ $name . $i }}/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">{{ $name }} Item {{ $i + 1 }}</h6>
                        <p class="card-text text-muted small">Deskripsi singkat...</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
