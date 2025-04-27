@extends('layouts.landing')

@push('css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/landing/tes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing/welcome-modals.css') }}">
    <style>
        .login-prompt {
            background-color: rgba(103, 119, 239, 0.1);
            padding: 8px 15px;
            border-radius: 5px;
            margin-top: 10px;
            border-left: 3px solid #6777ef;
            font-size: 14px;
        }
        .login-prompt a {
            color: #6777ef;
            font-weight: 600;
            text-decoration: underline;
        }
    </style>
@endpush

@section('title', 'Gallery Bejo - UMKM Bersuara')

@section('content')
    <div class="main-content">
        @include('components.navbar')

        <header id="home">
            <div class="left">
                <h1>Harpa Mulut – Saatnya UMKM Bersuara! <span>Gallery Bejo</span></h1>
                <p>Kami percaya bahwa setiap UMKM memiliki cerita unik.</p>
                @auth
                <a href="{{ route('products.catalog') }}">
                    <i class='bx bx-basket'></i>
                    <span>Pesan Sekarang</span>
                </a>
                @else
                <a href="{{ route('login') }}">
                    <i class='bx bx-log-in'></i>
                    <span>Login untuk Belanja</span>
                </a>
                <div class="login-prompt">
                    <p>Silakan <a href="{{ route('login') }}">login</a> atau <a href="{{ route('register') }}">daftar</a> terlebih dahulu untuk melihat katalog produk kami.</p>
                </div>
                @endauth
            </div>
            <img src="{{ asset('img/img/tp.png') }}">
        </header>

        <h2 id="promosi-unggulan" class="separator">
            Promosi Unggulan
        </h2>

        <div class="nft-shop">
            <div class="nft-list">
                @forelse($featuredProducts as $product)
                    <div class="item">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image"
                            onclick="openModal('{{ Storage::url($product->image) }}', '{{ $product->name }}')">
                        <div class="info">
                            <div>
                                <h5>{{ $product->name }}</h5>
                                <div class="btc">
                                    <p>{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="product-description">
                                <div class="product-description-list">
                                    @php
                                        $lines = explode("\n", $product->description);
                                        $shortDescription = array_slice($lines, 0, 3);
                                    @endphp
                                    @foreach($shortDescription as $line)
                                        @if(trim($line))
                                            <p>{{ $line }}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-details">
                                <button class="details-btn" onclick="showDetails('{{ $product->id }}')">Lihat
                                    Detail</button>
                            </div>
                        </div>
                        <div class="bid">
                            @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="redirect_to" value="{{ route('cart.index') }}">
                                <button type="submit" class="btn-add-to-cart">Tambahkan ke Keranjang</button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn-add-to-cart" style="display: block; text-align: center;">
                                Login untuk Membeli
                            </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No featured products available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Product Detail Modal -->
        <div id="productDetailModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeDetailModal()">&times;</span>
                <div id="productDetailContent"></div>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-content">
                <img id="modalImage" src="" alt="">
                <div id="modalCaption"></div>
            </div>
        </div>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <h2><span>Kontak</span> Kami</h2>

            <div class="row">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.291823424536!2d112.60701217386206!3d-7.968763192056161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788285c228f26f%3A0xf13c282db677a0b1!2sJl.%20Singgalang%20No.5%2C%20Pisang%20Candi%2C%20Kec.%20Sukun%2C%20Kota%20Malang%2C%20Jawa%20Timur%2065146!5e0!3m2!1sid!2sid!4v1689173406403!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map">
                </iframe>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="name" placeholder="nama">
                    </div>
                    <div class="input-group">
                        <i data-feather="mail"></i>
                        <input type="email" name="email" placeholder="email">
                    </div>
                    <div class="input-group">
                        <i data-feather="phone"></i>
                        <input type="text" name="phone" placeholder="no hp">
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </div>
        </section>

        <footer>
            <h3>Create, Explore, Find & Collect Your Want Here</h3>
            <div class="right">
                <div class="links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Cooperation</a>
                    <a href="#">Sponsorship</a>
                    <a href="#">Contact Us</a>
                </div>
                <div class="social">
                    <i class='bx bxl-instagram'></i>
                    <i class='bx bxl-facebook-square'></i>
                    <i class='bx bxl-github'></i>
                </div>
                <p>Copyright © {{ date('Y') }} Gallery Bejo, All Rights Reserved.</p>
            </div>
        </footer>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });

        // Format currency function
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Image modal functions
        function openModal(imgSrc, caption) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const captionText = document.getElementById('modalCaption');

            modalImg.src = imgSrc;
            captionText.innerHTML = caption;

            modal.style.display = "block";
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        // Close product detail modal
        function closeDetailModal() {
            const modal = document.getElementById('productDetailModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = "none";
            }, 300);
        }

        // Product detail functions
        function showDetails(productId) {
            const modal = document.getElementById('productDetailModal');
            const contentDiv = document.getElementById('productDetailContent');

            // Show loading state
            modal.style.display = "block";
            contentDiv.innerHTML = '<div style="text-align: center; padding: 40px;"><i data-feather="loader" class="spinner"></i><p>Memuat detail produk...</p></div>';
            feather.replace(); // Replace the feather icon

            setTimeout(() => {
                modal.classList.add('show');
            }, 10);

            // Use AJAX to fetch product details
            fetch(`/api/products/${productId}`)
                .then(response => response.json())
                .then(data => {
                    let isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                    let productHtml = `
                        <div class="product-detail">
                            <div class="product-image">
                                <img src="${data.image_url}" alt="${data.name}">
                            </div>
                            <div class="product-info">
                                <h3>${data.name}</h3>
                                <div class="price">${formatCurrency(data.price)}</div>
                                <div class="description">${data.description.replace(/\n/g, '<br>')}</div>
                                <div class="stock">
                                    <span class="stock-label">Stok:</span>
                                    <span class="stock-value">${data.stock_quantity ?? 'Tersedia'}</span>
                                </div>
                    `;

                    if (isLoggedIn) {
                        productHtml += `
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="${data.id}">
                                    <input type="hidden" name="redirect_to" value="{{ route('cart.index') }}">
                                    <div class="quantity-container">
                                        <label for="quantity">Jumlah:</label>
                                        <div class="quantity-input">
                                            <button type="button" class="quantity-btn minus" onclick="decrementQuantity(this)">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="${data.stock_quantity || 99}">
                                            <button type="button" class="quantity-btn plus" onclick="incrementQuantity(this)">+</button>
                                        </div>
                                    </div>
                                    <button type="submit" class="add-to-cart-btn">
                                        <i data-feather="shopping-cart"></i>
                                        Tambahkan ke Keranjang
                                    </button>
                                </form>
                        `;
                    } else {
                        productHtml += `
                                <div class="login-prompt" style="background-color: rgba(103, 119, 239, 0.1); padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 3px solid #6777ef;">
                                    <p>Untuk menambahkan produk ke keranjang, silakan <a href="{{ route('login') }}" style="color: #6777ef; font-weight: bold;">login</a> terlebih dahulu.</p>
                                </div>
                                <a href="{{ route('login') }}" class="add-to-cart-btn" style="display: inline-block; text-decoration: none; text-align: center; background: linear-gradient(135deg, #6777ef, #3d4eda); color: white; padding: 12px 20px; border-radius: 5px; font-weight: 600; margin-top: 10px;">
                                    <i data-feather="log-in"></i>
                                    Login untuk Membeli
                                </a>
                        `;
                    }

                    productHtml += `
                            </div>
                        </div>
                    `;

                    contentDiv.innerHTML = productHtml;
                    feather.replace(); // Replace feather icons in the new content
                })
                .catch(error => {
                    contentDiv.innerHTML = `
                        <div style="text-align: center; padding: 40px;">
                            <i data-feather="alert-circle" style="width: 48px; height: 48px; color: #fc544b;"></i>
                            <p>Terjadi kesalahan saat memuat detail produk.</p>
                            <button onclick="closeDetailModal()" class="btn-close-modal">Tutup</button>
                        </div>
                    `;
                    feather.replace();
                });
        }

        // Quantity functions for product detail
        function incrementQuantity(button) {
            const input = button.parentNode.querySelector('input');
            const max = parseInt(input.getAttribute('max'));
            const currentValue = parseInt(input.value);

            if (currentValue < max) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity(button) {
            const input = button.parentNode.querySelector('input');
            const currentValue = parseInt(input.value);

            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
@endpush
