<script>
    $(document).ready(function(){
        //get data from datatables
        var table = $('#loan_items_datatables').DataTable({
            processing: true,
            serverSide: true,
            destroy:true,
            pageLength : 5,
            ajax: {
                url: "{{ route('epinjam.get_datatables') }}",
                type: "POST",
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            order: [
                [8, 'desc']
            ],
            responsive: true,
            columns: [
                {
                    title: '#',
                    name: 'no',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'item_name',
                    name: 'item_name'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'purpose',
                    name: 'purpose'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'return_date',
                    name: 'return_date'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });
     //  INSERT VIA AJAX
$('.modal-footer').on('click', '.saveCreate', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var name = $('#name_epinjam').val();
    var section = $('#section_epinjam').val();
    var contact = $('#contact_epinjam').val();
    var amount = $('#amount_epinjam').val();
    var purpose = $('#purpose_epinjam').val();
    var item = $('#item_name_epinjam').val();

    if (name != '') {
        if (section != '') {
            if (amount != '') {
                if (item != '') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                    url: "{{ route('epinjam.store') }}",
                    type: "POST",
                    data: $('#form-epinjam').serialize(),
                    success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                if (data.checkdata) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: data.errors
                                    });
                                } else {
                                    clearvaluecreate();
                                    Swal.fire(
                                        'Successfully!',
                                        'Added New Data!',
                                        'success'
                                    ).then(function () {
                                        $('#createModalEpinjam').modal('hide');
                                        // document.location.reload();
                                        $('#loan_items_datatables').DataTable().ajax.reload();
                                    })
                                }
                            } else {
                                printErrorMsg(data.error)
                            }

                        }
                    });
                } else {
                    Swal.fire(
                    'Error!',
                    'Item Name Cannot Be Empty!',
                    'warning'
                    ).then(function () {
                        $('#item_name_epinjam').focus();
                    })
                }
            } else {
                Swal.fire(
                'Error!',
                'Amount Cannot Be Empty!',
                'warning'
                ).then(function () {
                    $('#amount_epinjam').focus();
                })
            }
        }else{
            Swal.fire(
            'Error!',
            'Section Cannot Be Empty!',
            'warning'
            ).then(function () {
                $('#section_epinjam').focus();
            })
        }
    }else{
        Swal.fire(
            'Error!',
            'Name Cannot Be Empty!',
            'warning'
        ).then(function () {
            $('#name_epinjam').focus();
        })
    }

})

function clearvaluecreate()
{
    $('#name_epinjam').val("");
    // $('#section_epinjam').val("");
    $("#section_epinjam").select2('val', '-Select Section-');
    $('#contact_epinjam').val("");
    $('#amount_epinjam').val("");
    $('#purpose_epinjam').val("");
    $('#item_name_epinjam').val("");

    // $("#section_epinjam option[selected]").prop('selected', true);
}

//  RETURN
$(document).on('click', '.return', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
         var id = $(this).attr('row-id');
         var item = $(this).attr('data-id');

            return_(id,item)

})
//RETURN
function return_(id, item){
    Swal.fire({
        title: 'Are you sure you return this item?',
        text: "Item Name :" + item,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Return this item!'
    }).
    then((willPosted) => {
        var route  = "{{ route('epinjam.return', ':id') }}";
        route  = route.replace(':id', id);
        if(willPosted.value){
            $.ajax({
                url: route,
                type: "POST",
                data : {
                    '_method' : 'POST'
                },
                success: function(data){
                    Swal.fire(
                        'Succesfully!',
                        'Item successfully returned!.',
                        'success',
                        ).then(function(){
                            // document.location.reload();
                            $('#loan_items_datatables').DataTable().ajax.reload();
                        });

                    },
                    error: function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Error Contact IT department!',
                        })
                    }
                })
        } else {
            console.log(`data was dismissed by ${willPosted.dismiss}`);
        }


    })
}
</script>
