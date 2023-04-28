@extends('layouts.admin')
@section('title', 'Eriwayat Computer | ITCS')
@section('title-sub', 'Eriwayat Computer')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="">Eticket</a></li>
    <li class="breadcrumb-item active">Eriwayat</li>
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <a href="/eriwayat/search" type="button" class="btn btn-warning mb-3"><i class="fa fa-search"></i> Print
                Data</a>
            {{-- <div class="example">
                <form class="form-inline" action="/eriwayat/cari" method="GET">
                    <div class="form-group">
                        <input type="text" name="cari" class="form-control" placeholder="Search FA Code .."
                            value="{{ old('cari') }}">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-outline" value="Search">
                    </div>
                </form>
            </div>
            <br>

            <p style="color: brown"><i>Copy FA Code then paste in search column </i></p>
            <br> --}}

            <br>
            <p style="color: brown"><i>Copy FA Code then click print data </i></p>

            <table id="table-eriwayat"  class="table table-hover table-striped w-full table-eriwayat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>FA Code</th>
                        <th width="70px">Date</th>
                        <th>Issue</th>
                        <th>Problem</th>
                        <th>Solution</th>
                        <th>Technician</th>
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
        $('.table-eriwayat').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/eticket/eriwayat',
            columns: [{
                    data: 'no',
                    name: 'no',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'id_kode_fa',
                    name: 'id_kode_fa'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'issue',
                    name: 'issue'
                },
                {
                    data: 'problem',
                    name: 'problem'
                },
                {
                    data: 'solution',
                    name: 'solution'
                },
                {
                    data: 'technician',
                    name: 'technician'
                }
            ],
            order: [
                [0, 'dsc']
            ]
        });
    });

</script>
@endpush
