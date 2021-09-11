<?php session_start();

$pageDetails = [
	"PageID" => "IoT",
	"SubPageID" => "Entities",
	"LowPageID" => "Zones"
];

include dirname(__FILE__) . '/../../Classes/Core/init.php';
include dirname(__FILE__) . '/../iotJumpWay/Classes/iotJumpWay.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="robots" content="noindex, nofollow" />

		<title><?=$HIAS->confs["meta_title"]; ?></title>
		<meta name="description" content="<?=$HIAS->confs["meta_description"]; ?>" />
		<meta name="keywords" content="" />
		<meta name="author" content="hencework"/>

		<script src="https://kit.fontawesome.com/58ed2b8151.js" crossorigin="anonymous"></script>

		<link type="image/x-icon" rel="icon" href="/img/favicon.png" />
		<link type="image/x-icon" rel="shortcut icon" href="/img/favicon.png" />
		<link type="image/x-icon" rel="apple-touch-icon" href="/img/favicon.png" />

		<link href="/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		<link href="/dist/css/style.css" rel="stylesheet" type="text/css">
		<link href="/AI/GeniSysAI/Media/CSS/GeniSys.css" rel="stylesheet" type="text/css">
		<link href="/vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>
	</head>

	<body id="GeniSysAI">

		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>

		<div class="wrapper theme-6-active pimary-color-pink">

			<?php include dirname(__FILE__) . '/../Includes/Nav.php'; ?>
			<?php include dirname(__FILE__) . '/../Includes/LeftNav.php'; ?>
			<?php include dirname(__FILE__) . '/../Includes/RightNav.php'; ?>

			<div class="page-wrapper">
			<div class="container-fluid pt-25">

				<?php include dirname(__FILE__) . '/../Includes/Stats.php'; ?>

				<div class="row">
					<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<?php include dirname(__FILE__) . '/../Includes/Weather.php'; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<?php include dirname(__FILE__) . '/../iotJumpWay/Includes/iotJumpWay.php'; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">HIAS Zones</h6>
								</div>
								<div class="pull-right"><a href="/iotJumpWay/Zones/Create"><i class="fa fa-plus"></i> Create Zone</a></div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">

									<?php
										$zones = $iotJumpWay->get_zones();
										if(!isSet($zones["Error"])):
											foreach($zones as $key => $value):
									?>


									<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
										<div class="panel-wrapper collapse in small" style="background: #333; margin: 5px; padding: 10px; color: #fff;">

											<br /><strong>Name:</strong> <a href="/iotJumpWay/<?=$value["networkLocation"]["value"];?>/Zones/<?=$value["id"];?>"><strong><?=$value["name"]["value"];?></strong></a><br /><strong>ID:</strong> <a href="/iotJumpWay/<?=$value["networkLocation"]["value"];?>/Zones/<?=$value["id"];?>"><strong><?=$value["id"];?></strong></a><br /><strong>Type:</strong> <?=$value["category"]["value"][0];?></strong><br /><br />

											<div class="pull-right small"><strong>Last Updated: <?=$value["dateModified"]["value"]; ?></strong></div>

											<a href="/iotJumpWay/<?=$value["networkLocation"]["value"];?>/Zones/<?=$value["id"];?>"><i class="fa fa-edit"></i>&nbsp;Edit</a>

										</div>
									</div>

									<?php
											endforeach;
										endif;
									?>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<?php include dirname(__FILE__) . '/../Includes/Footer.php'; ?>

		</div>

		<?php  include dirname(__FILE__) . '/../Includes/JS.php'; ?>

		<script type="text/javascript" src="/vendors/bower_components/moment/min/moment.min.js"></script>
		<script type="text/javascript" src="/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
		<script type="text/javascript" src="/dist/js/simpleweather-data.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

		<script type="text/javascript" src="/dist/js/dropdown-bootstrap-extended.js"></script>

		<script type="text/javascript" src="/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/echarts/dist/echarts-en.min.js"></script>
		<script type="text/javascript" src="/vendors/echarts-liquidfill.min.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
		<script type="text/javascript" src="/dist/js/fullcalendar-data.js"></script>

		<script type="text/javascript" src="/dist/js/init.js"></script>
		<script type="text/javascript" src="/dist/js/dashboard-data.js"></script>

		<script type="text/javascript" src="/iotJumpWay/Classes/mqttws31.js"></script>
		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWay.js"></script>
		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWayUI.js"></script>

	</body>

</html>
