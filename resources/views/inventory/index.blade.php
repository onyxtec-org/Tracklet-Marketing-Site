@extends('layouts.contentLayoutMaster')

@section('title', 'Inventory Management')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
@endsection

@section('content')
@include('panels.response')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Inventory Items</h4>
                <div>
                    @if($low_stock_count > 0)
                        <a href="{{ route('inventory.low-stock') }}" class="btn btn-warning mr-1">
                            <i data-feather="alert-triangle" class="mr-1"></i> Low Stock ({{ $low_stock_count }})
                        </a>
                    @endif
                    <a href="{{ route('inventory.items.create') }}" class="btn btn-primary">
                        <i data-feather="plus" class="mr-1"></i> Add Item
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <form method="GET" action="{{ route('inventory.items.index') }}" class="mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Search</label>
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search items...">
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <div class="form-check mt-2">
                                <input type="checkbox" name="low_stock" class="form-check-input" id="lowStock" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                                <label class="form-check-label" for="lowStock">Low Stock Only</label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-1">Filter</button>
                            <a href="{{ route('inventory.items.index') }}" class="btn btn-outline-secondary">Clear</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Total Value</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->category ?? '-' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>${{ number_format($item->unit_price, 2) }}</td>
                                <td><strong>${{ number_format($item->total_price, 2) }}</strong></td>
                                <td>
                                    @if($item->isLowStock())
                                        <span class="badge badge-light-warning">Low Stock</span>
                                    @else
                                        <span class="badge badge-light-success">In Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="{{ route('inventory.items.show', $item) }}" class="btn btn-sm btn-icon" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="{{ route('inventory.items.edit', $item) }}" class="btn btn-sm btn-icon" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <form action="{{ route('inventory.items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon" title="Delete">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No inventory items found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
$(function() {
    if (feather) {
        feather.replace({ width: 14, height: 14 });
    }
});
</script>
@endsection

