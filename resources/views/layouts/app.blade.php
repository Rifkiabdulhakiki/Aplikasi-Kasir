<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/img/logo/kasir5.png') }}" rel="icon">
    <title>{{ config('app.name', 'E-Kasir') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #ffd166;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 0.8rem 1rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 0.25rem;
        }
        
        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-nav .active > .nav-link {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
        }
        
        .dropdown-item:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            padding: 0.6rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
            border-color: var(--primary-color);
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 0.85rem 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .badge {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
            border-radius: 6px;
        }
        
        .produk-item {
            background-color: #fff;
            border-radius: 8px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        
        .produk-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .action-buttons .btn {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-text h4 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .stat-text p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .sales-icon {
            background-color: var(--primary-color);
        }
        
        .product-icon {
            background-color: var(--success-color);
        }
        
        .customer-icon {
            background-color: var(--warning-color);
        }
        
        .profit-icon {
            background-color: var(--danger-color);
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0.75rem 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
        
        .page-header {
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }
        
        @media (max-width: 768px) {
            .navbar-collapse {
                background-color: var(--secondary-color);
                padding: 1rem;
                border-radius: 0 0 10px 10px;
                margin-top: 0.5rem;
            }
            
            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-cash-register me-2"></i>{{ config('app.name', 'E-Kasir') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.home') }}">
                                <i class="fas fa-box me-1"></i>{{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produks.index') }}">
                                <i class="fas fa-box me-1"></i>{{ __('Produk') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('penjualans.index') }}">
                                <i class="fas fa-shopping-cart me-1"></i>{{ __('Penjualan') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.index') }}">
                                <i class="fas fa-users me-1"></i>{{ __('Pelanggan') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.index') }}">
                                <i class="fas fa-box me-1"></i>{{ __('Laporan') }}
                            </a>
                        </li>
                        <!-- @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    <i class="fas fa-user-plus me-1"></i>{{ __('Register') }}
                </a>
            </li>
        @endguest -->

                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
@yield('content')
    
        
        <!-- <footer class="py-4 bg-white mt-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-muted">&copy; 2025 E-Kasir. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0 text-muted">Versi 2.5.0</p>
                    </div>
                </div>
            </div>
        </footer> -->
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let produkIndex = 1;
            
            // Update total
            function updateTotal() {
                let total = 0;
                $('.subtotal-input').each(function() {
                    total += parseInt($(this).val()) || 0;
                });
                $('.text-primary').text('Rp ' + total.toLocaleString('id-ID'));
            }

            // Tambah produk baru
            $("#add-produk").click(function() {
                let newProduk = $(".produk-item:first").clone();
                newProduk.find("select, input").each(function() {
                    let name = $(this).attr("name");
                    if (name) {
                        $(this).attr("name", name.replace(/\d+/, produkIndex));
                    }
                    $(this).val("");
                });
                newProduk.appendTo("#produk-list");
                produkIndex++;
            });

            // Hapus produk jika lebih dari satu
            $(document).on("click", ".remove-produk", function() {
                if ($(".produk-item").length > 1) {
                    $(this).closest(".produk-item").remove();
                    updateTotal();
                }
            });

            // Update harga total berdasarkan pilihan produk
            $(document).on("change", ".produk-select", function() {
                let row = $(this).closest(".produk-item");
                let harga = $(this).find("option:selected").data("harga") || 0;
                let jumlah = row.find(".jumlah-input").val() || 1;
                
                row.find("input:eq(0)").val(harga);
                let subtotal = harga * jumlah;
                row.find(".subtotal-input").val(subtotal);
                updateTotal();
            });
            
            $(document).on("change", ".jumlah-input", function() {
                let row = $(this).closest(".produk-item");
                let harga = row.find("inputlet row = $(this).closest(".produk-item");
                let harga = row.find("input:eq(0)").val() || 0;
                let jumlah = $(this).val() || 1;
                
                let subtotal = harga * jumlah;
                row.find(".subtotal-input").val(subtotal);
                updateTotal();
            });
            
            // Initialize values
            $(".produk-select").trigger("change");
            
            // Toggle sidebar
            $("#sidebarToggle").click(function(e) {
                e.preventDefault();
                $("body").toggleClass("sb-sidenav-toggled");
            });
            
            // Responsive behavior
            $(window).resize(function() {
                if ($(window).width() < 768) {
                    $("body").addClass("sb-sidenav-toggled");
                } else {
                    $("body").removeClass("sb-sidenav-toggled");
                }
            });
        });

        $(document).ready(function() {
            .
    $('.nav-link').on('click', function() {
        console.log('Link diklik: ' + $(this).attr('href'));
    });
});

    </script>