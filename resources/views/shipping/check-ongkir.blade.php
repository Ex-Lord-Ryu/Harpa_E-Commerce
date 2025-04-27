@extends('layouts.app')

@section('title', 'Cek Ongkir - Harpa')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/shipping.css') }}">
    <style>
        /* ... existing code ... */
    </style>
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1><i class="fas fa-truck"></i> Cek Ongkir</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Cek Ongkir</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kalkulator Ongkos Kirim</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="alert alert-info">
                                    <p class="mb-0">Hitung estimasi ongkos kirim dari berbagai jasa pengiriman seperti JNE, POS Indonesia, dan TIKI ke seluruh wilayah Indonesia.</p>
                                </div>
                            </div>
                        </div>

                        <form id="shipping-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi Asal</label>
                                        <select class="form-control" id="origin_province" required>
                                            <option value="">Pilih Provinsi Asal</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota/Kabupaten Asal</label>
                                        <select class="form-control" id="origin_city" required>
                                            <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi Tujuan</label>
                                        <select class="form-control" id="destination_province" required>
                                            <option value="">Pilih Provinsi Tujuan</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota/Kabupaten Tujuan</label>
                                        <select class="form-control" id="destination_city" required>
                                            <option value="">Pilih Provinsi Terlebih Dahulu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat (gram)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="weight" min="1" value="1000" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">gram</span>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Minimal 1 gram, 1 kg = 1000 gram</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kurir</label>
                                        <select class="form-control" id="courier" required>
                                            <option value="jne">JNE</option>
                                            <option value="pos">POS Indonesia</option>
                                            <option value="tiki">TIKI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" id="btn-check-shipping">
                                            <i class="fas fa-calculator"></i> Hitung Ongkos Kirim
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="shipping-results mt-4" style="display: none;">
                            <table class="shipping-results-table">
                                <thead>
                                    <tr class="table-header">
                                        <th width="30%">LAYANAN</th>
                                        <th width="30%">DESKRIPSI</th>
                                        <th width="20%">ESTIMASI</th>
                                        <th width="20%">ONGKOS KIRIM</th>
                                    </tr>
                                </thead>
                                <tbody id="shipping-results">
                                    <!-- Results will be populated here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="loading-overlay" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p class="mt-2">Sedang menghitung ongkos kirim...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Add SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Fetch cities when province is selected (Origin)
        $('#origin_province').on('change', function() {
            const provinceId = $(this).val();
            if (provinceId) {
                getCities(provinceId, 'origin_city');
            } else {
                $('#origin_city').empty().append('<option value="">Pilih Provinsi Terlebih Dahulu</option>');
            }
        });

        // Fetch cities when province is selected (Destination)
        $('#destination_province').on('change', function() {
            const provinceId = $(this).val();
            if (provinceId) {
                getCities(provinceId, 'destination_city');
            } else {
                $('#destination_city').empty().append('<option value="">Pilih Provinsi Terlebih Dahulu</option>');
            }
        });

        // Calculate shipping costs
        $('#shipping-form').on('submit', function(e) {
            e.preventDefault();

            const originCity = $('#origin_city').val();
            const destinationCity = $('#destination_city').val();
            const weight = $('#weight').val();
            const courier = $('#courier').val();

            if (!originCity || !destinationCity || !weight || !courier) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Semua field harus diisi',
                    icon: 'error'
                });
                return;
            }

            calculateShipping(originCity, destinationCity, weight, courier);
        });

        // Function to get cities by province ID
        function getCities(provinceId, elementId) {
            console.log(`Fetching cities for province ID: ${provinceId}`);
            $.ajax({
                url: `/api/shipping/cities/${provinceId}`,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log(`API Request started: /api/shipping/cities/${provinceId}`);
                    $(`#${elementId}`).empty().append('<option value="">Loading...</option>');
                },
                success: function(response) {
                    console.log('API Success:', response);
                    $(`#${elementId}`).empty().append('<option value="">Pilih Kota/Kabupaten</option>');

                    if (response.status === 'success') {
                        $.each(response.data, function(key, city) {
                            const cityType = city.type === 'Kabupaten' ? 'Kab. ' : 'Kota ';
                            $(`#${elementId}`).append(`<option value="${city.city_id}">${cityType}${city.name}</option>`);
                        });
                        console.log(`Loaded ${response.data.length} cities successfully`);
                    } else {
                        $(`#${elementId}`).empty().append('<option value="">Kota tidak tersedia</option>');
                        console.error('Error API response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('API Error:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    $(`#${elementId}`).empty().append('<option value="">Gagal memuat kota</option>');
                }
            });
        }

        // Function to calculate shipping costs
        function calculateShipping(origin, destination, weight, courier) {
            $('.loading-overlay').show();

            $.ajax({
                url: '{{ route("shipping.calculate") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    origin: origin,
                    destination: destination,
                    weight: weight,
                    courier: courier
                },
                success: function(response) {
                    $('.loading-overlay').hide();

                    if (response.status === 'success') {
                        displayShippingResults(response.data[0]);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Gagal menghitung ongkos kirim',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('.loading-overlay').hide();

                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal menghitung ongkos kirim',
                        icon: 'error'
                    });
                }
            });
        }

        // Function to display shipping results
        function displayShippingResults(data) {
            const courierName = data.name.toUpperCase();
            const costs = data.costs;

            if (costs.length === 0) {
                Swal.fire({
                    title: 'Informasi',
                    text: 'Tidak ada layanan pengiriman yang tersedia untuk rute ini',
                    icon: 'info'
                });
                return;
            }

            let html = '';

            $.each(costs, function(key, service) {
                const cost = service.cost[0];
                const serviceCode = service.service;

                html += `
                    <tr class="shipping-row">
                        <td class="service-column">
                            <div class="service-code">${serviceCode}</div>
                            <div class="service-name">${courierName}</div>
                        </td>
                        <td class="description-column">${service.description}</td>
                        <td class="estimation-column">
                            <span class="estimation-badge">${cost.etd} hari</span>
                        </td>
                        <td class="price-column">Rp ${formatNumber(cost.value)}</td>
                    </tr>
                `;
            });

            $('#shipping-results').html(html);
            $('.shipping-results').show();
        }

        // Format number to currency format
        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }
    });
</script>
@endpush
