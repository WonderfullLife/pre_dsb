@extends('index')
@section('content')
    <div class="uk-margin-small-top uk-margin-small-left uk-margin-small-right ">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-card uk-card-default uk-card-body uk-margin-remove-bottom r1">
                    <ul class="uk-breadcrumb">
                        <li><span uk-icon="icon: home; ratio: 1"></span> <a href="#">Home</a></li>
                        <li><a href="#">Pengaturan</a></li>
                        <li><a href="#">Pengguna</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-1-6@m uk-margin-small-top ">
                <div class="uk-card uk-card-default uk-card-body uk-padding-small r2">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-nav-header nav-statistik"><b>Statistik Pengguna</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Pengguna
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    20
                                </div>
                            </div>
                        </li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Grup Pengguna
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    2
                                </div>
                            </div>
                        </li>
                        <li>
                            <div uk-grid>
                                <div class="uk-width-2-3 uk-text-left nav-statistik">
                                    Aktif
                                </div>
                                <div class="uk-width-1-3 uk-text-right text-oren-4">
                                    20
                                </div>
                            </div>
                        </li>
                        <li class="nav-statistik uk-nav-header"><b>Action</b></li>
                        <li class="uk-nav-divider uk-margin-remove-top"></li>
                        <li><a class="nav-statistik">Tambah pengguna</a></li>
                        <li><a class="logo uk-margin-auto-vertical nav-statistik">Tambah grup </a></li>
                    </ul>

                </div>
            </div>
            <div class="uk-width-5-6@m uk-margin-small-top ">
                <div class="uk-card uk-card-default uk-card-body r2">
                    <div class="uk-panel uk-panel-scrollable h-panel">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                                <thead>
                                <tr>
                                    <th class="uk-table-shrink"></th>
                                    <th class="uk-table-shrink"></th>
                                    <th class="uk-table-expand">Nama</th>
                                    <th class="uk-width-small">Grup</th>
                                    <th class="uk-table-shrink uk-text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input class="uk-checkbox" type="checkbox"></td>
                                    <td><img class="uk-preserve-width uk-border-circle"
                                             src="{{URL::asset('img/avatar.png')}}" width="40" alt=""></td>
                                    <td class="uk-table-link">
                                        <a class="uk-link-reset" href="">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do eiusmod tempor.</a>
                                    </td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection