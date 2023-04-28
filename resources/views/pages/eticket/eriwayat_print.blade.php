<html>

<head>
    <title>Laporan Eriwayat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}"> --}}

</head>

<body>
    <style type="text/css">
        th, td {
        padding-left: 8px;
        }
		table tr td,
		table tr th{
			font-size: 10pt;
		}
        .img-left{
        width:100px;
        height:30px;
        }
        .img-right{
            width:100px;
            height:50px;
            margin-top:-80px;
        }
        h4{
            margin-top:-20px;
        }
        h5{
            margin-top:-4px;
        }
	</style>
	<center>
        <div class="col" align="left">
            <img class="img-left" src="{{public_path('backend\dist\images\itcs-report-logo.png')}}" alt="">
        </div>
		<h4>PT Trimitra Chitrahasta</h4>
        <h5 style="text-transform: Capitalize">Eriwayat {{$eticket[0]->id_asset}} </a></h5>
        <div class="col" align="right">
            <img class="img-right" src="{{public_path('backend\dist\images\logo-tch.png')}}" alt="">
        </div>
        <br>
	</center>
    @if ($eticket[0]->id_asset == 'komputer')
        
    <table border="" width="700px" class="table-1">
        <tr>
            <td width="120px">Fixed Asset Code</td>
            <td width="200px">: &nbsp;{{$eticket[0]->kode_fa}}</td>
            <td width="120px">Hardisk Drive 1</td>
            <td width="240px">: &nbsp;{{$eticket[0]->hd1_merk}}&nbsp;{{$eticket[0]->hd1_kapasitas}} GB</td>
        </tr>
        <tr>
            <td width="120px">Processor</td>
            <td width="200px">: &nbsp;{{$eticket[0]->p_merk}} {{$eticket[0]->p_tipe}} {{$eticket[0]->p_jenis}} </td>
            <td width="120px">Hardisk Drive 2</td>
            <td width="240px">: &nbsp;{{$eticket[0]->hd2_merk}}&nbsp;{{$eticket[0]->hd2_kapasitas}} GB</td>
        </tr>
        <tr>
            <td width="120px">Mainboard</td>
            <td width="200px">: &nbsp;{{$eticket[0]->m_merk}} {{$eticket[0]->m_tipe}}</td>
            <td width="120px">Graphic Card</td>
            <td width="240px">: &nbsp;{{$eticket[0]->vga_external}}</td>
        </tr>
        <tr>
            <td width="120px">RAM</td>
            <td width="200px">: &nbsp;{{$eticket[0]->r_tipe}}, {{$eticket[0]->r_kapasitas}}
                GB,{{$eticket[0]->r_slot}} Channel</td>
            <td width="120px">Mac Address</td>
            <td width="240px">: &nbsp;{{$eticket[0]->lan_mac}}</td>
        </tr>
    </table>
    @elseif($eticket[0]->id_asset == 'laptop')
    <table border="" width="700px" class="table-1">
        <tr>
            <td width="120px">Fixed Asset Code</td>
            <td width="200px">: &nbsp;{{$eticket[0]->kode_fa}}</td>
            <td width="120px">Hardisk Drive</td>
            <td width="240px">: &nbsp;{{$eticket[0]->hd_merk}}&nbsp;{{$eticket[0]->hd_kapasitas}} GB</td>
        </tr>
        <tr>
            <td width="120px">Merk Laptop</td>
            <td width="200px">: &nbsp;{{$eticket[0]->lp_merk}} {{$eticket[0]->lp_tipe}} </td>
            <td width="120px">Graphic Card</td>
            <td width="240px">:  &nbsp;{{$eticket[0]->vga_merk}} &nbsp;{{$eticket[0]->vga_tipe}}
                &nbsp;{{$eticket[0]->vga_kapasitas}}</td>
        </tr>
        <tr>
            <td width="120px">Processor</td>
            <td width="200px">: &nbsp;{{$eticket[0]->p_merk}} {{$eticket[0]->p_jenis}} {{$eticket[0]->p_tipe}}</td>
            <td width="120px">LAN</td>
            <td width="240px">:  &nbsp;{{$eticket[0]->eth_name}}&nbsp;{{$eticket[0]->eth_mac}}</td>
        </tr>
        <tr>
            <td width="120px">RAM</td>
            <td width="200px">: &nbsp;{{$eticket[0]->r_tipe}}, {{$eticket[0]->r_kapasitas}}
                GB,{{$eticket[0]->r_slot}} Channel</td>
            <td width="120px">Wireless</td>
            <td width="240px">: &nbsp;{{$eticket[0]->wireless_name}} &nbsp;{{$eticket[0]->wireless_mac}}</td>
        </tr>
    </table>
    @else
    <table border="" width="700px" class="table-1">
        <tr>
            <td width="120px">Fixed Asset Code</td>
            <td width="200px">: &nbsp;{{$eticket[0]->kode_fa}}</td>
            <td width="120px">Purchase Date</td>
            <td width="240px">: &nbsp;{{$eticket[0]->purc_date}}</td>
        </tr>
        <tr>
            <td width="120px">Merk Printer</td>
            <td width="200px">: &nbsp;{{$eticket[0]->printer_merk}} {{$eticket[0]->printer_type}} </td>
            <td width="120px">PPB</td>
            <td width="240px">:  &nbsp;{{$eticket[0]->purc_ppb}}</td>
        </tr>
        <tr>
            <td width="120px">Serial Number</td>
            <td width="200px">: &nbsp;{{$eticket[0]->serial_number}} </td>
            <td width="120px">Status Printer</td>
            <td width="240px">:  &nbsp;{{$eticket[0]->status}}</td>
        </tr>
    </table>
    
    @endif
    
    <br>

    <table border="0.2" width="700px" class="table-2">
        <thead>
            <tr align="center">
                <th width="15px">No</th>
                <th width="75px">&nbsp;Date</th>
                <th width="120px">&nbsp;Issue</th>
                <th width="120px">&nbsp;Problem</th>
                <th width="130px">&nbsp;Solution</th>
                <th width="100px">&nbsp;Replc Part</th>
                <th width="90px">&nbsp;Technician</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $no = 1;
        ?>
            @foreach($eticket as $f)
            <tr>
                <td>&nbsp;{{$no++}}</td>
                <td>{{$f->date}}</td>
                <td>&nbsp;{{$f->issue}}</td>
                <td>&nbsp;{{$f->problem}}</td>
                <td>&nbsp;{{$f->solution}}</td>
                <td>&nbsp;{{$f->rep_part}}</td>
                <td>&nbsp;{{$f->technician}}</td>
            </tr>
            @endforeach

        </tbody>

    </table>



</body>

</html>
