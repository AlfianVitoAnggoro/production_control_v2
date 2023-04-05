<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="style.css">
  <!-- <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"> -->
  <title>PT Century Batteries Indonesia | Data Machine</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">Style   -->
    <link rel="stylesheet" href="<?=base_url()?>assets/rework_grid/bootstrap.min.css">
</head>

<body>

  <?= $this->include('rework_grid/layout/navbar') ?>

  <?= $this->renderSection('content') ?>

</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->
<script src="<?=base_url()?>assets/rework_grid/bootstrap.bundle.min.js"></script>

</html>