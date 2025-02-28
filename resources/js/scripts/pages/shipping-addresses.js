$(function () {
    "use strict";

    var dtShippingAddressTable = $(".shipping-address-table");

    if (dtShippingAddressTable.length) {
        dtShippingAddressTable.DataTable({
            ajax: "/shipping-addresses",
            columns: [
                { data: "id", visible: false },
                { data: "address" },
                { 
                    data: "created_at",
                    render: function (data, type, full, meta) {
                        let date = new Date(data);
                        return (
                            ("0" + (date.getMonth() + 1)).slice(-2) + "/" +
                            ("0" + date.getDate()).slice(-2) + "/" +
                            date.getFullYear()
                        );
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons["more-vertical"].toSvg({ class: "font-small-4" }) +
                            "</a>" +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="#" class="dropdown-item delete-record" data-id="' + full["id"] + '">' +
                            feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Delete</a></div>" +
                            "</div>"
                        );
                    }
                }
            ],
            order: [[2, "desc"]],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                paginate: { previous: "&nbsp;", next: "&nbsp;" },
                sLengthMenu: "Show _MENU_",
                search: "Search Shipping Addresses...",
            },
        });

        // Delete Shipping Address
        $(document).on("click", ".delete-record", function () {
            var id = $(this).data("id");

            if (confirm("Are you sure you want to delete this address?")) {
                $.ajax({
                    url: "/shipping-addresses/" + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        location.reload(true);
                    },
                    error: function (xhr, status, error) {
                        location.reload(true);
                    }
                });
            }
        });
    }
});
