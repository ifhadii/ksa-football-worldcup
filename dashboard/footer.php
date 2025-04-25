
  <footer class="footer text-center" >
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <script>document.write(new Date().getFullYear())</script> © KSA
        </div>
        <div class="col-sm-6">
          <div class="text-sm-end d-none d-sm-block">
            World Cup Saudi Arabia
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
  <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!-- Theme Settings -->

<!-- JAVASCRIPT -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="assets/js/plugins.js"></script>

<script src="code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="assets/js/pages/datatables.init.js"></script>




<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Vector map-->
<script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="assets/libs/jsvectormap/maps/world-merc.js"></script>

<!--Swiper slider js-->
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>

<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-ecommerce.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
  $(function () {
    $('.summernote').summernote({
      height: 300,
      direction: 'rtl',
      placeholder: 'اكتب التفاصيل...',
      callbacks: {
        onImageUpload: function (files) {
          sendFile(files[0]);
        }
      }
    });
    
    function sendFile(file) {
      var data = new FormData();
      data.append("file", file);
      
      $.ajax({
        url: "uploader.php",
        type: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
          $('.summernote').summernote("insertImage", url);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
        }
      });
    }
  });
  
</script>



</body>




<!-- Mirrored from themesbrand.com/velzon/html/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 20:37:39 GMT -->

</html>
