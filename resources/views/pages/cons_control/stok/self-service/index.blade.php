@extends('layouts.admin')
@section('title', 'Pickup | Consumable IT')
@section('title-sub', 'Pickup Consumable IT')
{{-- @section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">IT Asset</a></li>
    <li class="breadcrumb-item ">Consumable Control</li>
    <li class="breadcrumb-item active">Stock</li>
</ol>
@endsection --}}

@section('content')
<div class="col-12">
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">Master Asset</h3>
        </div> --}}
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <button type="button" class="btn btn-primary mb-3" id="addMod"><i class="fa fa-plus"></i> Add Data</button>
            <table class="table table-hover w-full " id="mypickup_datatables">
                <thead style="background-color: #0069D9; color: #fff;">
                    <tr class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Nama Pengambil</th>
                        <th>Section</th>
                        <th>No Permintaan</th>
                        <th>Tanggal</th>
                    </tr>
                    </tr>
                </thead>
                <tbody id="body">

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>




@include('pages.cons_control.stok.self-service.modal.create')
@include('pages.cons_control.stok.self-service.modal.modal_item_stout')
@endsection
@push('page-script')
@include('pages.cons_control.stok.self-service.ajax_ss')

<script>

    $(document).ready(function(){
        //get data from datatables
        var table = $('#mypickup_datatables').DataTable({
          processing: true,
          serverSide: true,
          destroy:true,
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
    // $(document).ready(function(){
    //     setTimeout(() => {
    //     document.location.reload();
    //     }, 10000);
    // })
</script>
@endpush
