<footer class="footer mt-auto pt-5 position-relative text-dark-subtle">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main.container-fluid {
            flex: 1 0 auto;
        }

        footer.footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark footer.footer {
            background-color: #262626;
            color: #f1f1f1;
        }

        .footer a {
            transition: color 0.2s ease-in-out;
        }

        .footer a:hover {
            color: #dc3545 !important;
        }

        .dark .footer a {
            color: #e0e0e0 !important;
        }

        .dark .footer a:hover {
            color: #f87171 !important;
        }

        .fab-chat {
            position: fixed;
            right: 18px;
            bottom: 90px;
            background: white;
            border-radius: 50%;
            padding: 6px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .3);
            z-index: 1050;
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .fab-chat {
                bottom: 105px;
            }
        }

        .dark .fab-chat {
            background: #2b2b2b;
        }

        .footer .newsletter-bg {
            background-color: #dc3545;
            color: white;
        }

        .dark .footer .newsletter-bg {
            background-color: #e63946;
            color: #fff;
        }

        .footer .btn-light {
            color: #000;
        }

        .dark .footer .btn-light {
            background-color: #f1f1f1;
            color: #000;
        }
    </style>

    <div class="container">

        {{-- Newsletter Bar --}}
        <div
            class="rounded-3 px-4 py-3 mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between newsletter-bg position-relative overflow-hidden">
            <div class="position-absolute top-50 start-50 translate-middle opacity-10" style="z-index:0;">
                <img src="https://picsum.photos/seed/burger/100/100" alt="bg" class="img-fluid">
            </div>
            <div class="position-relative z-1 mb-2 mb-md-0">
                <strong class="fs-5">Newsletter</strong><br>
                <small>Subscribe to our newsletter and unlock a world of exclusive</small>
            </div>
            <form class="d-flex position-relative z-1 mt-2 mt-md-0" style="max-width: 320px;">
                <input type="email" class="form-control me-2" placeholder="Your Email Address">
                <button class="btn btn-light">Subscribe</button>
            </form>
        </div>

        {{-- Footer Content --}}
        <div class="row gy-4 text-center text-md-start">
            <div class="col-12 col-md-3">
                <div class="d-flex align-items-center gap-2 mb-2 justify-content-center justify-content-md-start">
                    <img src="https://picsum.photos/seed/logo/32/32" alt="logo" class="rounded-circle">
                    <h5 class="mb-0 text-danger">eFood</h5>
                </div>
                <p class="small">Best Delivery Service Near You. Enjoy the best food around at your home</p>
                <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-4">
                    <i class="bi bi-pinterest"></i>
                    <i class="bi bi-linkedin"></i>
                    <i class="bi bi-facebook"></i>
                </div>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-semibold">My Account</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none">Profile</a></li>
                    <li><a href="#" class="text-decoration-none">Address</a></li>
                    <li><a href="#" class="text-decoration-none">Live Chat</a></li>
                    <li><a href="#" class="text-decoration-none">My Order</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2">
                <h6 class="fw-semibold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none">Contact Us</a></li>
                    <li><a href="#" class="text-decoration-none">Privacy Policy</a></li>
                    <li><a href="#" class="text-decoration-none">Terms & Conditions</a></li>
                    <li><a href="#" class="text-decoration-none">About Us</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-5">
                <h6 class="fw-semibold">Download Our Apps</h6>
                <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                    <img src="https://picsum.photos/seed/google/140/48" alt="Google Play" class="img-fluid">
                    <img src="https://picsum.photos/seed/apple/140/48" alt="App Store" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="text-center py-4 mt-4 border-top border-secondary small">
            e-Food © {{ date('Y') }}
        </div>
    </div>

    {{-- Floating Chat Button --}}
    <a href="https://wa.me/628123456789" target="_blank" class="fab-chat">
        <img src="https://picsum.photos/seed/chat/38/38" alt="Chat" class="img-fluid rounded-circle">
    </a>
</footer>
