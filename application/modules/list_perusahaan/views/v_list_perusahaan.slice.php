@extends('layouts.backend')

@section('title','Llist Perusahaan')

@section('css')
    <link href="<?=base_url('assets/plugins/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
@endsection

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>List Perusahaan</h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Perusahaan</h2>
                        <div class="navbar-right">
                            <a href="<?=base_url('list_perusahaan/add')?>">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </a>
                        </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="20%">Nama Perusahaan</th>
                                <th width="20%">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($list_perusahaan as $key => $value): ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$value['nama_perusahaan']?></td>
                                    <td>
                                        <ul style="list-style: none;padding-left: 0px;padding-right: 0px; text-align: center;">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bars" style="font-size: large;"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="right: 0; left: auto;">
                                                    <li>
                                                        <a href="<?=base_url('list_perusahaan/update/'.encode($value['id_perusahaan']))?>">
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#" class="btn-delete" data-id="<?=encode($value['id_perusahaan'])?>">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- datatables -->
    <script src="<?=base_url('assets/plugins/datatables/js/jquery.dataTables.js')?>"></script>
    <script src="<?=base_url('assets/plugins/datatables/js/dataTables.bootstrap.js')?>"></script>
    <!-- delete js -->
    <script src="<?=base_url('assets/js/delete.js')?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection