@extends('layouts.backend')

@section('title','List Data')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3><?=($this->uri->segment(2) == 'add') ? 'Add ' : 'Edit '?>Data</h3>
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
                    <h2><?=($this->uri->segment(2) == 'add') ? 'Add ' : 'Edit '?>Data</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" id="myForm">
                        <?php if($this->uri->segment(2) == 'update') : ?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Perusahaan<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                    <select name="id_perusahaan" class="form-control">
                                        <?php foreach($all_perusahaan as $key => $val) : ?>
                                            <option value=<?= $val['id_perusahaan']?>
                                            <?php if($update_perusahaan['id_perusahaan'] == $val['id_perusahaan']){ echo 'selected="selected"';} ?> > <?= $val['nama_perusahaan']?></option>
                                        <?php endforeach?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Tahun<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control" name="tahun">
                                    <option >Pilih tahun</option>
                                    <option value="2015" <?php if($update_perusahaan['tahun'] == '2015') { echo "selected"; }?> >2015</option>
                                    <option value="2016" <?php if($update_perusahaan['tahun'] == '2016') { echo "selected"; } ?> >2016</option>
                                    <option value="2017" <?php if($update_perusahaan['tahun'] == '2017') { echo "selected"; } ?> >2017</option>
                                </select>
                            </div>
                        </div>
                        <?php else :?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nama Perusahaan<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                    <select name="id_perusahaan" class="form-control">
                                        <option disabled="" selected="">Pilih perusahaan</option>
                                        <?php foreach($list_perusahaan as $key => $val) : ?>
                                            <option value="<?= $val['id_perusahaan']; ?>"> <?= $val['nama_perusahaan']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Tahun<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control" name="tahun">
                                    <option  disabled="" selected="">Pilih tahun</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                </select>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Laba Bersih<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" name="laba" class="form-control" value="<?=isset($list_data['laba_bersih'])? $list_data['laba_bersih'] : set_value('laba_bersih');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah Saham<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" name="saham" class="form-control" value="<?=isset($list_data['jumlah_saham'])? $list_data['jumlah_saham'] : set_value('jumlah_saham');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Dividen Tunai<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" name="dividen" class="form-control" value="<?=isset($list_data['dividen_tunai'])? $list_data['dividen_tunai'] : set_value('dividen_tunai');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Jumlah Modal<span class="required">*</span></label>
                            <div class="col-md-6">
                                <input type="text" name="modal" class="form-control" value="<?=isset($list_data['jumlah_modal'])? $list_data['jumlah_modal'] : set_value('jumlah_modal');?>">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                                <a href="<?=base_url('list_data')?>">
                                    <button type="button" class="btn btn-primary">Back</button>
                                </a>
                                <button type="submit" class="btn btn-success" id="save">Save</button>
                            </div>
                        </div>

                    </form>      
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="<?=base_url('assets/js/add-update.js')?>"></script>
@endsection