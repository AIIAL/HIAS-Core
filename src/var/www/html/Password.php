<?php session_start();

$pageDetails = [
    "PageID" => "Restricted"
];

include dirname(__FILE__) . '/../Classes/Core/init.php';
include dirname(__FILE__) . '/../Classes/Core/GeniSys.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="robots" content="noindex, nofollow" />

		<title><?=$_GeniSys->_confs["meta_title"]; ?></title>
		<meta name="description" content="<?=$_GeniSys->_confs["meta_description"]; ?>" />
		<meta name="keywords" content="" />
		<meta name="author" content="hencework"/>

		<link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link type="image/x-icon" rel="icon" href="<?=$domain; ?>/img/favicon.png" />
		<link type="image/x-icon" rel="shortcut icon" href="<?=$domain; ?>/img/favicon.png" />
		<link type="image/x-icon" rel="apple-touch-icon" href="<?=$domain; ?>/img/favicon.png" />
		
		<link href="<?=$domain; ?>/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		
		<link href="<?=$domain; ?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		
		<link href="<?=$domain; ?>/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body id="GeniSysAI">
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
				
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="index.html">
						<img class="brand-img mr-10" src="<?=$domain; ?>/img/logo.png" alt="brand"/>
						<span class="brand-text" style="color: black !important;">HIAS - Hospital Intelligent Automation System</span>
					</a>
				</div>
				<div class="form-group mb-0 pull-right"></div>
				<div class="clearfix"></div>
			</header>
		
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
				
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Reset HIAS Password</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form role="form" id="form">
												<div class="form-group">
													<label class="control-label mb-10" for="username">Username</label>
													<input type="text" class="form-control" required="" id="username" name="username" placeholder="Enter username">
												</div>
												<div class="form-group">
													<div class="g-recaptcha" data-sitekey="<?=$_GeniSys->_helpers->oDecrypt($_GeniSys->_confs["recaptcha"]); ?>"></div>
													<input id="reset_pass" type="hidden" class="" name="reset_pass" value="1">
												</div>
												<div class="form-group text-center">
													<button type="submit" id="resetpass" class="btn btn-primary">Reset Password</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>

        <?php  include dirname(__FILE__) . '/Includes/JS.php'; ?>

	</body>
</html>
