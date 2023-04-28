<script>
    $(document).ready(function(){
        //get data from datatables
        var table = $('#mypickup_datatables').DataTable({
            processing: true,
            serverSide: true,
            destroy:true,
            pageLength : 5,
            ajax: {
                url: "{{ route('stok.get_datatables') }}",
                type: "POST",
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            
            order: [
                [0, 'asc']
            ],
            responsive: true,
            columns: [{
                    data: 'no',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'barang_name',
                    name: 'barang_name'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
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
                    data: 'no_perm',
                    name: 'no_perm'
                },
                {
                    data: 'date',
                    name: 'date'
                }
            ],
            order : [[0, 'dsc']]
    });
});
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
//GET ITEM
var url_select_item = "{{ route('stok.get_data_item_ss') }}";
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
    $("#section").select2('val', '-Select Section-');
    var table = $('#tbl-pickup-cons').DataTable();
    table.rows().remove().draw();

}
function clear_value_store_ss() {
    // $('#date1').val("");
    $('#no_perm').val("");
    $('#name').val("");
    $("#section").select2('val', '-Select Section-');
    var table = $('#tbl-pickup-cons').DataTable();
    table.rows().remove().draw();

}
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
                                    title: "Data Input Successfully!",
                                    showConfirmButton: true,
                                    // timer: 1500
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
</script>