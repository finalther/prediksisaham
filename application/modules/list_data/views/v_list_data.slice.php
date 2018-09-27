@extends('layouts.backend')

@section('title','SRS')

@section('css')
    <link href="<?=base_url('assets/plugins/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>List Data Perusahaan</h3>
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
                    <h2>List Data Perusahaan</h2>
                        <div class="navbar-right">
                            <a href="<?=base_url('list_data/add')?>">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </a>
                        </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <form action="<?=base_url();?>list_data" method="GET">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Filter Tahun<span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                                
                                <select class="form-control" name="tahun">
                                    <option>Pilih tahun</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                </select>
                        </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <button type="submit" class="btn btn-md btn-success">Submit </button>
                            </div>
                    </div> 
                </form>
                 <br><br>
                <?php if(isset($_GET['tahun'])) : ?>
                <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th width="10%">No.</th>
                                <th width="20%">Nama Perusahaan</th>
                                <th width="20%">Laba Bersih</th>
                                <th width="20%">Jumlah Modal</th>
                                <th width="20%">Jumlah Saham</th>
                                <th width="20%">Dividen Tunai</th>
                                <th width="20%">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($list_data as $key => $value): ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$value['nama_perusahaan']?></td>
                                <td><?=$value['laba_bersih']?></td>
                                <td><?=$value['jumlah_modal']?></td>
                                <td><?=$value['jumlah_saham']?></td>
                                <td><?=$value['dividen_tunai']?></td>
                                    <td>
                                        <ul style="list-style: none;padding-left: 0px;padding-right: 0px; text-align: center;">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-bars" style="font-size: large;"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="right: 0; left: auto;">
                                                    <li>
                                                        <a href="<?=base_url('list_data/update/'.$value['id_perusahaan'].'/'.$value['tahun'])?>"
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#" class="btn-delete" data-id="<?= $value['id'] ?>">
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
                    <?php else: ?>
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th width="10%" rowspan="2">No.</th>
                                <th width="20%" rowspan="2">Nama Perusahaan</th>
                                <th width="20%" colspan="3">Laba Bersih</th>
                                <th width="20%" colspan="3">Jumlah Modal</th>
                                <th width="20%" colspan="3">Jumlah Saham</th>
                                <th width="20%" colspan="3">Dividen Tunai</th>
                                <th width="20%">Action </th>
                            </tr>
                            <tr>
                                <td>2015</td>
                                <td>2016</td>
                                <td>2017</td>
                                <td>2015</td>
                                <td>2016</td>
                                <td>2017</td>
                                <td>2015</td>
                                <td>2016</td>
                                <td>2017</td>
                                <td>2015</td>
                                <td>2016</td>
                                <td>2017</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($all_data as $key => $val): ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?= $key;?></td>
                                <!-- Laba -->
                                <td><?= isset($val['2015'][0]['laba_bersih']) ? ($val['2015'][0]['laba_bersih'])  : ''; ?> </td>
                                <td><?= isset($val['2016'][0]['laba_bersih']) ? ($val['2016'][0]['laba_bersih'])  : ''; ?> </td>
                                <td><?= isset($val['2017'][0]['laba_bersih']) ? ($val['2017'][0]['laba_bersih'])  : ''; ?> </td>
                                <!-- Jumlah modal -->
                                <td><?= isset($val['2015'][0]['jumlah_modal']) ? ($val['2015'][0]['jumlah_modal'])  : ''; ?> </td>
                                <td><?= isset($val['2016'][0]['jumlah_modal']) ? ($val['2016'][0]['jumlah_modal'])  : ''; ?> </td>
                                <td><?= isset($val['2017'][0]['jumlah_modal']) ? ($val['2017'][0]['jumlah_modal'])  : ''; ?> </td>
                                <!-- Saham -->
                                <td><?= isset($val['2015'][0]['jumlah_saham']) ? ($val['2015'][0]['jumlah_saham'])  : ''; ?> </td>
                                <td><?= isset($val['2016'][0]['jumlah_saham']) ? ($val['2016'][0]['jumlah_saham'])  : ''; ?> </td>
                                <td><?= isset($val['2017'][0]['jumlah_saham']) ? ($val['2017'][0]['jumlah_saham'])  : ''; ?> </td>
                                <!-- Dividen Tunai -->
                                <td><?= isset($val['2015'][0]['dividen_tunai']) ? ($val['2015'][0]['dividen_tunai'])  : ''; ?> </td>
                                <td><?= isset($val['2016'][0]['dividen_tunai']) ? ($val['2016'][0]['dividen_tunai'])  : ''; ?> </td>
                                <td><?= isset($val['2017'][0]['dividen_tunai']) ? ($val['2017'][0]['dividen_tunai'])  : ''; ?> </td>
                                <!--    Hitung -->
                                <td>
                                    <a href="<?=base_url('list_data/hitung?
                                       lb15='.$val['2015'][0]['laba_bersih'].
                                    '&&lb16='.$val['2016'][0]['laba_bersih'].
                                    '&&lb17='.$val['2017'][0]['laba_bersih'].
                                    '&&modal15='.$val['2015'][0]['jumlah_modal'].
                                    '&&modal16='.$val['2016'][0]['jumlah_modal'].
                                    '&&modal17='.$val['2017'][0]['jumlah_modal'].
                                    '&&saham15='.$val['2015'][0]['jumlah_saham'].
                                    '&&saham16='.$val['2016'][0]['jumlah_saham'].
                                    '&&saham17='.$val['2017'][0]['jumlah_saham'].
                                    '&&div15='.$val['2015'][0]['dividen_tunai'].
                                    '&&div16='.$val['2016'][0]['dividen_tunai'].
                                    '&&div17='.$val['2017'][0]['dividen_tunai']

                                     )?>" class="btn btn-warning btn-sm">Hitung</a>
                                </td>

                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table> 
                    <?php endif; ?>     
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
            $('#myTable').DataTable({
"dom": '<"top"i>rt<"bottom"><"clear">'
            });
        });
    </script>
@endsection