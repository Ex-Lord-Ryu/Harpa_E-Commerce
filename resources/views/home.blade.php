@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container py-4">
        <h2 class="mb-4">{{ __('Dashboard') }}</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <!-- Account Summary Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ __('Account Summary') }}</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 24px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.show') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-user me-1"></i> {{ __('View Profile') }}
                            </a>
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-edit me-1"></i> {{ __('Edit Profile') }}
                            </a>
                            <a href="{{ route('profile.change-password') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-lock me-1"></i> {{ __('Change Password') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ __('Quick Actions') }}</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('products.catalog') }}" class="btn btn-primary">
                                <i class="fa fa-shopping-bag me-1"></i> {{ __('Browse Products') }}
                            </a>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                                <i class="fa fa-shopping-cart me-1"></i> {{ __('View Cart') }}
                            </a>
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                                <i class="fa fa-list me-1"></i> {{ __('My Orders') }}
                            </a>
                            <a href="{{ route('shipping.track') }}" class="btn btn-outline-primary">
                                <i class="fa fa-truck me-1"></i> {{ __('Track Shipment') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ __('Help & Support') }}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 px-0">
                                <i class="fa fa-question-circle text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">{{ __('FAQ') }}</a>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <i class="fa fa-book text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">{{ __('User Guide') }}</a>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <i class="fa fa-phone text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">{{ __('Contact Support') }}</a>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <i class="fa fa-comments text-primary me-2"></i>
                                <a href="#" class="text-decoration-none">{{ __('Live Chat') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">{{ __('Recent Orders') }}</h5>
                            <a href="{{ route('orders.index') }}" class="btn btn-sm btn-link">{{ __('View All') }}</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Order #') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->orders()->latest()->take(5)->get() as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'processing' ? 'warning' : 'info') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                                {{ __('Details') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3">{{ __('No orders found') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
