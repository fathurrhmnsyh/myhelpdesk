<!-- Modal Stok In -->
{{-- <div class="modal fade" id="myModalstin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">Stock In</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/stok/in">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Date</label>
                        <input type="hidden" name="input_by" class="form-control" value="{{auth()->user()->name}}">
                        <input type="date" name="date" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label>No PPB</label>
                        <input type="text" name="no_ppb" class="form-control" placeholder="No PPB">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div> --}}


<div class="modal fade bd-example-modal-lg modalcreate" data-backdrop="static" data-keyboard="false"
    style="z-index: 1041" tabindex="-1" id="myModalstin" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Stock In</h4>
                <h4 class="modal-title"></h4>
                {{-- <h4 class="modal-title">Stock In (NEW)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                {{-- <button type="button" class="close" data-dismiss="modal" onclick="clear_value_create_page()"><span>&times;</span></button> --}}
            </div>
            <div class="row">
                <div class="col">
                    <div class="modal-body create-modal">
                        <div class="alert alert-danger print-error-msg" role="alert" style="display: none">
                            <ul></ul>
                        </div>
                        <form id="form-ip" method="post" action="javascript:void(0)">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="id_stout" name="id_stout">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="hidden" name="input_by" class="form-control" value="{{auth()->user()->name}}">
                                <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                            </div>
                            <div class="form-group">
                                <label>No PPB</label>
                                <input type="number" name="no_ppb" id="no_ppb" class="form-control" placeholder="No PPB">
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="datatable datatable-primary">
                                        <div class="table-responsive">
                                            <table id="tbl-st-in" class="table table-bordered table-hover"
                                                width="100%">
                                                {{-- style="background-color: #D3D3D3" --}}
                                                <thead class="text-center">
                                                    <tr>
                                                        <th width="2%">No</th>
                                                        <th width="86%">Barang Name</th>
                                                        <th width="10%">Quantity</th>
                                                        <th width="2%">
                                                            {{-- ACTION --}}
                                                            <button type="button" data-toggle="tooltip"
                                                                data-placement="top" title="Add Item"
                                                                class="btn btn-danger btn-xs" id="addRow"> <i
                                                                    class="fa fa-plus"></i></button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-info" id="addRow"> Add Item</button> --}}
                        <button type="button" onclick="clear_value_create_page()" class="btn btn-info "
                            data-dismiss="modal">Close</button>
                        <button type="button" id="stin_trans" class="btn btn-info saveStin"><i class="ti-check"></i>
                            Save</button>

                        {{-- @php $counter @endphp --}}
                        <input type="hidden" id="jml_row" name="jml_row" value="">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('page-script')
<script>
    $(document).ready(function() {
        $('#addRow').click(function(){
        var date = document.getElementById('date').value;
        var no_ppb = document.getElementById('no_ppb').value;
        if (date != '') {
            if (no_ppb != '') {
                var t = $('#tbl-st-in').DataTable();
                var counter = t.rows().count();
                var jml_row = Number(counter) + 1;

                document.getElementById('jml_row').value = jml_row;

                var barang = "barang" + jml_row;
                var jumlah = "jumlah" + jml_row;



                    t.row.add( [
                        '<input type="text" name="no[] " id="" value="'+jml_row+'"  class="form-control form-control-sm" readonly>',
                        // '<input type="text" name="barang[] " id="'+barang+'" onkeydown="keyPressedItem(event)" placeholder="ENTER" class="form-control form-control-sm">',
                        '<div class="input-group">'+
                            '<input type="text" value="" placeholder="Search Item" autocomplete="off"'+
                            'id="'+ barang +'"  name="barang[]" required  class="form-control form-control-sm barang" readonly>'+
                            '<span class="input-group-btn">'+
                                '<button type="button" id="btnPopUpBarang"  data-row='+jml_row+'  data-id='+jml_row+' class="btn btn-info btn-xs">'+
                                '<i class="fas fa-search"></i>'+
                                '</button>'+
                            '</span>'+
                        '</div>',
                        '<input type="text"  name="jumlah[]"  id="'+jumlah+'" class="form-control form-control-sm">',
                        '<a href="#" class="btn btn-xs btn-danger destroy2"><i class=" fa fa-trash remove"></i></a>',
                    ] ).draw();
            }else{
                Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'No PPB Cannot Empty',
                }).then(function () {
                    setTimeout(() => $("#no_ppb").focus(), 500)
                });
            }
        }else{
            Swal.fire({
            icon: 'error',
            title: 'Error...',
            text: 'Date Cannot Empty',
            }).then(function () {
                setTimeout(() => $("#date").focus(), 500)
            });

        }




    });
    } );


    $(document).on('click', '#btnPopUpBarang', function () {
        let row = $(this).data('row');
        $('#itemModal').modal('show');
        $('#row-clicked').val(row);
    })

    $('#btnPopUpBarang').on('hide.bs.modal', function () {
        $('#row-clicked').val('');
    });

    function clear_value_create_page() {
        $('#date').val("");
        $('#no_ppb').val("");
        var table = $('#tbl-st-in').DataTable();
        table.rows().remove().draw();

    }
    function clear_value_store() {
        $('#date').val("");
        $('#no_ppb').val("");
        var table = $('#tbl-st-in').DataTable();
        table.rows().remove().draw();

    }


    //GET ITEM
    var url_select_item = "{{ route('stok.get_data_item') }}";
    var lookUpdataItem = $('#lookUpdataItem').DataTable({
        "pagingType": "numbers",
        "searching": true,
        processing: true,
        serverSide: true,
        ajax: url_select_item,
        responsive: true,
        paging: true,
        fixedHeader: true,
        "bFilter": false,
        "order": [
            [1, 'asc']
        ],
        columns: [{
                data: 'barang_name',
                name: 'barang_name'
            },
            {
                data: 'barang_category',
                name: 'barang_category'
            }

        ],
        "bDestroy": true,
        "initComplete": function (settings, json) {
            // $('div.dataTables_filter input').focus();
            $('#lookUpdataItem tbody').on('dblclick', 'tr', function () {
                var dataArr = [];
                var rows = $(this);
                var rowData = lookUpdataItem.rows(rows).data();
                let row_click = document.getElementById('row-clicked').value;
                $.each($(rowData), function (key,value){
                    // var barang_nameX = value["barang_name"];
                    // document.getElementById("barang_name" + row_click);
                    var barang_name = document.getElementById("barang" + row_click).value = value["barang_name"];
                    $('#itemModal').modal('hide');

                });
            });
        },

    });

