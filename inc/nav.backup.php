<!-- Banner -->
<div class="banner">

<figure class="logo">
  <img src="images/ibooks-symbol.png" alt="">
</figure>

<ul class="banner-list">
  <li>
    <a href='indexAdmin.php'>Home</a>
  </li>

  <li>
    <a href="addNewBook.php">Add new book</a>
  </li>

  <li>
    <a href='favoriteBook.php'>favorite book</a>
  </li>

  <li>
     <a href='userLevelUpdate.php'>Edit User</a>
  </li>

  <li>
    <div id='form-search'>
      <input id='word' type="text" name="search" title="Filter by book name" placeholder="Book name"/>
      <span id="hint"></span>
      <input id='btn-search' type="submit" value="Search">
    </div>
  </li>

  <li>
    <a href='logout.php'>Log out</a>
  </li>

</ul>
</div> <!-- End of banner -->

<!-- Wrapper for slides -->
<figure id="myCarousel" class="carousel slide" data-ride="carousel">
<!-- Indicators -->
<ol class="carousel-indicators">
  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
  <li data-target="#myCarousel" data-slide-to="1"></li>
  <li data-target="#myCarousel" data-slide-to="2"></li>
  <li data-target="#myCarousel" data-slide-to="3"></li>
</ol>

<div class="carousel-inner" role="listbox">
  <div class="item active">
    <img src="images/2.jpg" alt="Chania">
  </div>

  <div class="item">
    <img src="images/3.jpg" alt="Chania">
  </div>

  <div class="item">
    <img src="images/4.png" alt="Flower">
  </div>

  <div class="item">
    <img src="images/5.png" alt="Flower">
  </div>
</div>
<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
</a>

<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
  <span class="sr-only">Next</span>
</a>
</figure> <!-- End of wrapper for slides -->

<!-- sub menu-->
<ul class="category_menu">
<li>
  <a href='technology.php'>Technology</a>
</li>

<li>
  <a href='science.php'>Science</a>
</li>

<li>
  <a href='howTo.php'>How-to</a>
</li>

<li>
  <a href='math.php'>Math</a>
</li>

<li>
  <a href='history.php'>History</a>
</li>

<li>
  <a href='graphic.php'>Graphic</a>
</li>

<li>
  <a href='language.php'>Language</a>
</li>

<li>
  <a href='other.php'>Other</a>
</li>

</ul>


  <!-- Banner main-block-->
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">

    <!-- block-one -->
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- block-two -->
    <a class="navbar-brand" href="#">Ibooks</a>

    <!-- block-three -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href='indexAdmin.php'>หน้าแรก<span class="sr-only">(current)</a>
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

    </div>

    <!-- block-four -->
    <form class="input-group search-box">
      <input class="form-control" type="text" placeholder="ชื่อหนังสือ">
      <span class="input-group-addon" id="basic-addon2">ค้นหา</span>
    </form>

  </nav> <!-- End of banner -->