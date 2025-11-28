@extends('layouts.contentLayoutMaster')

@section('title', 'Inventory Item Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">{{ $item->name }}</h4>
                <div>
                    <a href="{{ route('inventory.items.edit', $item) }}" class="btn btn-primary">
                        <i data-feather="edit" class="mr-1"></i> Edit
                    </a>
                    <a href="{{ route('inventory.items.index') }}" class="btn btn-outline-secondary">
                        <i data-feather="arrow-left" class="mr-1"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Name:</th>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $item->category ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Quantity:</th>
                                <td><strong>{{ $item->quantity }} {{ $item->unit }}</strong></td>
                            </tr>
                            <tr>
                                <th>Minimum Threshold:</th>
                                <td>{{ $item->minimum_threshold }} {{ $item->unit }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Unit Price:</th>
                                <td>${{ number_format($item->unit_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Total Value:</th>
                                <td><strong class="text-primary">${{ number_format($item->total_price, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($item->isLowStock())
                                        <span class="badge badge-light-warning">Low Stock</span>
                                    @else
                                        <span class="badge badge-light-success">In Stock</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Stock Transactions</h5>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#stockModal">
                                    <i data-feather="plus" class="mr-1"></i> Log Stock
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Quantity</th>
                                                <th>Reference</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($item->stockTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                                <td>
                                                    @if($transaction->type == 'in')
                                                        <span class="badge badge-light-success">Stock In</span>
                                                    @else
                                                        <span class="badge badge-light-danger">Stock Out</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->quantity }} {{ $item->unit }}</td>
                                                <td>{{ $transaction->reference ?? '-' }}</td>
                                                <td>{{ $transaction->user->name }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No transactions found.</td>
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
    </div>
</div>

<!-- Stock Transaction Modal -->
<div class="modal fade" id="stockModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('inventory.items.stock', $item) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Log Stock Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-control" required>
                            <option value="in">Stock In</option>
                            <option value="out">Stock Out</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Transaction Date <span class="text-danger">*</span></label>
                        <input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <input type="text" name="reference" class="form-control" placeholder="Purchase order, usage reason, etc.">
                    </div>
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
                    </div>
                    <div id="stockInFields">
                        <div class="form-group">
                            <label>Unit Price</label>
                            <input type="number" name="unit_price" step="0.01" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Vendor</label>
                            <input type="text" name="vendor" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </form>
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

    $('#stockModal select[name="type"]').on('change', function() {
        if ($(this).val() == 'in') {
            $('#stockInFields').show();
        } else {
            $('#stockInFields').hide();
        }
    });
});
</script>
@endsection