// DELETE ROW IN ADD ITEM
$(document).on('click', '.destroy2', function () {
    var table = $('#tbl-st-in').DataTable();
    $('#tbl-st-in tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    var index = table.row('.selected').indexes();
    table.row(index).remove().draw(false);
    var jml_row = document.getElementById("jml_row").value.trim();
    jml_row = Number(jml_row) + 1;
    nextRow = table.rows().count() + 1;
});

//  INSERT VIA AJAX
$('.modal-footer').on('click', '.saveStin', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tbl = $('#tbl-st-in').DataTable();
    var tbl_arr = tbl.rows().data().toArray();
    var tbl_len = tbl_arr.length;
    var found_barang = 0;
    var found_jumlah = 0;

    var counter = tbl.rows().count();

    for (i = 0; i < tbl_len; i++) {
        var get_row_barang = tbl.rows({}).cell(i, 1).nodes().to$().find('input').val();
        var get_row_jumlah = tbl.rows({}).cell(i, 2).nodes().to$().find('input').val();

        if (get_row_barang == null || get_row_barang == '') {
            found_barang++;
            // $('#descript' + found_desc).addClass('alert-danger');
        }
        if (get_row_jumlah == null || get_row_jumlah == '') {
            found_jumlah++;
            // $('#quantity' + found_qty).addClass('alert-danger');

        }

    }

    if (counter > 0) {
            if (found_barang == 0) {
                if (found_jumlah == 0) {
                    $.ajax({
                        url: "{{ route('stok.store_stin') }}",
                        type: "POST",
                        data: $('#form-ip').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                if (data.checkdata) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: data.errors
                                    });
                                    clear_value_store();
                                    // clear_table_when_input_data_same();
                                } else {
                                    // $('.saveStin').html('Saving...')
                                    clear_value_store();
                                    Swal.fire(
                                        'Successfully!',
                                        'Add New Stock!',
                                        'success'
                                    ).then(function () {
                                        $('#myModalstin').modal('hide');
                                        $('#table-stock').DataTable().ajax.reload();
                                    })
                                }
                            } else {
                                //     Swal.fire({
                                //     icon: 'warning',
                                //     title: 'Warning',
                                //     text: 'Perhatikan Inputan Anda! Form Tidak Boleh Ada Yang Kosong',
                                //   });
                                printErrorMsg(data.error)
                            }

                        }
                    })

                }else{
                    Swal.fire({
                    icon: 'warning',
                    title: 'Data Qty empty!!!'
                });
                }
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Item Empty!!!'
                });
            }
    }else{
        Swal.fire({
            icon: 'warning',
            title: 'Data Tidak Tersimpan',
            text: 'Tidak ada data!!!'
        });
    }


    // $(document).on('click', '#stin_trans', function () {
    //     var st_choice = $('#tbl-st-in').DataTable();
    //         var convrtArr = st_choice.rows().data().toArray();
    //         var length = convrtArr.length;
    //         // console.log(length);
    //         // console.log(convrtArr);
    //         var id = 0;
    //         var count = 0;
    //         var nu = 0;

    //         for (i = 0; i < length; i++) {
    //             var inval_qty = st_choice.rows({}).cell(i, 2).nodes().to$().find('input').val();
    //             var inval_brg_name = st_choice.rows({}).cell(i, 1).nodes().to$().find('input').val();

    //             var data_input =  [ inval_brg_name,inval_qty];

    //             var route = "";
    //             // route = route.replace(':id', ip_no);
    //             $.ajax({
    //                     type : "POST",  //type of method
    //                     url  : route,  //your page
    //                     dataType: 'json',
    //                     data : {data_input },// passing the values
    //                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //                     success: function(data){
    //                         $('#stin_trans').html('Saving...')
    //                     }
    //                 });

    //             console.log(data_input)
    //         }


    // });

    function printErrorMsg(msg) {
        $('.print-error-msg').find('ul').html('');
        $('.print-error-msg').css('display', 'block');
        $('.addStout').html('Save')
        $.each(msg, function (key, value) {
            $('.print-error-msg').find('ul').append(
                '<li style="font-size: 15px"><i class="fa fa-exclamation-circle"></i> ' +
                value + '</ul>');
        });
    }
})


</script>
@endpush
