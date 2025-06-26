<div class="card h-100 shadow-sm border-0">
    <img src="{{ $image }}" class="card-img-top" alt="{{ $name }}" style="height: 150px; object-fit: cover;">
    <div class="card-body text-center p-2">
        <h6 class="card-title fw-bold">{{ $name }}</h6>
        <p class="text-muted small">{{ $calories }} • {{ $persons }}</p>
        <div class="d-flex justify-content-between align-items-center px-2">
            <span class="fw-bold text-success">${{ $price }}</span>
            <button class="btn btn-sm btn-outline-danger rounded-pill">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        </div>
    </div>
</div>
