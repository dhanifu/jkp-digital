jQuery(function ($) {

    const table = $('table').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: ajaxUrl,
            type: 'post',
            data: {
                _token: csrf
            }, error: (err) => {
                console.log(err)
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name' },
            { data: 'email' },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ],
    })

    const reload = () => table.ajax.reload()

    const success = msg => {
        const alert = $('#alert')
        const modal = $('.modal')

        alert.html(`
            <div class="alert alert-success alert-dismissable">
                ${msg}
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
        `)

        reload()
        modal.modal('hide')
    }

    const error = msg => {
        const alert = $('#alert')
        const modal = $('.modal')

        alert.html(`
            <div class="alert alert-danger alert-dismissable">
                ${msg}
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
        `)

        reload()
        modal.modal('hide')
    }

    const remove = id => {
        if (confirm("Yakin untuk menghapus data ini?")) {
            const url = deleteUrl.replace(':id', id)

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    _token: csrf,
                    _method: 'DELETE'
                },
                success: res => {
                    success(res.success)
                    reload()
                }
            })
        }
    }

    reloadTable.addEventListener('click', function () {
        reload()
    })

    $("#excel-btn").click(function(){
        $("#excel_file").click()
    })

    $('tbody').on('click', 'button', function () {
        const action = $(this).data('action')
        const data = table.row($(this).parents('tr')).data()

        switch (action) {
            case 'edit':
                const url = editUrl.replace(':id', data.id)
                document.location.href = url
                break
            case 'remove':
                remove(data.id)
                break
        }
    })

})