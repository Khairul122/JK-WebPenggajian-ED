<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      DUK
      <small>Pegawai</small>
    </h1>
    <ol class="breadcrumb">
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="margin-top: 10px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-credit-card"></i> Data DUK Pegawai</h3>
          </div>
          <div class="box-body">
            <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
              </div>
            <?php endif; ?>
            <div class="row">
              <div class="col-md-10">
                <form class="form-horizontal" method="post" action="">
                  <input type="hidden" name="id" value="<?= $duk['id_duk']; ?>">
                  <div class="form-group">
                    <label class="col-md-3 control-label">NIP</label>
                    <div class="col-md-9">
                      <input type="text" name="nip" value="<?= $duk['nip']; ?>" readonly class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Nama</label>
                    <div class="col-md-9">
                      <input type="text" name="nama" value="<?= $duk['nama']; ?>" readonly class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Pangkat</label>
                    <div class="col-md-9">
                      <select class="form-control" name="pangkat" required>
                        <?php foreach ($pangkat as $p) : ?>
                          <option value="<?= $p; ?>" <?= $p == $duk['pangkat'] ? 'selected' : ''; ?>>
                            <?= $p; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Golongan</label>
                    <div class="col-md-9">
                      <select class="form-control" id="golongan" name="golongan" required>
                        <?php foreach ($gol as $g) : ?>
                          <option value="<?= $g; ?>" <?= $g == $duk['golongan'] ? 'selected' : ''; ?>>
                            <?= $g; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Tunjangan</label>
                    <div class="col-md-9">
                      <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="<?= $duk['tunjangan'] ?>" readonly required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">TMT (Pangkat/Golongan)</label>
                    <div class="col-md-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" id="tmt_pangkat" value="<?= $duk['tmt_pangkat']; ?>" name="tmt_pangkat" class="form-control pull-right" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">TMT PNS</label>
                    <div class="col-md-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" id="tmt_pns" value="<?= $duk['tmt_pns']; ?>" name="tmt_pns" class="form-control pull-right" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Jabatan</label>
                    <div class="col-md-9">
                      <input type="text" name="jabatan" value="<?= $duk['jabatan']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">TMT (Jabatan)</label>
                    <div class="col-md-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?= $duk['tmt_jabatan']; ?>" name="tmt_jabatan" class="form-control pull-right" id="datepicker1" required="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Masa Kerja Golongan (Tahun)</label>
                    <div class="col-md-9">
                      <input type="number" id="mkgt" name="mkgt" class="form-control" value="<?= $duk['masa_kerja_golongan_tahun'] ?>" readonly required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Masa Kerja Golongan (Bulan)</label>
                    <div class="col-md-9">
                      <input type="number" name="mkgb" class="form-control" value="<?= $duk['masa_kerja_golongan_bulan'] ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Masa Kerja Seluruhnya (Tahun)</label>
                    <div class="col-md-9">
                      <input type="number" id="mkst" name="mkst" class="form-control" value="<?= $duk['masa_kerja_seluruh_tahun'] ?>" readonly required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-3 control-label">Masa Kerja Seluruhnya (Bulan)</label>
                    <div class="col-md-9">
                      <input type="number" name="mksb" class="form-control" value="<?= $duk['masa_kerja_seluruh_bulan'] ?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Naik Pangkat (YAD)</label>
                    <div class="col-md-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?= $duk['naik_pangkat_yad']; ?>" name="naik_pangkat" class="form-control pull-right" id="datepicker2" required="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Naik Gaji (YAD)</label>
                    <div class="col-md-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="<?= $duk['naik_gaji_yad']; ?>" name="naik_gaji" class="form-control pull-right" id="datepicker3" required="">
                      </div>
                    </div>
                  </div>

                  <?php
                  // tanggal lahir
                  $tanggal = new DateTime($pegawai['tgl_lahir']);
                  // tanggal hari ini
                  $today = new DateTime('today');
                  // tahun
                  $y = $today->diff($tanggal)->y;
                  ?>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Usia</label>
                    <div class="col-md-9">
                      <input type="text" name="usia" value="<?= $y; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Pendidikan</label>
                    <div class="col-md-9">
                      <input type="text" name="pendidikan" value="<?= $duk['pendidikan']; ?>" class="form-control" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Keterangan</label>
                    <div class="col-md-9">
                      <input type="text" name="ket" value="<?= $duk['keterangan']; ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary" style="float: right;"> <i class="fa fa-save"></i> Perbarui Data</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var tmtPnsInput = document.getElementById('tmt_pns');
    var mkstInput = document.getElementById('mkst');
    var tmtPangkatInput = document.getElementById('tmt_pangkat');
    var mkgtInput = document.getElementById('mkgt');
    var golonganSelect = document.getElementById('golongan');
    var tunjanganInput = document.getElementById('tunjangan');

    function calculateMasaKerja(dateInput, outputInput) {
        var dateValue = dateInput.value;
        if (dateValue) {
            var date = new Date(dateValue);
            var today = new Date();
            var years = today.getFullYear() - date.getFullYear();
            outputInput.value = years;
        }
    }

    tmtPnsInput.addEventListener('change', function() {
        calculateMasaKerja(tmtPnsInput, mkstInput);
    });

    tmtPangkatInput.addEventListener('change', function() {
        calculateMasaKerja(tmtPangkatInput, mkgtInput);
    });

    golonganSelect.addEventListener('change', function() {
        var golongan = golonganSelect.value;
        $.ajax({
            url: '<?= base_url('duk/getTunjangan'); ?>',
            type: 'POST',
            data: {golongan: golongan},
            dataType: 'json',
            success: function(data) {
                if (data && data.tunjangan) {
                    tunjanganInput.value = data.tunjangan;
                } else {
                    console.error("Data tunjangan tidak ditemukan.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan saat mengambil data tunjangan: ", error);
            }
        });
    });

    // Inisialisasi perhitungan awal jika diperlukan
    calculateMasaKerja(tmtPnsInput, mkstInput);
    calculateMasaKerja(tmtPangkatInput, mkgtInput);
});
</script>
