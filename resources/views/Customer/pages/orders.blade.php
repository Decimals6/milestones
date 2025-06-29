@extends('Customer.layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
    <style>
        .container-custom {
            max-width: 1140px;
            margin: auto;
            padding: 1.5rem 1rem;
        }

        .order-card {
            border-radius: 14px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: background-color 0.3s, box-shadow 0.3s, border 0.3s;
        }

        body.dark .order-card {
            background-color: #252525;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.04), 0 4px 12px rgba(0, 0, 0, 0.5);
        }


        .order-progress {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 10px;
        }

        .order-progress .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            transition: background 0.3s;
        }

        .order-progress .dot.active {
            background: #0d6efd;
        }

        .order-status-bar {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #888;
            gap: 20px;
            margin-top: 4px;
        }

        body.dark .order-status-bar {
            color: #aaa;
        }

        .btn-back {
            display: none;
        }

        @media (max-width: 768px) {
            .btn-back {
                display: inline-flex;
                align-items: center;
                margin-bottom: 1rem;
                background: transparent;
                border: none;
                font-size: 1rem;
                color: var(--fg-dark);
            }

            body.dark .btn-back {
                color: #fff;
            }
        }

        .swal2-popup {
            border-radius: 18px !important;
            padding: 1.5rem !important;
            max-width: 600px;
        }

        body.dark .swal2-popup {
            background-color: #1e1e1e !important;
            color: #fff;
        }

        .receipt-box {
            border: 1px dashed #ccc;
            border-radius: 10px;
            padding: 1rem;
            background: #f8f9fa;
            margin-top: 1rem;
        }

        body.dark .receipt-box {
            background: #2b2b2b;
            border-color: #555;
        }

        .modal-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .modal-close-btn {
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step-item::after {
            content: "";
            position: absolute;
            top: 12px;
            right: -50%;
            width: 100%;
            height: 3px;
            background: #ccc;
            z-index: 0;
        }

        .step-item:last-child::after {
            display: none;
        }

        .step-circle {
            width: 24px;
            height: 24px;
            background: #ccc;
            border-radius: 50%;
            margin: auto;
            line-height: 24px;
            color: white;
            z-index: 1;
            position: relative;
        }

        .step-complete .step-circle {
            background: #28a745;
        }

        .step-complete::after {
            background: #28a745;
        }

        .step-label {
            font-size: 0.75rem;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .swal2-popup {
                width: 100% !important;
                margin: 0 !important;
                bottom: 0;
                position: fixed !important;
                left: 0;
                border-radius: 18px 18px 0 0 !important;
                animation: slideUp 0.3s ease-out;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                }

                to {
                    transform: translateY(0);
                }
            }
        }

        .nav-tabs .nav-link {
            color: #0d6efd;
        }

        body.dark .nav-tabs .nav-link {
            color: #9db4d3;
        }

        body.dark .nav-tabs .nav-link.active {
            background-color: #2b2b2b !important;
            color: #fff;
            border-color: #444 #444 #2b2b2b;
        }

        .text-muted {
            color: #6c757d !important;
        }

        body.dark .text-muted {
            color: #ccc !important;
        }
    </style>

    <div class="container-custom">
        <button onclick="history.back()" class="btn-back"><i class="bi bi-arrow-left me-1"></i> Kembali</button>
        <h4 class="fw-bold mb-4">Pesanan Saya</h4>

        <ul class="nav nav-tabs mb-3" id="orderTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#proses">Sedang Diproses</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#selesai">Selesai</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="proses">
                @foreach ([['INV0001', 'Menunggu Konfirmasi', '1 menit lalu', 2, 54000], ['INV0002', 'Dikirim', '10 menit lalu', 1, 38000]] as [$id, $status, $time, $items, $total])
                    <div class="order-card p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">Order ID: {{ $id }}</h6>
                                <small class="text-muted">{{ $time }} &bull; {{ $items }} item</small>
                                <div class="order-progress mt-2 align-items-center">
                                    <div
                                        class="dot {{ in_array($status, ['Menunggu Konfirmasi', 'Dikirim', 'Selesai']) ? 'active' : '' }}">
                                    </div>
                                    <div class="bar flex-grow-1 bg-secondary" style="height: 2px;"></div>
                                    <div class="dot {{ in_array($status, ['Dikirim', 'Selesai']) ? 'active' : '' }}"></div>
                                    <div class="bar flex-grow-1 bg-secondary" style="height: 2px;"></div>
                                    <div class="dot {{ $status === 'Selesai' ? 'active' : '' }}"></div>
                                </div>
                                <div class="order-status-bar">
                                    <span>Konfirmasi</span><span>Diproses</span><span>Selesai</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary rounded-pill">{{ $status }}</span><br>
                                <div class="text-danger mt-2">Rp{{ number_format($total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"
                                onclick="showDetail('{{ $id }}', '{{ $status }}')">Lihat Detail</button>
                            <button class="btn btn-danger btn-sm rounded-pill"
                                onclick="cancelOrder('{{ $id }}')">Batalkan</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="selesai">
                @foreach ([['INV9991', 'Selesai', 'Kemarin', 3, 76000], ['INV9990', 'Selesai', '2 hari lalu', 1, 25000]] as [$id, $status, $time, $items, $total])
                    <div class="order-card p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">Order ID: {{ $id }}</h6>
                                <small class="text-muted">{{ $time }} &bull; {{ $items }} item</small>
                                <div class="mt-2 text-success fw-semibold">Pesanan Telah Selesai</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success rounded-pill">{{ $status }}</span><br>
                                <div class="text-success mt-2">Rp{{ number_format($total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill"
                                onclick="showDetail('{{ $id }}', '{{ $status }}')">Lihat Detail</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function showDetail(id, status) {
            const steps = [{
                    label: 'Konfirmasi'
                },
                {
                    label: 'Diproses'
                },
                {
                    label: 'Dikirim'
                },
                {
                    label: 'Selesai'
                },
            ];

            const completedIndex = {
                'Menunggu Konfirmasi': 0,
                'Diproses': 1,
                'Dikirim': 2,
                'Selesai': 3,
            } [status] ?? 0;

            const progressHTML = steps.map((step, index) => `
        <div class="step-item ${index <= completedIndex ? 'step-complete' : ''}">
            <div class="step-circle">${index <= completedIndex ? '✔' : ''}</div>
            <div class="step-label">${step.label}</div>
        </div>
    `).join('');

            const html = `
    <div class="modal-header-custom">
        <span>Detail Pesanan</span>
        <span class="modal-close-btn" onclick="Swal.close(); removeSwalBackdrop();">&times;</span>
    </div>
    <div class="progress-steps">${progressHTML}</div>
    <div class="receipt-box">
        <p><strong>ID:</strong> ${id}</p>
        <p><strong>Waktu:</strong> 12 Juni 2025, 12:30 WIB</p>
        <p><strong>Metode Bayar:</strong> Tunai</p>
        <p><strong>Item:</strong><br> 🍚 Nasi Goreng x1<br> 🍗 Ayam Bakar x1</p>
        <p><strong>Catatan:</strong> Pedas sedang, tanpa kacang</p>
        <p><strong>Total:</strong> Rp54.000</p>
        <p><strong>Status:</strong> <span class="badge bg-${status === 'Selesai' ? 'success' : 'info'}">${status}</span></p>
    </div>`;

            Swal.fire({
                html: html,
                showConfirmButton: false,
                showCloseButton: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'
                },
                didClose: () => {
                    removeSwalBackdrop(); // Fallback
                }
            });
        }

        function removeSwalBackdrop() {
            const swalContainer = document.querySelector('.swal2-container');
            if (swalContainer) swalContainer.remove();
            document.body.classList.remove('swal2-shown');
            document.body.style.overflow = ''; // pastikan scroll bisa
        }

        function cancelOrder(id) {
            Swal.fire({
                title: 'Alasan Pembatalan',
                input: 'text',
                inputPlaceholder: 'Tulis alasan pembatalan...',
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
                preConfirm: (reason) => {
                    if (!reason) {
                        Swal.showValidationMessage('Harap isi alasan pembatalan');
                    }
                    return reason;
                }
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Dibatalkan',
                        text: `Pesanan ${id} dibatalkan.`,
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        }
    </script>
@endsection
