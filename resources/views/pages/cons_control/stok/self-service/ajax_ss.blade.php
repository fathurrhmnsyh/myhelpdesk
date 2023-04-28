<script>
     // DISPLAY CREATE NEW
     $(document).on('click','#addMod', function(e){
        // alert('OK');
        e.preventDefault();
        $('#stoutModal').modal('show');
        // $('#ttf_create_detail').DataTable().clear().destroy();
        $('.modal-title').text('Self Pickup ');

        var route ='{{ route("stok.auto_number_perm_ss") }}';
            $.get(route, function (data) {
                document.getElementById('no_perm').value = data;
                    // $('#setdate').focus();
            });

    })
    //ADD ROW
    $(document).ready(function() {
        $('#addRow2').click(function(){
        var date = document.getElementById('date1').value;
        var no_perm = document.getElementById('no_perm').value;
        var name = document.getElementById('name').value;
        var section = document.getElementById('section').value;
        if (date != '') {
            if (no_perm != '') {
                if (name != '') {
                    if (section != '') {
                        var t = $('#tbl-pickup-cons').DataTable();
                        var counter = t.rows().count();
                        var jml_row = Number(counter) + 1;

                        document.getElementById('jml_row').value = jml_row;

                        var barang = "barang" + jml_row;
                        var jumlah = "jumlah" + jml_row;



                            t.row.add( [
                                '<input type="text" name="no[] " id="" value="'+jml_row+'"  class="form-control form-control" readonly>',
                                // '<input type="text" name="barang[] " id="'+barang+'" onkeydown="keyPressedItem(event)" placeholder="ENTER" class="form-control form-control">',
                                '<div class="input-group">'+
                                    '<input type="text" value="" placeholder="Search Item" autocomplete="off"'+
                                    'id="'+ barang +'"  name="barang[]" required  class="form-control form-control barang" readonly>'+
                                    '<span class="input-group-btn">'+
                                        '<button type="button" id="btnPopUpBarang"  data-row='+jml_row+'  data-id='+jml_row+' class="btn btn-info ">'+
                                        '<i class="fas fa-search"></i>'+
                                        '</button>'+
                                    '</span>'+
                                '</div>',
                                '<input type="number"  name="jumlah[]"  id="'+jumlah+'" class="form-control form-control">',
                                '<a href="#" class="btn btn-danger destroy"><i class=" fa fa-trash remove"></i></a>',
                            ] ).draw();
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Section Cannot Empty',
                        }).then(function () {
                            setTimeout(() => $("#section").focus(), 500)
                        });
                    }
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: 'Name Cannot Empty',
                    }).then(function () {
                        setTimeout(() => $("#name").focus(), 500)
                    });
                }

            }else{
                Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'No Transaction Cannot Empty',
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
    });

    //  INSERT VIA AJAX
$('.modal-footer').on('click', '.savePickup', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var tbl = $('#tbl-pickup-cons').DataTable();
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
                        url: "{{ route('stok.store_stout_ss') }}",
                        type: "POST",
                        data: $('#form-stout').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                if (data.checkdata) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: data.errors
                                    });
                                    clear_value_create_page_ss();
                                    // clear_table_when_input_data_same();
                                } else {
                                    // $('.saveStin').html('Saving...')
                                    clear_value_create_page_ss();
                                    Swal.fire({
                                        icon: "success",
                                        title: "Reducing Stock! Thank You",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function () {
                                        $('#stoutModal').modal('hide');
                                        // document.location.reload();
                                        $('#mypickup_datatables').DataTable().ajax.reload();
                                    });
                                }
                            } else {
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

    // DELETE ROW IN ADD ITEM
    $(document).on('click', '.destroy', function () {
        var table = $('#tbl-pickup-cons').DataTable();
        $('#tbl-pickup-cons tbody').on('click', 'tr', function () {
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

    $(document).on('click', '#btnPopUpBarang', function () {
        let row = $(this).data('row');
        $('#itemModal').modal('show');
        $('#row-clicked').val(row);
    })

    $('#btnPopUpBarang').on('hide.bs.modal', function () {
        $('#row-clicked').val('');
    });

    function clear_value_create_page_ss() {
        // $('#date1').val("");
        $('#no_perm').val("");
        $('#name').val("");
        $('#section').val("");
        var table = $('#tbl-pickup-cons').DataTable();
        table.rows().remove().draw();

    }
    function clear_value_store_ss() {
        // $('#date1').val("");
        $('#no_perm').val("");
        $('#name').val("");
        $('#section').val("");
        var table = $('#tbl-pickup-cons').DataTable();
        table.rows().remove().draw();

    }



</script>
