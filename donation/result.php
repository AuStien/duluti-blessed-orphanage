<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Duluti Blessed Orphanage</title>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<!-- -->
		<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	
	<body>
		<!-- contact-form -->	
		<div class="message warning">
			<div class="inset">
				<div class="login-head">
					<h1>Donation</h1>
					
				</div>

				<form id="myform" name="myform" METHOD="GET" ACTION="index.php">
                    <b> <?php echo $_POST['Lite_Currency_AlphaCode']?> </b>
					<div id="TranSuccess" name="TranSuccess" style="display:none" >
						<p style="font-family:arial;color:#631414;text-align:left; ">We can't thank you enough for your recent donation. Your transaction was processed successfully. 
							The children at the home will be so excited to receive the funds. Please know how much you've helped them and how appreciative we are of your kindness. <br> 
						<br>At this point you will have received an email confirmation of your payment with REF: <b> <?php echo $_POST['MERCHANTREFERENCE']?> </b><br><br> <br>
						For another payment please click on the button below</p>
					</div>
					
					<div id="TranFail" name="TranFail" style="display:none" >
						<p style="font-family:arial;color:#631414;text-align:left; "> Transaction failed with reason (Error Code <?php echo $_POST['LITE_PAYMENT_CARD_STATUS']?>) : <b> <?php echo $_POST['LITE_RESULT_DESCRIPTION']?> </b> <br><br>Please try again with another card </p>
					</div>
					<div id="TranTryLater" name="TranTryLater" style="display:none"  >
						<p style="font-family:arial;color:#631414;text-align:left; "> Transaction failed due to technical problems, please try again later</p>
					</div>
					
					
					
					<div class="submit">
						<input type="submit" id="btnsubmit" name="btnsubmit" value="Back" onclick="javascript: form.action='../donate.html';" >
						
					</div>
					
					<?php
						
						switch ($_POST['LITE_PAYMENT_CARD_STATUS']) {
							case "0":
							{
                                ?>
                                <script type="text/javascript">document.getElementById('TranSuccess').style.display = 'inline';</script>
                                <script type="text/javascript">document.getElementById('btnsubmit').value = 'Back to page';</script>
                                <!--script type="text/javascript">document.getElementById('btnsubmit').onclick = function () { form.action='index.html'; };</script-->
                                <?php
							}
							break;
							case "9":
							{
                                ?>
                                <script type="text/javascript">document.getElementById('TranTryLater').style.display = 'inline';</script>
                                <script type="text/javascript">document.getElementById('btnsubmit').value = 'Back to page';</script>
                                <?php
							}
							break;
							default:
							{
                                ?>
                                <script type="text/javascript">document.getElementById('TranFail').style.display = 'inline';</script>
                                <script type="text/javascript">document.getElementById('btnsubmit').value = 'Back to page';</script>
                                <?php
							}
						}
					?>
					
				</form>
			</div>					
			
		</div>
	</body>
</html>		