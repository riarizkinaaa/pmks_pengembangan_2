

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
<style>
  #chartdiv {
    width: 100%;
  }

  .data_kecamatan {
    width: 100%;
    height: 400px;
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->yieldContent('breadcrumb-list'); ?>
<!-- Container-fluid starts-->
<div class="container-fluid dashboard-default-sec">
  <div class="row">
    <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
      <div class="card income-card card-primary">
        <div class="card-body text-center">
          <div class="round-box">
            <i data-feather="user"></i>
          </div>
          <h5 id="anak_yatim"></h5>
          <p>Anak Yatim</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_yatim"></a>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
      <div class="card income-card card-primary">
        <div class="card-body text-center">
          <div class="round-box">
            <i data-feather="user-minus"></i>
          </div>
          <h5 id="anak_piatu"></h5>
          <p>Anak Piatu</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_piatu"></a>
          <div class="parrten"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
      <div class="card income-card card-primary">
        <div class="card-body text-center">
          <div class="round-box">
            <i data-feather="user-plus"></i>
          </div>
          <h5 id="yatim_piatu"></h5>
          <p>Anak Yatim Piatu</p><a class="btn-arrow arrow-primary" href="javascript:void(0)" id="jumlah_yatim_piatu"> </a>
          <div class="parrten"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 box-col-3 des-xl-25 rate-sec">
      <div class="card income-card card-primary">
        <div class="card-body text-center">
          <div class="round-box">
            <i data-feather="users"></i>
          </div>
          <h5 id="semua"></h5>
          <p>Semua</p><a class="btn-arrow arrow-primary" href="javascript:void(0)"><i class="toprightarrow-primary fa fa-arrow-up me-2"></i>100% </a>
          <div class="parrten"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="header-top d-sm-flex justify-content-between align-items-center">
            <h5>Total Anak Yatim Piatu</h5>
          </div>
        </div>
        <div class="card-body">
          <div id="status_anak"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="header-top d-sm-flex justify-content-between align-items-center">
            <h5>Jenis Kelamin</h5>
          </div>
        </div>
        <div class="card-body">
          <div id="jenis_kelamin"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="header-top d-sm-flex justify-content-between align-items-center">
            <h5>Pendidikan</h5>
          </div>
        </div>
        <div class="card-body">
          <div id="pendidikan"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/amchart/core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/amchart/charts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/chart/amchart/animated.js')); ?>"></script>

<script>
  $(document).ready(function() {
    $.ajax({
      url: 'json_anak',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        const id_pendata = `<?php echo e(Session::get('id_survior')); ?>`
        const pendata = data['anak'].filter((id_survior) => id_survior.id_survior == id_pendata);
        const anak_yatim = pendata.filter((status_anak) => status_anak.status_anak == 1);
        const anak_piatu = pendata.filter((status_anak) => status_anak.status_anak == 2);
        const yatim_piatu = pendata.filter((status_anak) => status_anak.status_anak == 3);

        const jumlah_yatim = anak_yatim.length / pendata.length * 100;
        const jumlah_piatu = anak_piatu.length / pendata.length * 100;
        const jumlah_yatim_piatu = yatim_piatu.length / pendata.length * 100;

        const laki_laki = pendata.filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 1);
        const perempuan = pendata.filter((jenis_kelamin) => jenis_kelamin.jenis_kelamin == 0);
        const jumlah_lk = laki_laki.length / pendata.length * 100;
        const jumlah_pr = perempuan.length / pendata.length * 100;

        const jenis_pendidikan = ['paud tk', 'belum sekolah', 'sd/mi sederajat', 'belum tamat sd/mi sederajat', 'tamat sd/mi sederajat', 'sltp sederajat', 'tamat sltp sederajat', 'slta sederajat', 'tamat slta'];

        const jumlah_pendidikan = jenis_pendidikan.map(jenis => {
            return {
                pendidikan: jenis,
                jumlah: pendata.filter(anak => anak.id_pendidikan === jenis_pendidikan.indexOf(jenis) + 1).length
            };
        });

        $("#anak_yatim").append(anak_yatim.length + " Orang");
        $("#anak_piatu").append(anak_piatu.length + " Orang");
        $("#yatim_piatu").append(yatim_piatu.length + " Orang");
        $("#semua").append(pendata.length + " Orang");
        $("#jumlah_yatim").append(jumlah_yatim.toFixed(2) + " %");
        $("#jumlah_piatu").append(jumlah_piatu.toFixed(2) + " %");
        $("#jumlah_yatim_piatu").append(jumlah_yatim_piatu.toFixed(2) + " %");

        am4core.useTheme(am4themes_animated);

        // Grafik status Anak
        var chart = am4core.create("status_anak", am4charts.PieChart);
        chart.data = [{
          "status_anak": "Anak Yatim",
          "percentage": jumlah_yatim
        }, {
          "status_anak": "Anak Piatu",
          "percentage": jumlah_piatu
        }, {
          "status_anak": "Anak Yatim Piatu",
          "percentage": jumlah_yatim_piatu
        }];
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "percentage";
        pieSeries.dataFields.category = "status_anak";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;
        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";

        // Grafik jenis kelamin
        var chartJenisKelamin = am4core.create("jenis_kelamin", am4charts.PieChart);
        chartJenisKelamin.data = [{
          "jenis_kelamin": "Laki Laki",
          "percentage": jumlah_lk
        }, {
          "jenis_kelamin": "Perempuan",
          "percentage": jumlah_pr
        }];
        var pieSeriesJenisKelamin = chartJenisKelamin.series.push(new am4charts.PieSeries());
        pieSeriesJenisKelamin.dataFields.value = "percentage";
        pieSeriesJenisKelamin.dataFields.category = "jenis_kelamin";
        pieSeriesJenisKelamin.innerRadius = am4core.percent(50);
        pieSeriesJenisKelamin.ticks.template.disabled = true;
        pieSeriesJenisKelamin.labels.template.disabled = true;
        chartJenisKelamin.legend = new am4charts.Legend();
        chartJenisKelamin.legend.position = "right";

        // Grafik pendidikan
        var chartPendidikan = am4core.create("pendidikan", am4charts.PieChart);
        chartPendidikan.data = jumlah_pendidikan;
        var pieSeriesPendidikan = chartPendidikan.series.push(new am4charts.PieSeries());
        pieSeriesPendidikan.dataFields.value = "jumlah";
        pieSeriesPendidikan.dataFields.category = "pendidikan";
        pieSeriesPendidikan.innerRadius = am4core.percent(50);
        pieSeriesPendidikan.ticks.template.disabled = true;
        pieSeriesPendidikan.labels.template.text = "{category}: {value}";
        chartPendidikan.legend = new am4charts.Legend();
        chartPendidikan.legend.position = "right";
      }
    });
  });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.survior.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks-anak-yatim\resources\views/survior/dashboard.blade.php ENDPATH**/ ?>