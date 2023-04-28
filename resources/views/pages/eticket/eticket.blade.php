@extends('layouts.admin')
@section('title', 'Eticket | MyHelpdesk')
@section('title-sub', 'Eticket')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="">Eticket</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
    {{-- <li class="breadcrumb-item active">Printer</li> --}}
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="col-md-12">
                <button class="btn btn-primary " data-toggle="modal" data-target="#myModalAdd"><i
                        class="fa fa-plus"></i> Add Ticket</button>
                <br><br>
                <table class="table table-hover dataTable table-striped w-full" id="myTable" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Time</th>
                            <th>No Ticket</th>
                            <th>Issue</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $no = 1;
                    ?>
                        @foreach($ticket as $t)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$t->date}}</td>
                            <td>{{$t->name }}</td>
                            <td>{{$t->time}}</td>
                            <td>{{$t->ticket_no}}</td>
                            <td>{{$t->issue}}</td>
                            <td>
                                    @if ($t->status == "1")
                                    <small class="text-info mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        Open
                                    </small>
                                    @elseif($t->status == "2")
                                    <small class="text-warning mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        On Process
                                    </small>
                                    @elseif($t->status == "3")
                                    <small class="text-danger mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        Pending
                                    </small>
                                    @elseif ($t->status == "4")
                                    <small class="text-success mr-1">
                                        <i class="fas fa-arrow-up"></i>
                                        Close
                                    </small>
                                    @endif
                            </td>
                            <td>
                                <a href="/eticket/detailU/{{$t->id}}" class="btn-sm btn-info"><i class="fa fa-bars"></i>
                                    Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>





@endsection

<div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="/eticket/store">
                    {{csrf_field()}}
                    <div class="col-md-3 form-group">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{auth()->user()->nik}}"
                            disabled>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="id_user" class="form-control" id="name" value="{{auth()->user()->name}}"
                            disabled>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="name" class="form-label">No Ticket</label>
                        <input type="text" name="name" class="form-control" id="no_ticket" disabled>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="name" class="form-label">Issue</label>
                        <textarea class="form-control" rows="3" name="issue" placeholder="Enter ..."></textarea>
                    </div>
                    {{-- <div class="col-md-12 form-group">
                        <label for="name" class="form-label">Attachment File</label>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div> --}}
                    <div class="col-md-12 form-group">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Simpan"><br>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
