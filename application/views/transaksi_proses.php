<br>
<!--Form with header-->
<div class="card">
    <div class="card-block">        
        <!--Header-->
        <div class="form-header">
        <center>
            <h3>
            Tambah Data Transaksi
            </h3>
        </center>
        </div>
        <!--Body-->
          <form action="#" id="form-tambah">
            <div class="row">
            <div class="col-md-6">
            <div class="md-form">
                <select id="kelas" name="pilih_kelas" onchange="ambil_siswa(this.value)" class="mdb-select colorful-select dropdown-primary">
                    <option value="">--Pilih Kelas</option>
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
                    <option value="">--Pilih Kelas Terlebih Dahulu</option>
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
                                var thn_ajr;
                                for (var i = 0; i < data.length; i++) {
                                    create += '<option value="'+data[i].nis+'">('+data[i].nis+') - '+data[i].nama+'</option>';
                                    thn_ajr=data[i].thn_ajr;
                                }
                                create += '</select>';
                                create += '<label for="siswa">Pilih Siswa</label>';
                                $('#pilihan_siswa').html(create);
                                $('#tahun-ajaran').html(thn_ajr);

                                $('.mdb-select2').material_select();
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Gagal ambil data siswa dengan ajax');
                            }
                        });
                    }
            </script>
            </div>

            <div class="col-md-6">
                <hr>
                <center>
                <h3>Tahun Ajaran</h3>
                <h3><b><span class="text-success" id="tahun-ajaran">-</span></b></h3>
                </center>
                <hr>
            </div>
            </div> <!-- row -->

            <div class="md-form">
                <i class="fa fa-calendar prefix"></i>
                <input type="text" id="form5" name="tanggal" class="form-control">
                <label for="form5">Tanggal Bayar</label>
                      <script type="text/javascript">

                        $(function(){
                          $('#form5').datepicker({
                            format: 'yyyy/mm/dd',
                            autoclose: true,
                            todayHighlight: true
                          });
                        });
                      </script>

            </div>
            <div class="md-form">
                <select id="kelas" name="pilih_jnsbyr" class="mdb-select3 colorful-select dropdown-success">
                    <option value="">--Pilih Jenis Pembayaran</option>
                    <?php
                    foreach ($jns_byr as $key2) {
                        echo "<option value=".$key2->id_jnsbyr.">".$key2->nama_byr." tingkat ".$key2->tingkat."</option>";
                    }
                    ?>
                </select>
                <label for="kelas">Pilih Jenis Pembayaran</label>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.mdb-select3').material_select();
                      });
                </script>
            </div>
            <div class="md-form">
                        <i class="fa fa-edit prefix"></i>
                        <input placeholder="Keterangan" name="keterangan" type="text" id="form5" class="form-control">
                        <label for="form5">Keterangan* (ketik bulan yang di bayarkan juga kalau merupakan pembayaran bulanan)</label>
            </div>
            </form>
            <div class="text-xs-center">
                <a onclick="tambah_data()" class="btn btn-success"><i class="fa fa-save left"></i> Simpan</a>
                <hr>
            </div>
    </div>
</div>
<!--/Form with header-->

<script type="text/javascript">
    function tambah_data()
    {
        url = "<?php echo site_url('Ctransaksi/ajax_add')?>";

          $.ajax({
            url : url,
            type: "POST",
            data: $('#form-tambah').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              window.location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
</script>