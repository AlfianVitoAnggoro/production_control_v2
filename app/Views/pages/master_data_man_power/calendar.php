<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="box">
            <div class="box-header with-border">
              <h3>Detail Man Power</h3>
            </div>
            <div class="box-body">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script src="../assets/vendor_components/fullcalendar/lib/moment.min.js"></script>
<script src="../assets/vendor_components/fullcalendar/fullcalendar.min.js"></script>
<script src="js/pages/calendar.js"></script>
<?= $this->endSection(); ?>