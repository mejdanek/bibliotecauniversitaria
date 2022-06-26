<script>
  $(function () {
        $("#logout").click(function () {
            $.ajax({
                type: 'GET'
            }).done(function (data) { });
        });
    });
</script>
<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="../" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="info/" class="nav-link px-2 text-white">Info</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
          <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <div class="text-end">
          <?php 
          if(!isset($_SESSION['login']) ){
            echo "<button type=\"button\" id=\"login\" class=\"btn btn-outline-light me-2\">Login</button>";  
          }
          else{
            echo "<button type=\"button\" id=\"logout\" class=\"btn btn-outline-light me-2\">Logout</button>";  
          }
          ?>
          <button type="button" class="btn btn-warning">Registrati</button>
          <button type="button" class="btn btn-outline-light me-2">Admin</button>
        </div>
      </div>
    </div>
  </header>
