<?php include("conn.php");

if(col("logout")=="true")
{
	session_destroy();
	header("Location:".base_url);
}

if(col("name")!="")
{
	$name		= $_POST["name"];
	$address	= $_POST["address"];
	$company	= $_POST["company"];
	$city		= $_POST["city"];
	$zip		= $_POST["zip"];
	$email		= $_POST["email"];
	$password	= $_POST["password"];
	$country	= $_POST["country"];
	$gst		= $_POST["gst"];
	$callingCode= $_POST["callingCode"];
	$phone		= $_POST["phone"];
	$mobile		= $_POST["mobile"];
	$domain		= $_POST["domain"];
	$token		= $_POST["token"];
	
	$state = $_POST["state"] = $_POST["state"]==""?"Not applicable":$_POST["state"];
	
	$qry = "insert into users (rcCustomerId,fullname,address,company,city,zip,email,password,country,state,gstid,callingCode,phone,mobile,domainName,token,ts) values (0,'$name','$address','$company','$city','$zip','$email','$password','$country','$state','$gst','$callingCode','$phone','$mobile','$domain','$token',now())";
	
	//?   razorpay_payment_id
	
	if($conn->query($qry))
	{
		$_SESSION["id"]		= $conn->insert_id;
		$_SESSION["name"]	= $name;
		$_SESSION["email"]	= $email;
		$_SESSION["phone"]	= $phone;
		
		$path	= "https://httpapi.com/api/customers/v2/signup.xml";
		$qstring= "auth-userid=456252&api-key=cnJNB0Db8FnfSVkd3wt6ILoVEM5S80T5&username=".$email."&passwd=".$password."&name=".$name."&company=".$company."&address-line-1=".$address."&city=".$city."&state=".$state."&country=".$country."&zipcode=".$zip."&phone-cc=".$callingCode."&phone=".$phone."&lang-pref=en";
		
		$ch = curl_init($path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $qstring);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$result = simplexml_load_string(curl_exec($ch));
		$result = json_encode($result);
		$result = json_decode($result,true);
		
		if(isset($result["status"]))
			$error = 1;
		else
			$error = 0;
		
		if(isset($result[0]) and !$error)
		{
			$qry = "update users set rcCustomerId=$result[0] where id=$_SESSION[id]";
			$conn->query($qry)?>
			<script>
				window.location = "#buy_now";
			</script>
			<?php
		}
		else if(0)
		{
			print_r($result);
			echo "Error";
		}
	}
}?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<script type="text/javascript">
			function business(){
				var selected_input_business = document.querySelector(".business_input_value").value;
				var multi_by_12 = 12;
				var cost_permonth = 80;
				var discount = 10;
				var print_total_business = document.querySelector(".name_space2").innerHTML= '₹' + selected_input_business * multi_by_12 * cost_permonth; 
				document.getElementById("amountb").value = selected_input_business * multi_by_12 * cost_permonth;
				console.log("Helllllo");
			};
			function enterprice(){
				var selected_input_enterprice = document.querySelector(".enterprice_input_value").value;
				var multi_by_12 = 12;
				var cost_permonth = 150;
				var print_total_enterprice = document.querySelector(".totoal_enterprice").innerHTML='₹'+ selected_input_enterprice * multi_by_12 * cost_permonth; 
				document.getElementById("amounte").value = selected_input_enterprice * multi_by_12 * cost_permonth;
			}; 
			function discount(){
				var subtotal_discount = document.querySelector(".subtotal_discount").innerHTML;;
				var gst_amt_percent = 0.18;
				var coupon_text = document.querySelector(".coupon_text").value;
				if (coupon_text == "pro10") {

					var discount_amt_percent = 0.10;
					var amount_p = document.querySelector(".amount_p").innerHTML;
					var amoumt = document.querySelector(".amount").innerHTML= amount_p;
					var discount_amt = amount_p.innerHTML = amount_p * discount_amt_percent;
					var amoumt = document.querySelector(".discount_print").innerHTML= discount_amt;
					var subtotal = document.querySelector(".subtotal_discount").innerHTML=amount_p - discount_amt;
					var gst =document.querySelector(".gst").innerHTML= subtotal * gst_amt_percent ;
					var payble_amount =document.querySelector(".g_total").innerHTML= subtotal + gst ;
					console.log()
					$( ".remove_classs" ).removeClass( "if_class" );
					$( ".Successful_code" ).addClass('valid');
					$( ".invalid_code" ).removeClass('valid');
				} else {
					$( ".remove_classs" ).addClass( "if_class" );
					$( ".invalid_code" ).addClass('valid');
					$( ".Successful_code" ).removeClass('valid');
					var amount_p = document.querySelector(".amount_p").innerHTML;
					var subtotal= amount_p; 
					var gst = subtotal * gst_amt_percent;
					var payble_amount = subtotal + gst ;	
				};
			};
			function ClearFields() {
				var clear_text = document.querySelector(".coupon_text").value = "";
			};		
		</script>
		<!-- Title -->
		<title>ProEmail - Business Email Plans made easy!</title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?kjkjk">

		<!-- Required Meta Tags Always Come First -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="IE=edge">

		<script src="assets/js/jq.js"></script>
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">

		<!-- Google Fonts -->
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">

		<!-- CSS Global Compulsory -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">

		<!-- CSS Implementing Plugins -->
		<link rel="stylesheet" href="assets/vendor/icon-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/vendor/icon-line/css/simple-line-icons.css">
		<link rel="stylesheet" href="assets/vendor/icon-hs/style.css">
		<link rel="stylesheet" href="assets/vendor/hamburgers/hamburgers.min.css">
		<link rel="stylesheet" href="assets/vendor/animate.css">
		<link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css">
		<link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
		<link rel="stylesheet" href="assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
		<link rel="stylesheet" href="assets/vendor/fancybox/jquery.fancybox.css">
		<link rel="stylesheet" href="assets/vendor/cubeportfolio-full/cubeportfolio/css/cubeportfolio.min.css">
		<link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css">
		<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

		<!-- CSS Template -->
		<link rel="stylesheet" href="assets/css/styles.op-app.css">

		<!-- CSS Customization -->
		<link rel="stylesheet" href="assets/css/custom.css">
	</head>

	<body onLoad="business();enterprice()">
		<!---------------------------- TOAST MESSAGE ------------------------------->
			<style>
				/* The snackbar - position it at the bottom and in the middle of the screen */
				#snackbar {
					visibility: hidden; /* Hidden by default. Visible on click */
					min-width: 250px; /* Set a default minimum width */
					margin-left: -125px; /* Divide value of min-width by 2 */
					/*background-color: #333; /* Black background color */
					color: #fff; /* White text color */
					text-align: center; /* Centered text */
					border-radius: 2px; /* Rounded borders */
					padding: 16px; /* Padding */
					position: fixed; /* Sit on top of the screen */
					z-index: 1; /* Add a z-index if needed */
					left: 50%; /* Center the snackbar */
					bottom: 30px; /* 30px from the bottom */
				}

				/* Show the snackbar when clicking on a button (class added with JavaScript) */
				#snackbar.show {
					visibility: visible; /* Show the snackbar */

				/* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
				However, delay the fade out process for 2.5 seconds */
					-webkit-animation: fadein 0.5s, fadeout 0.5s 3.5s;
					animation: fadein 0.5s, fadeout 0.5s 3.5s;
				}

				/* Animations to fade the snackbar in and out */

				@-webkit-keyframes fadein {
					from {bottom: 0; opacity: 0;} 
					to {bottom: 30px; opacity: 1;}
				}

				@keyframes fadein {
					from {bottom: 0; opacity: 0;}
					to {bottom: 30px; opacity: 1;}
				}

				@-webkit-keyframes fadeout {
					from {bottom: 30px; opacity: 1;} 
					to {bottom: 0; opacity: 0;}
				}

				@keyframes fadeout {
					from {bottom: 30px; opacity: 1;}
					to {bottom: 0; opacity: 0;}
				}		
			</style>
			<script language='javascript'>
				function showMessage(msg,clr) {
					// Get the snackbar DIV
					var x = document.getElementById("snackbar");
					x.innerHTML = msg;
					x.style.backgroundColor = clr;
					// Add the "show" class to DIV
					x.className = "show";

					// After 3 seconds, remove the show class from DIV
					setTimeout(function(){ x.className = x.className.replace("show", ""); }, 6000);
				}
			</script>
			<div id="snackbar"></div>
		<!---------------------------- TOAST MESSAGE ------------------------------->

		<?php if(col("username")!="")
		{
			$result = $conn->query("select count(*)cnt from users where email='".col("username")."' and password='".col("password")."'");
			$row = $result->fetch_assoc();

			if($row["cnt"])
			{
				$result = $conn->query("select id,fullname,phone,email from users where email='".col("username")."' and password='".col("password")."'");
				$row = $result->fetch_assoc();

				$_SESSION["id"]		= $row["id"];
				$_SESSION["name"]	= $row["fullname"];
				$_SESSION["email"]	= $row["email"];
				$_SESSION["phone"]	= $row["phone"];
				
				$conn->query("insert into payments (user,amount,ts) values ()");?>
				<script>
					window.location = "#buy_now";
				</script>
				<?php
			}
			else
				showMessage("Login failed.","#FF5050");
		}?>
		
		<main>
			<header id="js-header" class="u-header u-header--sticky-top" data-header-fix-moment="100" data-header-fix-effect="slide">
				<div class="u-header__section u-shadow-v27 g-bg-white g-transition-0_3 g-py-12 g-py-15--md">
				  <nav class="navbar navbar-expand-lg py-0 g-px-15">
					<div class="container g-pos-rel">

					<div class="log_sign">
						<?php if(isset($_SESSION["id"]))
						{?>
							<a href="?logout=true" class="p-0">Logout</a>
							<span> Welcome <?=$_SESSION["name"]?></span>
							<!-- <a href="#" class="p-0" data-toggle="modal" data-target="#logout">Logout </a> -->
							<?php
						}
						else
						{?>
							<a href="#" class="p-0" data-toggle="modal" data-target="#login">Login </a>
							<a href="#" class="p-0" data-toggle="modal" data-target="#signup">Sign up</a>
							<?php
						}?>
					</div> 						
					  <a href="#!" class="js-go-to navbar-brand u-header__logo" data-type="static">
						<img class="u-header__logo-img u-header__logo-img--main g-width-130" src="assets/img/logo.png" alt="Image description" id="home">
					  </a>
					  <div id="navBar" class="collapse navbar-collapse potion_top">
						<div class="navbar-collapse align-items-center flex-sm-row">
						  <ul id="js-scroll-nav" class="navbar-nav g-flex-right--xs text-uppercase w-100 g-font-weight-700 g-font-size-11 g-pt-20 g-pt-0--lg">
							<li class="nav-item g-mr-15--lg g-mb-12 g-mb-0--lg active">
							  <a href="#home" class="nav-link p-0">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#about" class="nav-link p-0">About</a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#benefits" class="nav-link p-0">Benefits</a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#buy_now" class="nav-link p-0">Buy now</a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#business_email" class="nav-link p-0">Business Email</a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#enterprice_email" class="nav-link p-0">Enterprice Email</a>
							</li>
							<li class="nav-item g-mx-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#FAQ" class="nav-link p-0">FAQ</a>
							</li>
							<li class="nav-item g-ml-15--lg g-mb-12 g-mb-0--lg">
							  <a href="#contact" class="nav-link p-0">Contact</a>
							</li>
							<li class="nav-item g-ml-15--lg g-mb-12 g-mb-0--lg trail_vertion" data-toggle="modal" data-target="#trail_vertion">
							  <a href="#" class="nav-link p-0">demo</a>
							</li>                    
						  </ul>
						</div>
					  </div>
					  <button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-15 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
						<span class="hamburger hamburger--slider">
						  <span class="hamburger-box">
							<span class="hamburger-inner"></span>
						  </span>
						</span>
					  </button>
					</div>           
				  </nav>
				</div>
			</header>
			
			<div class="modal fade" id="signup" role="dialog">
				<div class="modal-dialog width_icr">
				  <div class="modal-content">
					<div class="close_parent">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body row">
						<form method="POST" name="signup">
							<div class="heading_login">
								<h4>Sign in to place your order!</h4>
							</div>
							<div class="col-md-12 borders_radius">
								<div class="form-group my_input">
									<input id="name" name="name" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="Name *" required>
								</div>
								<div class="form-group my_input">
									<input id="address" name="address" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="Address *" required>
								</div>
								<div class="form-group my_input">
									<input id="company" name="company" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="Company Name">
								</div>
								<div class="form-group my_input">
									<input id="city" name="city" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="City *" required>
								</div>
								<div class="form-group my_input">
									<input id="zip" name="zip" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="number" placeholder="Zip *" required>
								</div>
								<div class="form-group my_input">
									<input id="email" name="email" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="email" placeholder="Email *" required>
								</div> 
								<div class="form-group my_input">
									<input id="password" name="password" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="password" placeholder="Password *" required>
								</div>
								<div class="form-group my_input">
									<input id="cpassword" name="cpassword" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="password" placeholder="Confirm Password *" required>
								</div>                                  
								<div class="form-group my_input">
									<select id="country" name="country" name="country" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20 padding-left-00" aria-invalid="false" required>
										<option value="">Select a Country</option>
										<option value="AX">Åland Islands</option>
										<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AS">American Samoa</option>
										<option value="AD">Andorra</option>
										<option value="AO">Angola</option>
										<option value="AI">Anguilla</option>
										<option value="AQ">Antarctica</option>
										<option value="AG">Antigua And Barbuda</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australiax</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaijan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
										<option value="BB">Barbados</option>
										<option value="BY">Belarus</option>
										<option value="BE">Belgium</option>
										<option value="BZ">Belize</option>
										<option value="BJ">Benin</option>
										<option value="BM">Bermuda</option>
										<option value="BT">Bhutan</option>
										<option value="BO">Bolivia</option>
										<option value="BA">Bosnia and Herzegovina</option>
										<option value="BW">Botswana</option>
										<option value="BV">ouvet Island</option>
										<option value="BR">Brazil</option>
										<option value="IO">British Indian Ocean Territory</option>
										<option value="BN">Brunei</option>
										<option value="BG">Bulgaria</option>
										<option value="BF">Burkina Faso</option>
										<option value="BI">Burundi</option>
										<option value="KH">Cambodia</option>
										<option value="CM">Cameroon</option>
										<option value="CA">Canada</option>
										<option value="CV">Cape Verde</option>
										<option value="KY">Cayman Islands</option>
										<option value="CF">Central African Republic</option>
										<option value="TD">Chad</option>
										<option value="CL">Chile</option>
										<option value="CN">China</option>
										<option value="CX">Christmas Island</option>
										<option value="CC">Cocos (Keeling) Islands</option>
										<option value="CO">Colombia</option>
										<option value="KM">Comoros</option>
										<option value="CG">Congo</option>
										<option value="CD">Congo, Democractic Republic</option>
										<option value="CK"> Cook Islands</option>
										<option value="CR">Costa Rica</option>
										<option value="CI">Cote D'Ivoire (Ivory Coast)</option>
										<option value="HR">Croatia (Hrvatska)</option>
										<option value="CW">Curacao</option>
										<option value="CY">Cyprus</option>
										<option value="CZ">Czech Republic</option>
										<option value="DK">Denmark</option>
										<option value="DJ">Djibouti</option>
										<option value="DM">Dominica</option>
										<option value="DO">Dominican Republic</option>
										<option value="TP">East Timor</option>
										<option value="EC">Ecuador</option>
										<option value="EG">Egypt</option>
										<option value="SV">El Salvador</option>
										<option value="GQ">Equatorial Guinea</option>
										<option value="ER">Eritrea</option>
										<option value="EE">Estonia</option>
										<option value="ET">Ethiopia</option>
										<option value="FK">Falkland Islands (Islas Malvinas)</option>
										<option value="FO">Faroe Islands</option>
										<option value="FJ">Fiji Islands</option>
										<option value="FI">Finland</option>
										<option value="FR">France</option>
										<option value="FX">France, Metropolitan</option>
										<option value="GF">French Guiana</option>
										<option value="PF">French Polynesia</option>
										<option value="TF">French Southern Territories</option>
										<option value="GA">Gabon</option>
										<option value="GM">Gambia, The</option>
										<option value="GE">Georgia</option>
										<option value="DE">Germany</option>
										<option value="GH">Ghana</option>
										<option value="GI">Gibraltar</option>
										<option value="GR">Greece</option>
										<option value="GL">Greenland</option>
										<option value="GD">Grenada</option>
										<option value="GP">Guadeloupe</option>
										<option value="GU">Guam</option>
										<option value="GT">Guatemala</option>
										<option value="GG">Guernsey</option>
										<option value="GN">Guinea</option>
										<option value="GW">Guinea-Bissau</option>
										<option value="GY">Guyana</option>
										<option value="HT">Haiti</option>
										<option value="HM">Heard and McDonald Islands</option>
										<option value="HN">Honduras</option>
										<option value="HK">Hong Kong S.A.R.</option>
										<option value="HU">Hungary</option>
										<option value="IS">Iceland</option>
										<option value="IN">India</option>
										<option value="ID">Indonesia</option>
										<option value="IQ">Iraq</option>
										<option value="IE">Ireland</option>
										<option value="IM">Isle of Man</option>
										<option value="IL">Israel</option>
										<option value="IT">Italy</option>
										<option value="JM">Jamaica</option>
										<option value="JP">Japan</option>
										<option value="JE">Jersey</option>
										<option value="JO">Jordan</option>
										<option value="KZ">Kazakhstan</option>
										<option value="KE">Kenya</option>
										<option value="KI">Kiribati</option>
										<option value="KR">Korea</option>
										<option value="KO">Kosovo</option>
										<option value="KW">Kuwait</option>
										<option value="KG">Kyrgyzstan</option>
										<option value="LA">Laos</option>
										<option value="LV">Latvia</option>
										<option value="LB">Lebanon</option>
										<option value="LS">Lesotho</option>
										<option value="LR">Liberia</option>
										<option value="LY">Libya</option>
										<option value="LI">Liechtenstein</option>
										<option value="LT">Lithuania</option>
										<option value="LU">Luxembourg</option>
										<option value="MO">Macau S.A.R.</option>
										<option value="MK">Macedonia</option>
										<option value="MG">Madagascar</option>
										<option value="MW">Malawi</option>
										<option value="MY">Malaysia</option>
										<option value="MV">Maldives</option>
										<option value="ML">Mali</option>
										<option value="MT">Malta</option>
										<option value="MH">Marshall Islands</option>
										<option value="MQ">Martinique</option>
										<option value="MR">Mauritania</option>
										<option value="MU">Mauritius</option>
										<option value="YT">Mayotte</option>
										<option value="MX">Mexico</option>
										<option value="FM">Micronesia</option>
										<option value="MD">Moldova</option>
										<option value="MC">Monaco</option>
										<option value="MN">Mongolia</option>
										<option value="ME">Montenegro</option>
										<option value="MS">Montserrat</option>
										<option value="MA">Morocco</option>
										<option value="MZ">Mozambique</option>
										<option value="MM">Myanmar</option>
										<option value="NA">Namibia</option>
										<option value="NR">Nauru</option>
										<option value="NP">Nepal</option>
										<option value="NL">Netherlands</option>
										<option value="AN">Netherlands Antilles</option>
										<option value="NC">New Caledonia</option>
										<option value="NZ">New Zealand</option>
										<option value="NI">Nicaragua</option>
										<option value="NE">Niger</option>
										<option value="NG">Nigeria</option>
										<option value="NU">Niue</option>
										<option value="NF">Norfolk Island</option>
										<option value="MP">Northern Mariana Islands</option>
										<option value="NO">Norway</option>
										<option value="OM">Oman</option>
										<option value="PK">Pakistan</option>
										<option value="PW">Palau</option>
										<option value="PS">Palestinian Territory, Occupied</option>
										<option value="PA">Panama</option>
										<option value="PG">Papua new Guinea</option>
										<option value="PY">Paraguay</option>
										<option value="PE">Peru</option>
										<option value="PH">Philippines</option>
										<option value="PN">Pitcairn Island</option>
										<option value="PL">Poland</option>
										<option value="PT">Portugal</option>
										<option value="PR">Puerto Rico</option>
										<option value="QA">Qatar</option>
										<option value="RE">Reunion</option>
										<option value="RO">Romania</option>
										<option value="RU">Russia</option>
										<option value="RW">Rwanda</option>
										<option value="SH">Saint Helena</option>
										<option value="KN">Saint Kitts And Nevis</option>
										<option value="LC">Saint Lucia</option>
										<option value="PM">
										Saint Pierre and Miquelon
										</option>
										<option value="VC">Saint Vincent And The Grenadines</option>
										<option value="WS">
										Samoa
										</option>
										<option value="SM">
										San Marino
										</option>
										<option value="ST">Sao Tome and Principe</option>
										<option value="SA">
										Saudi Arabia
										</option>
										<option value="SN">
										Senegal
										</option>
										<option value="RS">Serbia</option>
										<option value="SC">
										Seychelles
										</option>
										<option value="SL">
										Sierra Leone
										</option>
										<option value="SG">
										Singapore
										</option>
										<option value="SX">Sint Maarten</option>
										<option value="SK">
										Slovakia
										</option>
										<option value="SI">
										Slovenia
										</option>
										<option value="SB">Solomon Islands</option>
										<option value="SO">
										Somalia
										</option>
										<option value="ZA">
										South Africa
										</option>
										<option value="GS">South Georgia And The South Sandwich Islands</option>
										<option value="ES">
										Spain
										</option>
										<option value="LK">Sri Lanka</option>
										<option value="SR">
										Suriname
										</option>
										<option value="SJ">Svalbard And Jan Mayen Islands</option>
										<option value="SZ">
										Swaziland
										</option>
										<option value="SE">
										Sweden
										</option>
										<option value="CH">Switzerland</option>
										<option value="TW">
										Taiwan
										</option>
										<option value="TJ">Tajikistan</option>
										<option value="TZ">
										Tanzania
										</option>
										<option value="TH">Thailand</option>
										<option value="TL">
										Timor-Leste
										</option>
										<option value="TG">
										Togo
										</option>
										<option value="TK">Tokelau</option>
										<option value="TO">
										Tonga
										</option>
										<option value="TT">Trinidad And Tobago</option>
										<option value="TN">
										Tunisia
										</option>
										<option value="TR">Turkey</option>
										<option value="TM">Turkmenistan</option>
										<option value="TC">
										Turks And Caicos Islands
										</option>
										<option value="TV">
										Tuvalu
										</option>
										<option value="UG">Uganda</option>
										<option value="UA">
										Ukraine
										</option>
										<option value="AE">United Arab Emirates</option>
										<option value="GB">
										United Kingdom
										</option>
										<option value="US">United States</option>
										<option value="UM">United States Minor Outlying Islands</option>
										<option value="UY">
										Uruguay
										</option>
										<option value="UZ">Uzbekistan</option>
										<option value="VU">
										Vanuatu
										</option>
										<option value="VA">Vatican City State (Holy See)</option>
										<option value="VE">Venezuela</option>
										<option value="VN">Vietnam</option>
										<option value="VG">Virgin Islands (British)</option>
										<option value="VI">Virgin Islands (US)</option>
										<option value="WF">Wallis And Futuna Islands</option>
										<option value="EH">WESTERN SAHARA</option>
										<option value="YE">Yemen</option>
										<option value="ZM">Zambia</option>
										<option value="ZW">Zimbabwe</option>
									</select>
								</div>
								<div class="form-group my_input">
									<!-- <select name="state" id="state" class="form-control g-placeholder-inherit g-bg-transparent--focus g-rounded-10 g-px-20 padding-left-00">
										<option value="">Select a State</option>
									</select> -->
									<input type="text" name="state" id="state" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20 padding-left-00" placeholder="State">
								</div>
								<div class="form-group my_input">
									<input id="gst" name="gst" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="GST ID">
								</div>
								<div class="form-group fl margin-left-callingCode padd_input_callingCode">
									<input type="text" name="callingCode" placeholder="Calling Code" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20 callingCode1">
									<label class="dash">-</label>
									<input id="mobile" name="text" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20 mobile_width" type="number" placeholder="Mobile">
								</div> 						
								<div class="form-group my_input">
									<input id="phone" name="phone" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="number" placeholder="Phone *" required>
								</div> 
								<div class="form-group my_input">
									<input id="domain" name="domain" class="form-control g-placeholder-inherit g-bg-transparent--focus g-px-20" type="text" placeholder="Domain name *" required>
								</div>                
							</div>
							<div class="col-md-12 fl">
								<div class="text-center">
									<input type="hidden" name="token" value="<?=rand(10000000,99999999)?>">
									<button type="submit" id="create-account" class="btn btn-md text-uppercase g-font-weight-700 g-font-size-12 g-color-black  g-py-10 g-px-25 mb-0 modal_button">Create Account</button>
								</div>                
							</div>
						</form>
					</div>
				  </div>
				</div>
			</div>

			<section id="enterpriseemails" class="g-theme-bg-gray-light-v1 g-py-90">
				<div class="container" id="enterprice_email">
				  <div class="row">
					<div class="col-md-7 g-mb-50 g-mb-0--md">
						<div class="text_merchand">
							<div class="width_100 fl">
								<div class="product_duration width_100 fl border_bottom_product">
									<div class="product1">
										<h4 class="h6 text-uppercase g-font-weight-700 g-mb-5">Product</h4>
									</div>
									<div class="duration1">
										<h4 class="h6 text-uppercase g-font-weight-700 g-mb-5">Duration</h4>
									</div>
									<div class="price_duraation">
										<h4 class="h6 text-uppercase g-font-weight-700 g-mb-5">Price</h4>
									</div>
								</div>
								<div class="width_100 fl">
									<div class="product1">
										<div class="hosting g-mt-10 width_100 fl">
