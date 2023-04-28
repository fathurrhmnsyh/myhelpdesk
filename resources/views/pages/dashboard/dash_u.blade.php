@extends('layouts.admin')
@section('title', 'Dashboard | MY HELPDESK')
@section('title-sub', 'Dashboard')
{{-- @section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">DataTables</li>
</ol>
@endsection --}}

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h6 align="right">
                <?php
                    $tgl=date('l, d-m-Y');
                    echo $tgl;
                ?>
            </h6>
            <h5 class="card-title">Choose Services</h5>&nbsp;&nbsp;&nbsp;<span><a href=""><i class="fa fa-spinner"></i></a></span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Info boxes -->
            <div class="row">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6" data-id="eticket" id="box">
                            <!-- small box -->
                            <div class="small-box" style="background:#1abc9c; color: #fff; ">
                                <div class="inner">
                                    <h4>ETICKET</h4>

                                    <p>for IT Helpdesk Reporting</p>
                                </div>
                                {{-- <img src="{{url('backend/dist/images/toner.png')}}" alt="" style="width: 70%;
                                height:50%; align:right"> --}}
                                <div class="icon">
                                    {{-- <i class="ion ion-bag"></i> --}}
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6" data-id="pickup_cons" id="box">
                            <!-- small box -->
                            <div class="small-box" style="background: #f1c40f; color: #fff; ">
                                <div class="inner">
                                    <h4>PICKUP CONSUMABLE</h4>

                                    <p>for pickup consumable IT</p>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-stats-bars"></i> --}}
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6" data-id="epinjam" id="box">
                            <!-- small box -->
                            <div class="small-box" style="background: #e74c3c; color: #fff; ">
                                <div class="inner">
                                    <h4>E-PINJAM</h4>

                                    <p>for borrowing IT items</p>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-person-add"></i> --}}
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        {{-- <div class="col-lg-3 col-6" data-id="kanban_lokal" id="box">
                            <div class="small-box" style="background: #3498db; color: #fff; ">
                                <div class="inner">
                                    <h4>KANBAN LOKAL</h4>

                                    <p>for manufacturing</p>
                                </div>
                                <div class="icon">
                                </div>
                                <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> --}}
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">E-pinjam</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Info boxes -->
            <div class="container-fluid">
                    <table class="table table-hover w-full " id="loan_items_datatables">
                        <thead style="background-color: #0069D9; color: #fff;">
                            <tr class="text-center">
                                <th style="width: 5%">No</th>
                                <th style="width: 10%">Name</th>
                                <th style="width: 10%">Section</th>
                                <th style="width: 10%">Contact</th>
                                <th style="width: 10%">Item</th>
                                <th style="width: 10%">Amount</th>
                                <th style="width: 10%">Purpose</th>
                                <th style="width: 15%">Date</th>
                                <th style="width: 15%">Return Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="body">

                        </tbody>

                    </table>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Self Pickup Consumables IT</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Info boxes -->
            <div class="container-fluid">
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
                <!-- /.row -->

            </div>
            <!-- /.card-body -->
        </div>

    </div>
</div>

@include('pages.cons_control.stok.self-service.modal.create')
@include('pages.cons_control.stok.self-service.modal.modal_item_stout')
@include('pages.loan_item.modal.create')
@endsection
@push('page-script')
@include('pages.dashboard.ajax_pickup_cons')
@include('pages.dashboard.ajax_epinjam')
<script>
    $(document).on('click', '#box', function () {
        var id = $(this).attr('data-id');

        if (id == 'pickup_cons') {
            $('#stoutModal').modal('show');
            // $('#ttf_create_detail').DataTable().clear().destroy();
            $('.modal-title').text('Self Pickup ');

            var route = '{{ route("stok.auto_number_perm_ss") }}';
            $.get(route, function (data) {
                document.getElementById('no_perm').value = data;
                // $('#setdate').focus();
            });
        } else if (id == 'epinjam') {
            $('#createModalEpinjam').modal('show');
            $('.modal-title').text('EPinjam  Entry');
        }
    });

    window.setTimeout( function() {
      window.location.reload();
    }, 1500000);
</script>
@endpush
