<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Feeds ">
  <meta name="keywords" content="HTML,CSS,JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Tech-test</title>
    <!-- font awesome js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Roboto Condensed font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,500,600,700,800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
  
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/style.css" >

  </head>
  <body>

<!-- Header Start -->
    <header class="headering">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="header f-box">
                        <div class="logo">
                        </div>
                      
                        <div class="header-menu">
                            <ul class="f-box">
                               <li><a href="{{url('/Feeds')}}" @if($page==1) class="active" @endif>Your Feeds</a></li>

                                <li><a href="{{url('/add_feed')}}" @if($page==2) class="active" @endif>Add Feed</a></li>
                            </ul>
                        </div>
                        <div  class="f-box">
                            <div class="menu-right">
                                <ul class="f-box">
                                    <li>
                                        <div class="signingup">
                                            <a href="{{url('/signout')}}">
                                              <span class="signin-Btn">LOGOUT</span>
                                            </a>
                                        </div>
                                    </li>
                                  
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- Header End  -->

@yield('content')
<!-- Footer Start -->
<footer class="footer_wraper">
      
      <div class="footer_bottom">
        <div class="container-fluid">
          <div id="accordion">
            <div class="row">
             
             
              
            </div>
          </div> <!-- ACCORDIAN-END -->
        </div>
        <div class="clear"></div>
      </div>
      <!-- FOOTER_BOTTOM END -->
  </footer>
<!-- Footer End -->



<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <!--Bootstrap js-->
  <script src="js/bootstrap.min.js" ></script>
    
 
    
  <!--Common Jquery-->
  <script src="js/custom.js"></script>

  <script>
$( document ).ready(function() {
    $('.detail_div').on('keydown', function(evt) {
       // alert();
        if (!evt) evt = event;
        var id=$(this).attr("data-id");
    if (evt.altKey) {
        $('#button_'+id).css('display','block');
    }
 });
});
</script>

</body>
</html>
