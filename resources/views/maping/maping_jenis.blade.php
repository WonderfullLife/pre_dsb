@extends('index')
@section('content')
    <div class="uk-margin-small-top uk-margin-small-left uk-margin-small-right">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-card uk-card-default uk-card-body uk-margin-remove-bottom r1">
                    <ul class="uk-breadcrumb">
                        <li class="text-biru-5"><span uk-icon="icon: home; ratio: 1"></span> <a class="text-biru-5"
                                                                                                href="#">Home</a></li>
                        <li class="text-biru-5"><a class="text-biru-5" href="#">Maping</a></li>
                        <li><a href="#" class="text-biru-5">Jenis</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-5-6@m uk-margin-small-top">
                <div class="uk-card uk-card-default uk-card-body r2">
                    <div id="div_tabel" class="uk-panel uk-panel-scrollable h-panel uk-padding-remove-top">
                        <div class="uk-overflow-hidden">
                            <table id="tbl_map_jenis" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                                <thead uk-sticky="offset: 100; bottom: #top">
                                <tr>
                                    <th class="uk-text-center uk-text-middle text-biru-5 uk-table-shrink">
                                        <label><b>No.</b></label>
                                    </th>
                                    <th class="uk-text-center uk-text-middle text-biru-5 uk-table-expand"><label><b>Jenis
                                                tak standar</b></label></th>
                                    <th class="uk-text-center uk-text-middle text-biru-5 uk-table-shrink"><label><b>Di
                                                map
                                                menjadi</b></label></th>
                                    <th class="uk-text-center uk-text-middle text-biru-5">
                                        <label><span></span> </label></th>
                                </tr>

                                </thead>
                                <tbody class="list">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-6@m uk-margin-small-top ">
                <div class="uk-card uk-card-default uk-card-body uk-padding-small r2">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-nav-header nav-statistik"><b>Data tahun</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li>
                            <div class="uk-grid-small" uk-grid>
                                <div class="uk-width-3-5 uk-text-left nav-statistik">
                                    Pilih tahun
                                </div>
                                <div class="uk-width-2-5 uk-text-right text-oren-4">
                                    <select id="sel_tahun">
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li class="uk-nav-header nav-statistik"><b>Statistik 2016</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Total
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    23
                                </div>
                            </div>
                        </li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Sudah di maping
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    19
                                </div>
                            </div>
                        </li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Belum di maping
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    1
                                </div>
                            </div>
                        </li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Anomali
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    3
                                </div>
                            </div>
                        </li>
                        <li class="nav-statistik uk-nav-header"><b>Action</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li><a class="nav-statistik">Tambah pengguna</a></li>
                        <li><a class="logo uk-margin-auto-vertical nav-statistik">Tambah grup </a></li>
                        <li class="nav-statistik uk-nav-header"><b>Search</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li>
                            <div class="uk-margin">
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: search"></span>
                                    <input class="uk-input search" type="text">
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>

    <div id="modal_cari" class="uk-modal-container" uk-modal="center: true">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Contoh Data</h2>
            </div>
            <div class="uk-modal-body">
                <div uk-grid>
                    <div id="pil_satker" class="uk-width-1-1">

                    </div>
                    <div id="" class="uk-width-1-1">

                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="button">Save</button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{URL::asset('js/list.min.js')}}"></script>
<script src="{{URL::asset('js/select2.full.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/select2.css')}}"/>
<script type="text/javascript">
    $(document).ready(function () {
        var tahun = $("#sel_tahun").val();
        getJenis(tahun, 0, 10);

        function setRef() {
            var a = 2016;
            $.ajax({
                type: 'GET',
                url: "{{url('ref/jenis')}}/" + a,
                success: function (a) {
                    $('.refjenis').select2({
                        data: a
                    });
                }
            });

        }

        $("#sel_tahun").on('change', function () {
            tahun = $("#sel_tahun").val();
            $("#tbl_map_jenis").find('tr:not(:first)').remove();
            getJenis(tahun, 0, 10);
        });

        function getJenis(a, b, c) {
            $.ajax({
                type: 'GET',
                url: "{{url('data/jenis')}}/" + a + '/' + b + '/' + c,
                success: function (x) {
                    tambahBaris(x);
                }
            });
        }

        $("#tbl_map_jenis").on('click', '#btn_data', (function (event) {
            event.preventDefault();
            var link = $(this).attr('href');
            $.ajax({
                type: 'GET',
                url: link,
                success: function (x) {
                    tambahBaris(x);
                }
            });
        }));

        $("#tbl_map_jenis").on('click', 'a.btn_simpan', (function (event) {
            event.preventDefault();
            var link = $(this).attr('href');
            var val_map = $(this).closest('tr').find('select').val();
            var jen_id = $(this).closest('tr').attr('id');
            $(this).closest('tr').remove();
            console.log($jen_id);
            alert($jen_id)
        }));

        $("#tbl_map_jenis").on('click', 'a.btn_cari', (function (event) {
            event.preventDefault();
            var link = $(this).attr('href');
            var jen_id = $(this).closest('tr').attr('id');
            var div = '';
            $("#pil_satker").html();
            $.ajax({
                type: 'GET',
                url: "{{url('kodesatker/temp_jenis').'/'}}" + jen_id,
                success: function (x) {
                    div += '<select class="sel_satker">';
                    $.each(x, function (y, z) {
                        div += '<option value="z.value">' + z.text + '<option>';
                    });
                    div += "</select>";
                    $("#pil_satker").append(div);
                    $(".sel_satker").select2();
                }
            });

        }));

        function tambahBaris(x) {
            var $row = '';
            $("#ambil_data").remove();
            var a = x.cat.tahun;
            var b = Number.parseInt(x.cat.cur_posisi);
            var c = x.cat.limit;
            $.each(x.data, function (y, z) {
                b = b + 1;
                $row += '<tr id=' + z.id + '><td class="no">' + (b) + '</td><td class="nama"><label class="namajenis">' + z.kd_concat + ' ' + z.kd_text + '</label></td><td><select class="uk-select refjenis" name=""> <option value="0">-- Pilih --</option></select> </td> <td> <div><a uk-toggle="target: #modal_cari" type="button" class="btn_cari" href="#!"><span uk-icon="icon:  search"></span></a> <a href="' + z.kd_concat + '" class="btn_simpan" uk-icon="icon: check"></a> </div> </td></tr>';
            });
            $row += '<tr id="ambil_data"><td></td><td></td><td><a id="btn_data" href="{{url('data/jenis')."/"}}' + a + '/' + x.cat.next_posisi + '/' + c + '"><span uk-icon="icon: refresh "></span></a></td> <td></td></tr>';
            $('#tbl_map_jenis > tbody:last-child').append($row);
            setRef();
        }

        var options = {
            valueNames: ['no', 'nama']
        };
        var list = new List('tbl_map_jenis', options);

    })
</script>
@endpush()