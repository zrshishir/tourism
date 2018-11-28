function load_customer_users(e, customer_id, customer_name, url) {
    e.preventDefault();

    $.ajax({
        url: url + '/' + customer_id,
        method: 'get',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
            $('#modal_title').text(customer_name);
            var t = $('#customer_users_datatable').DataTable();
            t.rows().remove().draw();
            for (var i = 0; i < data.length; i++) {
                t.row.add([
                    i + 1,
                    data[i].name,
                    data[i].email,
                    '<span class="label label-info">User</span>',
                    '<span ' + ((data[i].status == 'Active') ? 'class="label label-success"' : 'class="label label-danger"') + '>' +
                    data[i].status + '</span>'
                ]).draw(false);
            }
            $('#customer_users').modal('show');
        },
    });

}