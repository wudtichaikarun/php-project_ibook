  <!-- Banner -->
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- <a class="navbar-brand" href="#">Navbar</a> -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
          <a class="nav-link" href='indexAdmin.php'>หน้าแรก</a>
        </li>

        <li class="nav-item">
          <a class="nav-link"  data-toggle="modal" data-target="#myModal">เพิ่มหนังสือ</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">หนังสือเล่มโปรด</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">แก้ไขข้อมูลหนังสือ</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">ออกจากระบบ</a>
        </li>

      </ul>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
    
  </nav> <!-- End of banner -->

  <!-- Wrapper for slides -->
  <figure id="carouselExampleControls" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block img-fluid" src="images/banner1.png" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="images/banner2.png" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="images/banner3.png" alt="Third slide">
      </div>
    </div>
    
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </figure> <!-- End of wrapper for slides -->
  
  <!-- sub menu-->
  <ul class="category_menu">
    <li>
       <a href='technology.php'>เทคโนโลยี</a>
    </li>

    <li>
      <a href='science.php'>วิทยาศาสตร์</a>
    </li>

    <li>
      <a href='howTo.php'>วิธีการ</a>
    </li>

    <li>
      <a href='math.php'>คณิตศาสตร์</a>
    </li>

    <li>
      <a href='history.php'>ประวิติศาสตร์</a>
    </li>

    <li>
      <a href='graphic.php'>ออกแบบ</a>
    </li>

    <li>
      <a href='language.php'>ภาษา</a>
    </li>

    <li>
      <a href='other.php'>อื่นๆ</a>
    </li>

  </ul>