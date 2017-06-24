@extends('index')
@section('content')
    <div class="uk-margin-small-top uk-margin-small-left uk-margin-small-right ">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-card uk-card-default uk-card-body uk-margin-remove-bottom r1">
                    <div uk-grid>
                        <div class="uk-width-1-2">
                            <ul class="uk-breadcrumb">
                                <li><span uk-icon="icon: home; ratio: 1"></span> <a href="#">Home</a></li>
                                <li><a href="#">Maping</a></li>
                                <li><a href="#">Jenis</a></li>
                                <li><a href="#">Review</a></li>
                            </ul>
                        </div>
                        <div class="uk-width-1-2">
                            <div class="uk-margin-remove-bottom uk-text-right">
                                <span class="uk-margin-small-right" uk-icon="icon: check"></span>
                                <span uk-icon="icon: cog"></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@m uk-margin-small-top ">
                <div class="uk-card uk-card-default uk-card-body r2">
                    <div class="uk-panel uk-panel-scrollable h-panel">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                                <thead>
                                <tr>
                                    <th class="uk-table-shrink">No</th>
                                    <th class="uk-table-expand">Data Asli</th>
                                    <th class="uk-table-expand">Maping sementara</th>
                                    <th class="uk-table-expand">Hasil Review</th>
                                    <th class="uk-table-shrink uk-text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button uk-toggle="target: #modal-example" class="uk-button-danger"
                                                uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
                                    <td class="uk-text-truncate">Administrator</td>
                                    <td class="uk-text-nowrap">
                                        <button class="uk-button-primary" uk-icon="icon: tag; ratio: 1"></button>
                                        <button class="uk-button-primary" uk-icon="icon: pencil; ratio: 1"></button>
                                        <button class="uk-button-danger" uk-icon="icon: ban; ratio: 1"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>a</td>
                                    <td>b</td>
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

    <div id="my_id" uk-offcanvas="flip:true">
        <div class="uk-offcanvas-bar biru-4 off_kanan">
            <button class="uk-offcanvas-close" type="button" uk-close></button>

        </div>
    </div>
    <div id="modal-example" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">

            <button class="uk-modal-close-default" type="button" uk-close></button>

            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Sampel Data</h2>
            </div>

            <div class="uk-modal-body " uk-overflow-auto>
                <div class="" uk-grid>
                    <div class="uk-width-1-3">
                        <select>
                            <option>pemda a</option>
                            <option>pemda b</option>
                            <option>pemda c</option>
                        </select>
                        <div id="pemda_1">
                            <table id="pemda_1_t">
                                <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>kodesatker</td>
                                    <td>999009</td>
                                </tr>
                                <tr>
                                    <td>kodesatker</td>
                                    <td>999009</td>
                                </tr>
                                <tr>
                                    <td>kodesatker</td>
                                    <td>999009</td>
                                </tr>
                                <tr>
                                    <td>kodesatker</td>
                                    <td>999009</td>
                                </tr>
                                <tr>
                                    <td>kodesatker</td>
                                    <td>999009</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="uk-width-1-3">
                        <div class="pemda_2">
                            <select>
                                <option>pemda a</option>
                                <option>pemda b</option>
                                <option>pemda c</option>
                            </select>
                            <div id="pemda_1">
                                <table id="pemda_1_t">
                                    <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>kodesatker</td>
                                        <td>999009</td>
                                    </tr>
                                    <tr>
                                        <td>kodesatker</td>
                                        <td>999009</td>
                                    </tr>
                                    <tr>
                                        <td>kodesatker</td>
                                        <td>999009</td>
                                    </tr>
                                    <tr>
                                        <td>kodesatker</td>
                                        <td>999009</td>
                                    </tr>
                                    <tr>
                                        <td>kodesatker</td>
                                        <td>999009</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="uk-width-1-3">
                            c
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
        <script type="text/javascript">

        </script>
    @endpush