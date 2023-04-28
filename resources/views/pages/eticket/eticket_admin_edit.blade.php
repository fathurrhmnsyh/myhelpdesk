@extends('layouts.admin')
@section('title', 'Eticket | MyHelpdesk')
@section('title-sub', 'Edit Ticket')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="">Eticket</a></li>
    <li class="breadcrumb-item ">Admin</li>
    <li class="breadcrumb-item">Detail</li>
    <li class="breadcrumb-item active">Edit</li>
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <form class="row g-3" method="post" action="/eticket/update/{{$eticket->id}}" id="form-edit">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="col-md-3">
                        <input type="text" name="id" id="id" value="{{$eticket->id}}" hidden>
                        <label for="ticket_no" class="form-label">Ticket No</label>
                        <input type="text" name="ticket_no" class="form-control" id="ticket_no"
                            value="{{$eticket->ticket_no}}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="date"
                            value="{{$eticket->date}}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" id="time"
                            value="{{$eticket->time}}" disabled>
                    </div>
                    <div class="col-md-3">
                        <label for="id_user" class="form-label">User</label>
                        <input type="text" name="id_user" class="form-control" id="id_user"
                            value="{{$eticket->name}}" disabled>
                    </div>
                    <div class="col-md-12">
                        <label for="issue" class="form-label">Issue</label>
                        <textarea class="form-control" rows="3" disabled>{{$eticket->issue}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="problem" class="form-label">Problem</label>
                        <textarea class="form-control" rows="3" name="problem" >{{$eticket->problem}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="serial_number" class="form-label">Problem Type</label>
                        <select class="form-control js-example-basic-single" name="problem_type">
                            <option value="{{$eticket->problem_type}}" selected='selected'>{{$eticket->problem_type}}</option>
                            <option value="Email">Email</option>
                            <option value="Fan">Fan</option>
                            <option value="Heatsink">Heatsink</option>
                            <option value="LAN">LAN</option>
                            <option value="Mainboard">Mainboard</option>
                            <option value="Monitor">Monitor</option>
                            <option value="Power Supply">Power Supply</option>
                            <option value="Printer">Printer</option>
                            <option value="RAM">RAM</option>
                            <option value="TBS">TBS</option>
                            <option value="TMS">TMS</option>
                            <option value="VGA">VGA</option>
                            <option value="HDMI">HDMI</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="serial_number" class="form-label">Solution</label>
                        <textarea class="form-control" rows="3" name="solution" >{{$eticket->solution}}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="rep_part" class="form-label">Replacement Part</label>
                        <input type="text" name="rep_part" class="form-control" id="rep_part"
                            value="">
                    </div>
                    <div class="col-md-3">
                        <label for="type_asset" class="form-label">Type Asset</label>
                        <select id="asset_type" name="asset_type" class="form-control" >
                            <option value="{{$eticket->id_asset}}" selected='selected'>{{$eticket->id_asset}}</option>
                            <option value=""></option>
                            <option value="komputer" >Komputer</option>
                            <option value="laptop">Laptop</option>
                            <option value="printer">Printer</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="id_kode_fa" class="form-label">ID Kode FA</label>
                        <select class="form-control js-example-basic-single" name="id_kode_fa" id="id_kode_fa">
                            <option value="{{$eticket->id_kode_fa}}" selected='selected'>{{$eticket->id_kode_fa}}</option>
                         
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="serial_number" class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="{{$eticket->status}}" selected='selected'>
                                @if ($eticket->status == "1")
                                    Open
                                @elseif($eticket->status == "2")
                                    On Process
                                @elseif($eticket->status == "3")
                                    Pending
                                @elseif($eticket->status == "4")
                                   Close 
                                @endif
                                </option>
                            <option value="1">Open</option>
                            <option value="2">On Progress</option>
                            <option value="3">Pending</option>
                            <option value="4">Close</option>
                        </select>
                        
                    </div>
                    <div class="col-md-12">
                        <br>
                        <input class="btn btn-warning" action="action" onclick="window.history.go(-1); return false;"
                            type="submit" value="Cancel" />
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
                <section class="content-header">
                    
                </section>
            </div>
        </div> 
    </div>
    <!-- /.card -->
</div>

@endsection

@push('page-script')
<script type="text/javascript">
    jQuery(document).ready(function () {
        
        jQuery('select[name="asset_type"]').on('change', function () {
                jQuery.ajax({
                    url: '/eticket/edit/getkom/{id}',
                    type: "GET",
                    dataType: "json",
                    data: $('#form-edit').serialize(),

                    success: function (data) {
                        console.log(data);
                        jQuery('select[name="id_kode_fa"]').empty();
                        jQuery.each(data, function (key, value) {
                            $('select[name="id_kode_fa"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
            
            });
    });

</script>
<script type="text/javascript">
     $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
</script>
@endpush

    






