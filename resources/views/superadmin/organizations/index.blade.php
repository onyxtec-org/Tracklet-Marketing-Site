@extends('layouts.contentLayoutMaster')

@section('title', 'Organizations')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection

@section('content')
@include('panels.response')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Organizations</h4>
        <a href="{{ route('superadmin.organizations.create') }}" class="btn btn-primary">
            <i data-feather="plus" class="mr-1"></i> Invite Organization
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table organizations-table" id="organizations-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Source</th>
                        <th>Invitation Status</th>
                        <th>Subscription</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection

@section('page-script')
<script>
$(function() {
    var table = $('.organizations-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '{{ route("superadmin.organizations.index") }}',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            dataSrc: function(json) {
                return json.success && json.data ? json.data : [];
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email', defaultContent: '-' },
            { 
                data: 'admin',
                render: function(data) {
                    return data ? data.name : '-';
                }
            },
            {
                data: 'registration_source',
                render: function(data) {
                    if (data === 'self_registered') {
                        return '<span class="badge badge-light-primary">Self Registered</span>';
                    }
                    return '<span class="badge badge-light-info">Invited</span>';
                }
            },
            {
                data: 'invitation_status',
                render: function(data, type, row) {
                    // For self-registered organizations, show "N/A"
                    if (row.registration_source === 'self_registered') {
                        return '<span class="badge badge-light-secondary">N/A</span>';
                    }
                    const statusMap = {
                        'none': '<span class="badge badge-light-secondary">No Invitation</span>',
                        'pending': '<span class="badge badge-light-warning">Pending</span>',
                        'joined': '<span class="badge badge-light-info">Joined</span>',
                        'expired': '<span class="badge badge-light-danger">Expired</span>'
                    };
                    return statusMap[data] || '<span class="badge badge-light-secondary">-</span>';
                }
            },
                render: function(data, type, row) {
                    const statusMap = {
                        'none': '<span class="badge badge-light-secondary">No Invitation</span>',
                        'pending': '<span class="badge badge-light-warning">Pending</span>',
                        'joined': '<span class="badge badge-light-info">Joined</span>',
                        'expired': '<span class="badge badge-light-danger">Expired</span>'
                    };
                    return statusMap[data] || '<span class="badge badge-light-secondary">-</span>';
                }
            },
            {
                data: 'is_subscribed',
                render: function(data, type, row) {
                    if (data) {
                        return '<span class="badge badge-light-success">Subscribed</span>';
                    }
                    return '<span class="badge badge-light-warning">Not Subscribed</span>';
                }
            },
            {
                data: 'created_at',
                render: function(data) {
                    if (!data) return '-';
                    const date = new Date(data);
                    return date.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric' 
                    });
                }
            },
            {
                data: null,
                orderable: false,
                render: function(data, type, row) {
                    return `
                        <div class="d-inline-flex">
                            <a href="/super-admin/organizations/${row.id}" class="btn btn-sm btn-icon" data-toggle="tooltip" title="View">
                                ${feather.icons['eye'].toSvg({ class: 'font-small-4' })}
                            </a>
                            <a href="/super-admin/organizations/${row.id}/edit" class="btn btn-sm btn-icon" data-toggle="tooltip" title="Edit">
                                ${feather.icons['edit'].toSvg({ class: 'font-small-4' })}
                            </a>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        language: {
            paginate: {
                previous: "&nbsp;",
                next: "&nbsp;",
            },
            sLengthMenu: "Show _MENU_",
            search: "Search Organizations...",
            searchPlaceholder: "Search Organizations...",
        },
        initComplete: function () {
            $("div.head-label").html('<h5 class="mb-0"><b>Organizations</b></h5>');
            // Initialize tooltips
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        }
    });
});
</script>
@endsection

