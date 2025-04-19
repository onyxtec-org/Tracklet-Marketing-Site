$(function () {
    "use strict";

    var dtDevicesTable = $(".devices-table");

    if (dtDevicesTable.length) {
        dtDevicesTable.DataTable({
            ajax: "/devices",
            columns: [
                { data: "id", visible: false },
                { data: "name" },
                { 
                    data: "versions",
                    render: function (data, type, full, meta) {
                        if (data.length > 0) {
                            return data.map(v => `<span class="badge badge-primary">${v.version}</span>`).join(" ");
                        }
                        return "-";
                    }
                },
                { 
                    data: "versions",
                    render: function (data, type, full, meta) {
                        let colors = [];
                        data.forEach(version => {
                            version.colors.forEach(color => {
                                colors.push(`<span class="badge badge-secondary">${color.color_name}</span>`);
                            });
                        });
                        return colors.length > 0 ? colors.join(" ") : "-";
                    }
                },
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
                    data: "status",
                    render: function (data, type, full, meta) {
                        let checked = data == 1 ? "checked" : "";
                        return `<div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input toggle-status" data-id="${full.id}" ${checked}>
                                </div>`;
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
                            '<a id="deleteDevice" data-id="' +
                            full["id"] +
                            '" class="dropdown-item delete-record">' +
                            feather.icons["trash-2"].toSvg({ class: "font-small-4 mr-50" }) +
                            "Delete</a></div>" +
                            "</div>" +
                            "</div>"
                        );
                    }
                }
            ],
            order: [[4, "asc"]],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            language: {
                paginate: { previous: "&nbsp;", next: "&nbsp;" },
                sLengthMenu: "Show _MENU_",
                search: "Search Devices...",
            },
        });

        // Toggle Device Status
        $(document).on("change", ".toggle-status", function () {
            var id = $(this).data("id");
            var status = $(this).prop("checked") ? 1 : 0;

            $.ajax({
                url: "/devices/" + id + "/toggle-status",
                type: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: { status: status },
                success: function (response) {
                    alert("Device status updated successfully!");
                },
                error: function (xhr, status, error) {
                    alert("Error updating device status. Please try again.");
                }
            });
        });

        // Delete Device
        $(document).on("click", ".delete-record", function () {
            var id = $(this).data("id");

            if (confirm("Are you sure you want to delete this device?")) {
                $.ajax({
                    url: "/devices/" + id,
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
