//function listingDatatable() {
var dtable = $('#productListing').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    dom: 'lBfrtip',
    lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
    pageLength: 10,
    buttons: [
        'csv', 'print'
    ],
    ajax: {
        "url": base_url + "/admin/product-datatable",
        'method': 'POST',
        'data': function (d) {
            d._token = $("input[name=_token]").val();
             d.keyword = $("#keyword").val();

        }
    },
    columns: [
        {data: 'productName', name: 'productName', searchable: false, orderable: false, title: "Product Name", visible: true,
            render: function (data, full, row) {
                return data;
            }
        },
        {data: 'productCategory', name: 'productCategory', searchable: false, orderable: false, title: "Category", visible: true,
            render: function (data, full, row) {
                return data;
            }
        },
        {data: 'brandId', name: 'brandId', searchable: true, orderable: false, title: "Brand", visible: true,
            render: function (data, full, row) {
                return data;
            }
        },

        {data: 'productAltName', name: 'productAltName', searchable: true, orderable: false, title: "Alternate Name", visible: true,
            render: function (data, full, row) {
                return data;
            }
        },
        {data: 'productManufacturingYear', name: 'productManufacturingYear', searchable: true, orderable: false, title: "Manufacturing Year", visible: true,
            render: function (data, full, row) {
                return data;
            }
        },
        
    ]
});
$.fn.dataTable.ext.errMode = 'throw';

//filter the data 
$("#searchBtn").on('click', function () {
    dtable.draw();
});

//filter the data 
$("#resetBtn").on('click', function () {
    $("#searchProductForm")[0].reset();
    dtable.draw();
});

