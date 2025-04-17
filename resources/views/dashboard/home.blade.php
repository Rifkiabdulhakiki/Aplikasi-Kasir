@extends('layouts.app')
@section('title', 'Tambah Penjualan')

@section('content')

<main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header">
                            <h1>Dashboard</h1>
                            <p>
                            Welcome to E-Kasir, a modern cashier management system!</p>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon sales-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-text">
                        <?php 
                        $penjualans = \App\Penjualan::all()->count();
                        ?>
                            <h4>{{$penjualans}}</h4>
                            <p>Total Penjualan</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon product-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="stat-text">
                        <?php 
                        $produks = \App\produk::all()->count();
                        ?>
                            <h4>{{$produks}}</h4>
                            <p>Total Produk</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon customer-icon">
                            <i class="fas<div class="stat-icon customer-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-text">
                        <?php
                        $pelanggans = \App\pelanggan::all()->count();
                        ?>
                            <h4>{{$pelanggans}}</h4>
                            <p>Total Pelanggan</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon profit-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="stat-text">
                            <h4>Rp 1</h4>
                            <p>Total Pendapatan</p>
                        </div>
                    </div>
                </div>
                

        </main>
        @endsection