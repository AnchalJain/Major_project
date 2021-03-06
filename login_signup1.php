 <!DOCTYPE html>
  <html>
    <head>
          <title>Tracking Assistent</title>
          <link rel="icon" href="images/logo1.png" type="image/png" sizes="16x16">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <!--Import materialize.css-->
          <link type="text/css" rel="stylesheet" href="materialize_css/css/materialize.min.css"  media="screen,projection"/>
          <link rel="stylesheet" href="mdl_css/material.min.css">
          <script src="mdl_css/material.min.js"></script>

          <meta charset="utf-8" />
          <meta name="format-detection" content="telephone=no" />
          <meta name="msapplication-tap-highlight" content="no" />
          <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
          <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
      <script type="text/javascript" src="materialize_css/js/materialize.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          $('ul.tabs').tabs();
          $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 80, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });
        });


 var if_record_exist = false;

  $(function(){
    //toggle forms

    $('#login').click(function(){
      //get the values
      var email = $('#email').val();
      var password = $('#password').val();



      //validate the form
      if(email == '' || password == ''){
        $('.msg').text('Please fill the form');
      }else{
        $('.msg').html("<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>");
        //jQuery ajax post method with
        $.post('php/checklogin.php', {email:email, password:password}, function(resp){
          if(resp == "cool"){
            location.href = 'index.php';
          }
          else if(resp == "not_activated"){
            $('.msg').html('Please activate your account first and then try to login.');
          }
          else{
            $('.msg').html('Invalid Email or Password');
          }
        });

      }
    });

    //check if the email is already registered!!
    $('#email').blur(function(){
      var email    = $('#email').val();

      $('.msg').html('');

      //checking email
      $.post('./php/check-email-registered.php', {email:email}, function(resp){
        if(resp == 'bad'){
          $('.email_err').text('Email is already registered.');
          if_record_exist = true;
        }else{
          $('.email_err').text('');
          if_record_exist = false;
        }
      });
    });

    //when click Signup button
    $('#signup').click(function(){
      //get the values

      var email    = $('#email').val();
      var password = $('#password').val();
      var firstname= $('#firstname').val();
      var lastname= $('#lastname').val();
      var contact= $('#contact').val();

      var vechicle= $('#vechicle').val();
      var pan= $('#pan').val();
      //validate the form
      // if(firstname == '' || lastname == '' || email == '' || password == '' || contact == ''){
      //   $('.msg').text('Please fill the form');
      // }else{
      console.log(if_record_exist);
        if(!if_record_exist){
          console.log(email);

        $('.msg').html("<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>");
        //jQuery ajax post method with
        $.post('./php/adduser.php', {firstname:firstname, lastname:lastname, email:email, password:password, contact:contact, vechicle:vechicle, pan:pan}, function(resp){
          if(resp == "done"){
            $(document).ready(function(){
              $('ul.tabs').tabs('select_tab', '#login_form');
            });
            $('.msg').html('GREAT!! Signed up. Activate your account and login.');
            $('#firstname').val('');
            $('#lastname').val('');
            $('#email').val('');
            $('#password').val('');
            $('#contact').val('');
            $('#$vechicle').val('');
            $('#pan').val('');
          }else{
            $('.msg').html('Something is wrong!' + resp);
          }
        });
        }else{
          $('.msg').html('Please fix the above error!');
        }

    });

  });



 </script>



	</head>
<!-------------------------------------------html body--------------------------------------------------------->
<body>



      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="materialize_css/js/materialize.min.js"></script>


<!-------------------------------------------Translator --------------------------------------------------------->

<div class="fixed-action-btn click-to-toggle">
   <a id="google_translate_element"></a>
</div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<!---------------------------------------------------menu bar-------------------------------------------------->
	      <div class="navbar-fixed">
    <nav class="white">
        <div class="nav-wrapper valign-wrapper" id="navbarAP" >
         <h5><a href="index.php" id="photo" class="margin-left"><i class="material-icons black-text">chevron_left</i></a></h5>
	         <h5 class="black-text"><b>Login/Signup</b></h5>
        </div>
    </nav>
</div>





	<div class="row">
     <div class="col s12 m8 offset-m2 l6 offset-l3"> <br>
		  <div class="card-panel grey lighten-5 z-depth-1">
               <div class="row valign-wrapper">
                    <div class="col s12">
<div class="container center-align">
       <div class="center-align">
	   <ul class="tabs" class = "center-align">
		   <li class="tab col s3"><a class="active" href="#login_form"><b>Login</b></a></li>
		   <li class="tab col s3"><a href="#signup_form"><b>Signup</b></a></li>
		   </ul></div>
</div>

      <div id="login_form" class="col s12">
        <div class="row"><br><br>
        <div class="msg center-align">&nbsp;</div><br>
          <form class="col s12">

            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" class="validate">
                <label for="email">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
            </div>

           <div class="row">
            <div class="col s6">
                   <a href="forgot_password.html" style="color:blue">Forgot password ?</a>
              </div>
            </div>

          </form>
          <a class="waves-effect waves-light btn green" id="login">Login</a>
        </div>
<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button> -->
 <!-- <div id="status">
</div> -->
      </div>

      <div id="signup_form" class="col s12">
        <div class="row"><br><br>
        <div class="msg center-align">&nbsp;</div><br>

          <form class="col s12" >

            <div class="row">
              <div class="input-field col s12">
                <input id="firstname" type="text" class="validate">
                <label for="firstname">First Name (required)</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="lastname" type="text" class="validate">
                <label for="lastname">Last Name (required)</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" class="validate"><span class="email_err red-text"></span>
                <label for="email">E-mail (required)</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" class="validate">
                <label for="password">Password (required)</label>
              </div>
            </div>

             <div class="row">
              <div class="input-field col s12">
                <input id="contact" type="text" class="validate">
                <label for="contact">Contact (required)</label>
              </div>
            </div>



        <!--    <div class="row">
              <div class="input-field col s12">
                <input type="text" class="datepicker">
                <label for="dob">Date-of-Birth (required)</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="aadhar" type="text" class="validate">
                <label for="aadhar">Aadhar Number (optional)</label>
              </div>
            </div>  -->

            <div class="row">
              <div class="input-field col s12">
                <input id="pan" type="text" class="validate">
                <label for="pan">PAN Card No. (OPTIONAL)</label>
              </div>
            </div>


            <div class="row">
              <div class="input-field col s12">
                <input id="vechicle" type="text" class="validate">
                <label for="vechicle">Vehicle No.</label>
              </div>
            </div>


		<div class="row">


			  <div class="col s12">
				  <br>By clicking on signup I agree to the <a style="color:blue;" href="disclaimer.html">Terms & Conditions and Disclaimer</a>
              </div>

			  </div>



 <a class="waves-effect waves-light btn green" id="signup">Signup</a>




</form>

        </div>
      </div>

                    </div>
               </div>
        </div>
    </div>
</div>

	  </body>
</html>
