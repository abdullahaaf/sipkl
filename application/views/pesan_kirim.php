

<br>
<!--Form with header-->
<div class="card">
    <div class="card-block">        
        <!--Header-->
        <div class="form-header">
        <center>
            <h3>
            Kirim Pesan
            </h3>
        </center>
        </div>

        <!--Body-->
          <form id="form_pesan">
            
            <div class="md-form">
                <select id="kelas" name="pilih_kelas" onchange="ambil_siswa(this.value)" class="mdb-select colorful-select dropdown-primary">
                    <option>--Pilih Kelas</option>
                    <?php
                    foreach ($kelas as $key) {
                        echo "<option value=".$key->id_kls.">".$key->tingkat." ".$key->kelas."</option>";
                    }
                    ?>
                </select>
                <label for="kelas">Pilih Kelas</label>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.mdb-select').material_select();
                      });
                </script>
            </div>
            <div class="md-form" id="pilihan_siswa">
                <select id="siswa" name="pilih_siswa" class="mdb-select2 colorful-select dropdown-warning">
                    <option value="">--Pilih Siswa</option>
                </select>
                <label for="siswa">Pilih Siswa</label>                
            </div>
            <script type="text/javascript">
                    $(document).ready(function() {
                        $('.mdb-select2').material_select();
                      });                   
            </script>
            <script type="text/javascript">
                function ambil_siswa(kelas) {
                        var create = '<select id="siswa" name="pilih_siswa" class="mdb-select2 colorful-select dropdown-warning">';
                            create += '<option value="">--Pilih Siswa</option>';

                        $.ajax({
                            url : "<?php echo site_url('Csms/ambil_siswa')?>/" + kelas,
                            type: "GET",
                            dataType: "JSON",
                            success: function(data)
                            {         
                                for (var i = 0; i < data.length; i++) {
                                    create += '<option value="'+data[i].nis+'">'+data[i].nama+'</option>';
                                }
                                create += '</select>';
                                create += '<label for="siswa">Pilih Siswa</label>';
                                $('#pilihan_siswa').html(create);

                                $('.mdb-select2').material_select();
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Gagal ambil data siswa dengan ajax');
                            }
                        });
                    }
            </script>
            
            <div class="md-form" id="pilihNomer">
                <select id="siswa" name="pilihNomer" class="mdb-select4 colorful-select dropdown-warning">
                    <option value="">--Pilih Nomor Tujuan</option>
                    <option value="siswa">Nomor Siswa (selected)</option>
                    <option value="orang_tua">Nomor Orang Tua Siswa</option>
                    <option value="orang_tua_siswa">Nomor Orang Tua Siswa dan Nomor Siswa</option>
                </select>
                <label for="siswa">Pilih Nomor Tujuan</label>                
            </div>
            <script type="text/javascript">
                    $(document).ready(function() {
                        $('.mdb-select4').material_select();
                      });                   
            </script>
            <br>

            <!-- <div class="md-form">
                <i class="fa fa-user prefix"></i>
                <input placeholder="085xxxxxxxxx,081xxxxxxxxx" type="text" id="form5" class="form-control">
                <label for="form5">Nomor Telepon</label>
            </div> -->
            <div class="md-form">
                <i class="fa fa-envelope prefix"></i>
                <textarea name="pesan" id="textarea1" class="md-textarea" length="160" maxlength="160"></textarea>
                <label for="textarea1">Type your text</label>
            </div>
            <div class="text-xs-center">
                <a onclick="kirim()" class="btn btn-success"><i class="fa fa-send left"></i> Kirim</a>
                <hr>
            </div>
          </form>
    </div>
</div>
<!--/Form with header-->
<script type="text/javascript">
    function kirim() {
        // var pilihKelas = $('[name="pilih_kelas"]').val();
        // var pilihSiswa = $('[name="pilih_siswa"]').val();
        // var pilihNomer = $('[name="pilihNomer"]').val();
        // var pesan = $('[name="pesan"]').val();
        $.ajax({
            url : "<?php echo site_url('Ckirim_pesan/kirim_pesan')?>",
            type: "POST",
            data: $('#form_pesan').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               alert('Pesan dalam proses pengiriman');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('error');
            }
        });
    }
</script>