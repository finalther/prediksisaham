<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SRS</title>
        <!-- global stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app.min.css')?>">
        <link href="<?=base_url('assets/plugins/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    </head>
    <body class="login" >
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="padding: 0px;">
                    <div class="navbar nav_title" style="background: #4da6ff; width: 100%; height: 50%">
                        <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Sistem Rekomendasi Saham</span></a>
                    </div>
                </div>
                <div class="col-md-4" style="padding: 0px;">
                    <div class="navbar nav_title" style=" width: 100%;background: #82c0ff;">
                        <div class="site_title">
                        <form action="#" method="post" id="login_form">
                            <input type="text" name="username" placeholder="Username" class="form-control" style="width: 40%; display:  inline" />
                            <input type="password" name="password" placeholder="Password" class="form-control" style="width: 40%; display:  inline"/>
                            <button type="submit" class="btn btn-default" id="login" style="margin: 0px;">Log in</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                <div class="page-title">
                    <div class="title_left">
                         <h4><i class="fa fa-book"></i> Daftar Nama Perusahaan </h4>
                    </div>
                </div>
                <div class="clearfix"></div>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr style="background-color: #0aea4f42;">
                                <th width="1%" rowspan="2">No.</th>
                                <th width="20%" rowspan="2">Nama Perusahaan</th>
                                <th width="20%" colspan="3" style="text-align: center;">Laba Bersih</th>
                                <th width="20%" colspan="3" style="text-align: center;">Jumlah Modal</th>
                                <th width="20%" colspan="3" style="text-align: center;">Jumlah Saham</th>
                                <th width="20%" colspan="3" style="text-align: center;">Dividen Tunai</th>
                                <th width="20%" rowspan="2" style="text-align: center; border-left: 1px solid #ddd;">Action </th>
                            </tr>
                            <tr style="background-color: #f7ee80bd;">
                                <td width="5%">2015</td>
                                <td width="5%">2016</td>
                                <td width="5%">2017</td>
                                <td width="5%">2015</td>
                                <td width="5%">2016</td>
                                <td width="5%">2017</td>
                                <td width="5%">2015</td>
                                <td width="5%">2016</td>
                                <td width="5%">2017</td>
                                <td width="5%">2015</td>
                                <td width="5%">2016</td>
                                <td width="5%">2017</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($all_data as $key => $val): ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?= $key;?></td>
                                <!-- Laba -->
                                <td><?=$val['2015'][0]['laba_bersih']?></td>
                                <td><?=$val['2016'][0]['laba_bersih']?></td>
                                <td><?=$val['2017'][0]['laba_bersih']?></td>
                                <!-- Jumlah modal -->
                                <td><?=$val['2015'][0]['jumlah_modal']?></td>
                                <td><?=$val['2016'][0]['jumlah_modal']?></td>
                                <td><?=$val['2017'][0]['jumlah_modal']?></td>
                                <!-- Saham -->
                                <td><?=$val['2015'][0]['jumlah_saham']?></td>
                                <td><?=$val['2016'][0]['jumlah_saham']?></td>
                                <td><?=$val['2017'][0]['jumlah_saham']?></td>
                                <!-- Dividen Tunai -->
                                <td><?=$val['2015'][0]['dividen_tunai']?></td>
                                <td><?=$val['2016'][0]['dividen_tunai']?></td>
                                <td><?=$val['2017'][0]['dividen_tunai']?></td>
                                <!--    Hitung -->
                                <td style="text-align: center;"> - </a>
                                </td>

                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding:0px;">
                    <footer style="margin: 0px;">
                      <div class="center">
                            Copyright 2018 @ pimen skripshit by IDR
                      </div>
                      <div class="clearfix"></div>
                    </footer>
                </div>
            </div>
        </div>
        <script src="<?=base_url('assets/js/app.min.js')?>"></script>
        <!-- validator -->
        <script src="<?=base_url('assets/plugins/jquery-validation/jquery.validate.min.js')?>"></script>    
        <script>
            $(document).ready(function() {
                $('#login_form').validate({
                    rules: {
                        username: {
                            required: false
                        },
                        password: {
                            required: false
                        }
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            url: "<?=base_url('auth/do_login')?>",
                            type: 'post',
                            dataType: 'json',
                            data: $('#login_form').serializeArray(),
                            beforeSend: function() {},
                            success: function(data) {
                                $("#password").val('');
                                if (data.error == true) {
                                    alert(data.message);
                                } else {
                                    window.location.href = "<?=base_url('home')?>";
                                }
                            }

                        });
                    }
                });

                $('#register_form').validate({
                    rules: {
                        username: {
                            required: true,
                        },
                        password: {
                            required: true,
                            minlength: 8,
                            maxlength: 12,
                        },
                        confirm_password: {
                            minlength: 8,
                            maxlength: 12,
                            equalTo: "#password",
                        }

                    },
                    submitHandler: function(form) {
                        $.ajax({
                            url: "<?=base_url()?>",
                            type: 'post',
                            dataType: 'json',
                            data: $('#register_form').serializeArray(),
                            beforeSend: function() {},
                            success: function(data) {
                                $('#register_form')[0].reset();
                                alert(data.message);
                            }

                        });
                    }
                });
            }); 
        </script>
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
    </body>
</html>