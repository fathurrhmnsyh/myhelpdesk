@extends('layouts.admin')
@section('title', 'Trans History | Consumable Control')
@section('title-sub', 'Transaction History')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">Consumable Control</a></li>
    <li class="breadcrumb-item active">Transaction History</li>
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
          <p>Export Report</p>
          <form id="export-by-item" class="form-inline">

              @csrf
              @method('POST')
              <div class="form-group mb-2">
                  <label for="">Type :&nbsp;</label>
                  <select name="type" id="type_filter" class="form-control form-control-sm">
                      <option value="" selected disabled></option>
                      <option value="stin">Stock In</option>
                      <option value="stout">Stock Out</option>
                  </select>
              </div>
              <div class="form-group mx-sm-3 mb-2">
                  <label for="">Item Name :&nbsp;</label>
                  <select name="item_name" id="item_name_filter" class="form-control form-control-sm">
                      <option value="" selected>All</option>
                      @foreach($stok as $st)
                          <option value="{{ $st->barang_name}}">{{ $st->barang_name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group mx-sm-3 mb-2">
                  <label for="">Start Date :&nbsp;</label>
                  <input type="date" name="start" class="form-control form-control-sm" id="start-date">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                  <label for="">End Date : &nbsp;</label>
                  <input type="date" name="end" class="form-control form-control-sm" id="end-date" >
              </div>
              <div class="form-group mx-sm-3 mb-2">
                  <label for="">Export To&nbsp;</label>
                  <select name="export_type" id="export_type" class="form-control form-control-sm">
                      <option value="pdf" selected>PDF</option>
                      {{-- <option value="excel">Excel</option> --}}
                  </select>
              </div>
              <button type="submit" class="btn btn-sm btn-primary mb-2 exportData"><i class="fa fa-save"></i> Export</button>
          </form>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Stock Out</h3>
        </div>
        <div class="card-body">
            <table id="table-so" class="table table-hover table-striped w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <!-- <th>Barang ID</th> -->
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Nama Pengambil</th>
                        <th>Section</th>
                        <th>No Permintaan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Stock In</h3>
        </div>
        <div class="card-body">

            <table id="table-si" class="table table-hover table-striped w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>No PPB</th>
                        <th>Tanggal </th>
                    </tr>
                </thead>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@push('page-script')
<script>
    $(function () {
        $('#table-so').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            'url':'{!!url("/stok/transaksi_riwayat_out")!!}',
            'type': 'POST',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            },
            // ajax: '/stok/transaksi_riwayat_out',
            columns: [{
                    data: 'no',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                // {
                //     data: 'barang_id',
                //     name: 'barang_id'
                // },
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
        $('#table-si').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/stok/transaksi_riwayat_in',
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
                    data: 'no_ppb',
                    name: 'no_ppb'
                },
                {
                    data: 'date',
                    name: 'date'
                }
            ],
            order : [[0, 'dsc']]
        });
    });
    // $(document).ready(function(){
    //     setTimeout(function() {
    //         location.reload();
    //     }, 10000);
    // })
    $('#export-by-item').submit(function(event) {
            // alert('ss');
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '{{route('stok.filter_data_item') }}?' + formData,
                type: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var file = new Blob([response], {type: 'application/pdf'});
                    var fileURL = URL.createObjectURL(file);
                    window.open(fileURL);
                }
            });
        });
    


</script>
@endpush
