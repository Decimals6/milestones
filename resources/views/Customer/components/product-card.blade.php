<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title text-primary">{{ $title ?? 'Produk' }}</h5>
        <p class="card-text">{{ $desc ?? 'Deskripsi singkat produk.' }}</p>
        <p class="fw-bold text-success">{{ $price ?? 'Rp 0' }}</p>
        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
    </div>
</div>
