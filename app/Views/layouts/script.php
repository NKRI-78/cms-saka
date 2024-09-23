  <!-- Optional JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/popper.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
  <!-- Appear JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.appear.js') ?>"></script>
  <!-- Countdown JavaScript -->
  <script src="<?= base_url('public/assets/js/countdown.min.js') ?>"></script>
  <!-- Counterup JavaScript -->
  <script src="<?= base_url('public/assets/js/waypoints.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/jquery.counterup.min.js') ?>"></script>
  <!-- Wow JavaScript -->
  <script src="<?= base_url('public/assets/js/wow.min.js') ?>"></script>
  <!-- Apexcharts JavaScript -->
  <script src="<?= base_url('public/assets/js/apexcharts.js') ?>"></script>
  <!-- Slick JavaScript -->
  <script src="<?= base_url('public/assets/js/slick.min.js') ?>"></script>
  <!-- Select2 JavaScript -->
  <script src="<?= base_url('public/assets/js/select2.min.js') ?>"></script>
  <!-- Owl Carousel JavaScript -->
  <script src="<?= base_url('public/assets/js/owl.carousel.min.js') ?>"></script>
  <!-- Magnific Popup JavaScript -->
  <script src="<?= base_url('public/assets/js/jquery.magnific-popup.min.js') ?>"></script>
  <!-- Smooth Scrollbar JavaScript -->
  <script src="<?= base_url('public/assets/js/smooth-scrollbar.js') ?>"></script>
  <!-- lottie JavaScript -->
  <script src="<?= base_url('public/assets/js/lottie.js') ?>"></script>
  <!-- am core JavaScript -->
  <script src="<?= base_url('public/assets/js/core.js') ?>"></script>
  <!-- am charts JavaScript -->
  <script src="<?= base_url('public/assets/js/charts.js') ?>"></script>
  <!-- am animated JavaScript -->
  <script src="<?= base_url('public/assets/js/animated.js') ?>"></script>
  <!-- am kelly JavaScript -->
  <script src="<?= base_url('public/assets/js/kelly.js') ?>"></script>
  <!-- Flatpicker Js -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- Chart Custom JavaScript -->
  <script src="<?= base_url('public/assets/js/chart-custom.js') ?>"></script>
  <!-- Custom JavaScript -->
  <!-- Custom JavaScript -->
  <script src="<?= base_url('public/assets/js/custom.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/toastr.min.js') ?>"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  <script src="<?= base_url('public/assets/dropify/dropify.min.js') ?>"></script>
  <script src="<?= base_url('public/assets/js/summernote.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script> -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJD7w_-wHs4Pe5rWMf0ubYQFpAt2QF2RA&libraries=places&language=id&callback=initMap" async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
  <script src="assets/plugins/global/plugins.bundle.js"></script>
  
  <!-- CONSTANT -->
  <script>
    const baseUrl = '<?= base_url(); ?>';
    const apiUrl = '<?= getenv('API_MEDIA') ?>';
    const imageUrl = '<?= getenv('IMAGE_URL') ?>';

    $('.dropify').dropify({
      messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove': 'Remove',
        'error': 'Ooops, something wrong appended.'
      },
      error: {
        'fileSize': 'The file size is too big (1M max).'
      }
    });

    $(document).ready(function() {
      $('#froalaContent').summernote({
        toolbar: [
          ["style", ["style"]],
          ["font", ["bold", "underline", "clear"]],
          ["color", ["color"]],
          ["para", ["ul", "ol", "paragraph"]],
          ["table", ["table"]],
          ["insert", ["link"]],
          ["view", ["fullscreen"]]
        ],
      });
    });
  </script>