<!-- 											<div class="hostion_logo">
												<span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
												<label>Hosting</label>
											</div> -->
											<div class="hosting_heading fl g-ml-0">
												<h4 class="h6 text-uppercase g-font-weight-700 g-mb-5">Business Email Hosting</h4>
												<h5>Business Email ( <label class="red_label" id="accounts_p">5</label> Email Accounts )</h5>
												<h5>For <span id="for_p">ashmitpatil.com</span></h5>
											</div>
										</div>
									</div>
									<div class="duration1 g-mt-10">
										<span><span id="months_p">1</span> Month(s)</span> 
									</div>
									<div class="price_duraation g-mt-10">
										<span>₹ <span id="amount_p" class="amount_p">750.00</span></span>
									</div>
								</div>
								<div class="width_100 fl subtotal g-mt-20">
									<div class="width_right">
										<div class="duration1 g-mt-10 border_bottom_subtotal">
											<label class="g-font-weight-700">Amount : </label>
											<label class="g-font-weight-700">Discount (10%) : </label>
											<label class="g-font-weight-700">Subtotal : </label>
											<label class="g-font-weight-700">GST (18%) : </label>
										</div>
										<div class="price_duraation g-mt-10 border_bottom_subtotal">
											<label class="g-font-weight-700 print_height_label">₹ <span class="amount">00.0</span></label>
											<label class="g-font-weight-700 print_height_label">₹ - <span class="discount_print">00.0</span></label>
											<label class="g-font-weight-700 print_height_label">₹ <span id="subtotal_p" class="subtotal_discount">0.00</span></label>
											<label class="g-font-weight-700 print_height_label">₹ <span id="tax_p" class="gst">0.00</span></label>
										</div>
										<div class="width_100 fl color_total_amount">
											<div class="g-mt-10 fl">
												<label class="g-font-weight-700">Payble Amount : </label>
											</div>
											<div class="g-mt-10 fl g-ml-10">
												<label class="g-font-weight-700">₹ <span id="g_total" class="g_total">0.00</span></label>
											</div>	
										</div>
									</div>										
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-5">
					  <div class="text_merchand background_paymrnt">
					  	<div class="width_100 fl">
					  		<div class="successful_heading">
					  			<span><i class="fa fa-check-circle-o" aria-hidden="true"></i></span><h4>Payment Successful</h4>
					  		</div>	
					  	</div>
					  	<div class="width_100 fl">
						  	<div class="successful_text">
						  		<p>Cardholder</p>
						  		<p>borgun payment</p>
						  		<p>card number</p>
						  		<p>474152********0003</p>
						  		<p>00000074</p>
						  	</div>
						</div> 
						<div class="width_100 fl">	
						  	<div class="back_to_store">
						  		<button>Back to store</button>
						  	</div>
						</div>  	
					  </div>
					</div>
				  </div>
				</div>
			</section>

			<section id="FAQ" class="g-py-90">
				<div class="container">
				  <div class="g-px-50--lg">
					<div class="text-uppercase g-line-height-1_3 g-mb-20">
					  <h4 class="g-font-weight-700 g-font-size-11 g-mb-15"><span class="g-color-primary">10.</span> FAQ</h4>
					  <h2 class="g-font-size-36 mb-0">Have some <strong>problems?</strong></h2>
					</div>
					<p class="g-font-size-16 g-mb-65">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					<ul class="nav u-nav-v5-1 text-uppercase g-line-height-1_4 g-font-weight-700 g-font-size-11 g-brd-bottom--md g-brd-gray-light-v4" role="tablist"
						data-target="FAQTabs" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md u-btn-primary btn-block rounded-0 u-btn-outline-lightgray">
					  <li class="nav-item">
						<a class="nav-link g-px-0--md g-pb-15--md g-mr-30--md show active" data-toggle="tab" href="#businessemailfaq" role="tab">Business Emails</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link g-px-0--md g-pb-15--md g-mr-30--md" data-toggle="tab" href="#enterpriseemailfaq" role="tab">Enterprise Emails</a>
					  </li>
					</ul>

					<!-- Tab panes -->
					<div id="FAQTabs" class="tab-content g-pt-20">
					  <div class="tab-pane fade show active" id="businessemailfaq" role="tabpanel">
						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">How will purchasing Business Email benefit me?</h4>
						  <p class="g-mb-10">As opposed to free email solutions, you can give your business a more professional image with Business Email by getting email that is branded with your company's domain name (ex. sales@mybrand.com). In addition, you also benefit from our advanced email technology that gives you the least latency and industry-best uptime, scalability and reliability. An email service being served out of the cloud also means no IT, hardware, software, bandwidth or people costs. And the best part is that you can add email accounts as and when your team grows.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Which Email Clients and protocols are supported?</h4>
						  <p class="g-mb-10">ou can send and receive emails using any desktop-based email client such as Microsoft Outlook, Outlook Express, Mozilla Thunderbird, Eudora, Entourage 2004, Windows Mail, etc. We also have a guide on how you can configure different email clients to send/receive emails. The enterprise email product supports the POP, IMAP and MAPI protocols.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">How do I use my Webmail Interface?</h4>
						  <p class="g-mb-10">To access your Webmail Interface, you can use the white-labelled URL: http://webmail.yourdomainname.com. Once on the log in page, you would need to login with your email address and the corresponding password.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Which mobile phones can I access my mail from?</h4>
						  <p class="g-mb-10">our email can be accessed using any Smartphone or Tablet. Our fluidic webmail, built on HTML 5 & Javascript, is compatible on all major Operating systems such as iOS, Android, Windows Mobile, Symbian and Blackberry.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What is the space provided per Email Account?</h4>
						  <p class="g-mb-10">Each email account comes with 5 GB space dedicated to emails.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What ports do I need to use for Email Hosting?</h4>
						  <p class="g-mb-10">Usually, the port used for the Outgoing Mail Server/SMTP Service is 25. However, there might be a situation where your ISP might be blocking the use of port 25 for SMTP service. To circumvent this you can use an alternate port 587 for sending mails.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Can I create mailing lists?</h4>
						  <p class="g-mb-10">Yes, you can create mailing lists and add/delete users, select a moderator, restrict people from joining a list or even ban users from a list. More information on this can be found in our knowledgebase.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What is your SPAM policy?</h4>
						  <p class="g-mb-10">We take a zero tolerance stance against sending of unsolicited email, bulk emailing, and spam. "Safe lists", purchased lists, and selling of lists will be treated as spam. Any user who sends out spam will have their account terminated with or without notice.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Can I use Auto Responders?</h4>
						  <p class="g-mb-10">Yes, you can. An auto-responder is a program that, when setup for your email address, sends out an automatic, pre-set reply to an email, as soon as it is received at this email address. You can find out more about setting up an auto-responder from our knowledge base.</p>
						</div>
					  </div>

					  <div class="tab-pane fade" id="enterpriseemailfaq" role="tabpanel">
						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">How will purchasing Enterprise Email benefit me?</h4>
						  <p class="g-mb-10">By purchasing an Enterprise Email package you take advantage of our advanced email technology, to give you the least latency and industry best uptime, scalability and reliability. An email service being served out of the cloud also means no IT hardware, software, bandwidth or people costs, and a simple pay-as-you-grow model.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What typical features does an Enterprise Email provide over Personal Email?</h4>
						  <p class="g-mb-10">Enterprise Email supports a number of features that aren't available in Personal email. Shared calendaring, global contacts, shared document management, shared task management, push synchronization for mobile devices, MS Outlook & Mac OSX.</p>
						</div>
						
						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Which Email Clients and protocols are supported?</h4>
						  <p class="g-mb-10">You can send and receive emails using any desktop-based email client such as Microsoft Outlook, Outlook Express, Mozilla Thunderbird, Eudora, Entourage 2004, Windows Mail, etc. We also have a guide on how you can configure different email clients to send/receive emails. The enterprise email product supports the POP, IMAP and MAPI protocols. </p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">How do I use my Webmail Interface?</h4>
						  <p class="g-mb-10">To access your Webmail Interface, you can use the white-labelled URL: http://webmail.yourdomainname.com. Once on the login page, you would need to login with your email address and the corresponding password.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Which mobile phones can I access my mail from?</h4>
						  <p class="g-mb-10">Your email can be accessed using any Smartphone or Tablet. Our responsive webmail, is compatible on all major Operating systems such as iOS, Android, Windows Mobile, Symbian and Blackberry.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What is the space provided per Email Account?</h4>
						  <p class="g-mb-10">Each email account comes with 25 GB space dedicated to email space and 5 GB space dedicated to file storage. Thus, each email account will avail of 30 GB per account of storage.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What ports do I need to use for Email Hosting?</h4>
						  <p class="g-mb-10">Usually, the port used for the Outgoing Mail Server/SMTP Service is 25. However, there might be a situation where your ISP might be blocking the use of port 25 for SMTP service. To circumvent this you can use an alternate port 587 for sending mails.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Can I create mailing lists?</h4>
						  <p class="g-mb-10">Yes, you can create mailing lists and add/delete users, select a moderator, restrict people from joining a list or even ban users from a list. More information on this can be found in our knowledgebase</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">What is your SPAM policy?</h4>
						  <p class="g-mb-10">We take a zero tolerance stance against sending of unsolicited e-mail, bulk emailing, and spam. "Safe lists", purchased lists, and selling of lists will be treated as spam. Any user who sends out spam will have their account terminated with or without notice.</p>
						</div>

						<div class="g-brd-bottom g-theme-brd-gray-light-v1 g-py-10">
						  <h4 class="h6 text-uppercase g-font-weight-700 g-mb-10">Can I use Auto Responders?</h4>
						  <p class="g-mb-10">Yes, you can. An auto-responder is a program that, when setup for your email address, sends out an automatic pre-set reply to an email, as soon as it is received at this email address. To set up an Auto Responder, please refer to the following KnowledgeBase article.</p>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			</section>

			<section id="contact" class="g-bg-primary g-pt-90 g-pb-30 g-pb-90--lg">
				<div class="container">
				  <div class="row">
					<div class="col-lg-5 g-mb-20 g-mb-0--lg">
					  <div class="text-uppercase g-mb-20">
						<h4 class="g-font-weight-700 g-font-size-11 g-color-white g-mb-15">11. Contact us</h4>
						<h2 class="g-font-size-36 g-color-white mb-0">Answers to <strong>your questions</strong></h2>
					  </div>

					  <p class="g-font-size-16 g-color-white mb-0">Integer ut sollicitudin justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					</div>

					<div class="col-lg-7 g-pt-30--lg">
					  <form>
						<div class="row">
						  <div class="col-md-6">
							<div class="form-group g-mb-30">
							  <input id="inputGroup1_1" class="form-control g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" type="text" placeholder="Name">
							</div>

							<div class="form-group g-mb-30">
							  <input id="inputGroup1_2" class="form-control g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" type="email" placeholder="Email *">
							</div>
						  </div>

						  <div class="col-md-6">
							<div class="form-group g-mb-30">
							  <textarea id="inputGroup1_3" class="form-control g-resize-none g-color-white g-placeholder-inherit g-bg-transparent g-bg-transparent--focus g-brd-white g-rounded-10 g-px-20 g-py-10" rows="5" placeholder="Message"></textarea>
							</div>

							<div class="text-center text-md-right">
							  <button class="btn u-btn-white btn-md text-uppercase g-font-weight-700 g-font-size-12 g-color-black g-rounded-10 g-py-10 g-px-25 mb-0" type="submit" role="button">Submit</button>
							</div>
						  </div>
						</div>
					  </form>
					</div>
				  </div>
				</div>
			</section>

			<footer class="footer_bottom">
				<p>Powered by <span> Aspiring Media Tech Pvt. Ltd.</span></p>
			</footer>

			<a class="js-go-to u-go-to-v1" href="#!" data-type="fixed" data-position='{"bottom": 15,"right": 15}' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
				<i class="hs-icon hs-icon-arrow-top"></i>
			</a>
		</main>
		<js>
			<!--Start of Tawk.to Script-->
				<script type="text/javascript">
					var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
					(function(){
					var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
					s1.async=true;
					s1.src='https://embed.tawk.to/5d3ae1849b94cd38bbe96eec/default';
					s1.charset='UTF-8';
					s1.setAttribute('crossorigin','*');
					s0.parentNode.insertBefore(s1,s0);
					})();
				</script>
			<!--End of Tawk.to Script-->
			<!-- JS Global Compulsory -->
			<script src="assets/vendor/jquery/jquery.min.js"></script>
			<script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
			<script src="assets/vendor/popper.min.js"></script>
			<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

			<!-- JS Implementing Plugins -->
			<script src="assets/vendor/appear.js"></script>
			<script src="assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
			<script src="assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
			<script src="assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
			<script src="assets/vendor/fancybox/jquery.fancybox.js"></script>
			<script src="assets/vendor/cubeportfolio-full/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
			<script src="assets/vendor/slick-carousel/slick/slick.js"></script>

			<!-- JS Unify -->
			<script src="assets/js/hs.core.js"></script>
			<script src="assets/js/components/hs.header.js"></script>
			<script src="assets/js/helpers/hs.hamburgers.js"></script>
			<script src="assets/js/components/hs.scroll-nav.js"></script>
			<script src="assets/js/components/hs.onscroll-animation.js"></script>
			<script src="assets/js/components/hs.tabs.js"></script>
			<script src="assets/js/components/hs.cubeportfolio.js"></script>
			<script src="assets/js/components/hs.popup.js"></script>
			<script src="assets/js/components/hs.carousel.js"></script>
			<script src="assets/js/components/hs.go-to.js"></script>

			<!-- JS Customization -->
			<script src="assets/js/custom.js"></script>
			<script src="assets/js/owl.carousel.min.js"></script>
			<script src="assets/js/custom.js"></script>

			<!-- JS Plugins Init. -->
			<script>
			  $(document).on('ready', function () {
				// initialization of carousel
				$.HSCore.components.HSCarousel.init('.js-carousel');

				// initialization of header
				$.HSCore.components.HSHeader.init($('#js-header'));
				$.HSCore.helpers.HSHamburgers.init('.hamburger');

				// initialization of tabs
				$.HSCore.components.HSTabs.init('[role="tablist"]');

				// initialization of scroll animation
				$.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

				// initialization of go to section
				$.HSCore.components.HSGoTo.init('.js-go-to');

				// initialization of popups
				$.HSCore.components.HSPopup.init('.js-fancybox-media', {
				  helpers: {
					media: {},
					overlay: {
					  css: {
						'background': 'rgba(255, 255, 255, .8)'
					  }
					}
				  }
				});
			  });

			  $(window).on('load', function() {
				// initialization of HSScrollNav
				$.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
				  duration: 700
				});

				// initialization of cubeportfolio
				$.HSCore.components.HSCubeportfolio.init('.cbp');
			  });

			  $(window).on('resize', function () {
				setTimeout(function () {
				  $.HSCore.components.HSTabs.init('[role="tablist"]');
				}, 200);
			  });

				$('.owl-carousel-2').owlCarousel({
					loop:true,
					autoplay:false,
					nav:false,
					dots:false,
					responsive:{
					  0:{
						items:1
					  },
					  768:{
						items:1
					  },
						1000:{
							items:1
						}
					}
				})      
			</script>

			<!------------------Sign in Sign up---------------------->
				<script>
					$(document).ready(function(){
						$("#create-account").click(function(){
							var name	= $("#name").val();
							var	address = $("#address").val();
							var	company = $("#company").val();
							var	city	= $("#city").val();
							var	zip		= $("#zip").val();
							var	email	= $("#email").val();
							var	password= $("#password").val();
							var	cpassword= $("#cpassword").val();
							var	country = $("#country").val();
							var	state	= $("#state").val();
							var	gst		= $("#gst").val();
							var	phone	= $("#phone").val();
							var	mobile	= $("#mobile").val();
							var	domain	= $("#domain").val();
							
							if(name=="")
							{
							
							}
						});
						
						$("#country").change(function(){
							var country = $("#country").val();

							if(country!="")
							{
								$.ajax({
									type	: "GET",
									url		: "https://aspiringwebsolutions.supersite2.myorderbox.com/misc/getState.php",
									data	: {"countrycode":country},
									success	: function(response){
												response.each(function(index,value){
													console.log("A");
												});
											  }
								});
							}
							else
							{
								
							}
						});

						$("form[name=signup]").submit(function(){
							if($("#password").val()!=$("#cpassword").val())
							{
								alert("Re-entered password did not match.");
								return false;
							}
						});
					});
				</script>

				<script>
					function validateSignup()
					{
						
					}
				</script>
			<!------------------Sign in Sign up---------------------->

			<script>
				$("#buy_business").click(function(){
					var amount	= parseInt($("#amountb").val());
					var tax		= Math.round($("#amountb").val()*0.18,2);
					
					$("#accounts_p").html($("#noaccounts_b").val());
					$("#amount_p").html(amount);
					$("#subtotal_p").html(amount);
					$("#tax_p").html(tax);
					$("#g_total").html(amount+tax);
				});

				$("#buy_enterprise").click(function(){
					var amount	= parseInt($("#amountb").val());
					var tax		= Math.round($("#amountb").val()*0.18,2);
					
					$("#accounts_p").html($("#noaccounts_b").val());
					$("#amount_p").html(amount);
					$("#subtotal_p").html(amount);
					$("#tax_p").html(tax);
					$("#g_total").html(amount+tax);
				});
			</script>
		</js>
	</body>
</html>
<?php ob_end_flush()?>