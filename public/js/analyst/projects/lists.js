var dtable = $('#projectDatatable').DataTable({
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
        "url": base_url + "/analyst/project/project-datatable",
        'method': 'POST',
        'data': function (d) {
            d._token = $("input[name=_token]").val();
            d.keyword = $("#keyword").val();
        }
    },
    columns: [
        {data: 'projectTitle', name: 'projectTitle', searchable: false, orderable: false, title: "Project Title", visible: true},
        {data: 'projectTypeName', name: 'projectTypeName', searchable: false, orderable: false, title: "Project type", visible: true
        },
        {data: 'groupName', name: 'groupName', searchable: true, orderable: false, title: "Group", visible: true},
        {data: 'projectSessionCount', name: 'projectSessionCount', searchable: true, orderable: false, title: "No of sessions", visible: true},
        {data: 'ownerFirstName', name: 'ownerFirstName', searchable: true, orderable: false, title: "Owner", visible: true, render: function (data, full, row) {
                return data + ' ' + (row.ownerLastName != null ? row.ownerLastName : '');
            }
        },
        {data: 'firstName', name: 'firstName', searchable: true, orderable: false, title: "Created by", visible: true, render: function (data, full, row) {
                return data + ' ' + (row.firstName != null ? row.lastName : '');
            }
        },
        {data: 'projectCreatedOn', name: 'projectCreatedOn', searchable: false, orderable: false, title: "Created", visible: true}
        
    ]
});
$.fn.dataTable.ext.errMode = 'throw';

//filter the data 
$("#searchBtn").on('click', function () {
    dtable.draw();
});

//filter the data 
$("#resetBtn").on('click', function () {
    $("#searchProjectForm")[0].reset();
    dtable.draw();
});