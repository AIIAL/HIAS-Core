<?php session_start();

$pageDetails = [
    "PageID" => "AI",
    "SubPageID" => "AIAgents",
	"LowPageID" => "AIAgents"
];

include dirname(__FILE__) . '/../../Classes/Core/init.php';
include dirname(__FILE__) . '/../iotJumpWay/Classes/iotJumpWay.php';
include dirname(__FILE__) . '/../AI/Classes/AiAgents.php';


$aid = filter_input(INPUT_GET, 'agent', FILTER_SANITIZE_STRING);
$agent = $AiAgents->get_agent($aid);
$AiAgents->prepare_inference($aid);

list($dev1On, $dev1Off) = $iotJumpWay->get_device_status($agent["networkStatus"]["value"]);

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
	 <meta name="author" content="hencework" />

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
	 	 	 	 	 <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
	 	 	 	 	 	 <div class="panel panel-default card-view panel-refresh">
	 	 	 	 	 	 	 <div class="panel-heading">
	 	 	 	 	 	 	 	 <div class="pull-left">
	 	 	 	 	 	 	 	 	 <h6 class="panel-title txt-dark"><?=$agent["name"]["value"]; ?></h6>
	 	 	 	 	 	 	 	 </div>
	 	 	 	 	 	 	 	 <div class="pull-right"><a href="#" id="uploadData"><i class="fas fa-upload  fa-fw"></i>&nbsp;UPLOAD DATA</a>&nbsp;&nbsp;&nbsp;<a href="#" id="deleteData"><i class="fas fa-trash  fa-fw"></i>&nbsp;DELETE DATA</a></div>
	 	 	 	 	 	 	 	 <div class="clearfix"></div>
	 	 	 	 	 	 	 </div>
	 	 	 	 	 	 	 <div class="panel-wrapper collapse in">
	 	 	 	 	 	 	 	 <div class="panel-body">

									<input type="file" id="dataup" class="hide" accept="image/*" multiple />

									<div class="row" id="dataBlock">

									<?php
										$images = glob($AiAgents->dataFiles, GLOB_BRACE);
										$count = 1;
										if(count($images)):
											foreach( $images as $image ):
												echo "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><img src='../../../" . $image . "' style='width: 100%; cursor: pointer;' class='classify' title='" . $image . "' id='" . $image . "' /></div>";
												if($count%6 == 0):
													echo"<div class='clearfix'></div>";
												endif;
												$count++;
											endforeach;
										else:
											echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><p>Please upload your test dataset.</p></div>";
										endif;
									?>

									</div>
								</div>
							</div>
						</div>
	 	 	 	 	 </div>
	 	 	 	 	 <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
								<div class="pull-right"><span id="offline1" style="color: #33F9FF !important;" class="<?=$dev1On; ?>"><i class="fas fa-power-off" style="color: #33F9FF !important;"></i> Online</span> <span id="online1" class="<?=$dev1Off; ?>" style="color: #99A3A4 !important;"><i class="fas fa-power-off" style="color: #99A3A4 !important;"></i> Offline</span></div>
									<div class="form-group">
										<label class="control-label col-md-5">Status</label>
										<div class="col-md-12">
											<i class="fas fa-battery-full data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="idebatU"><?=$agent["batteryLevel"]["value"]; ?></span>% &nbsp;&nbsp;
											<i class="fa fa-microchip data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="idecpuU"><?=$agent["cpuUsage"]["value"]; ?></span>% &nbsp;&nbsp;
											<i class="zmdi zmdi-memory data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="idememU"><?=$agent["memoryUsage"]["value"]; ?></span>% &nbsp;&nbsp;
											<i class="far fa-hdd data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="idehddU"><?=$agent["hddUsage"]["value"]; ?></span>% &nbsp;&nbsp;
											<i class="fa fa-thermometer-quarter data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="idetempU"><?=$agent["temperature"]["value"]; ?></span>°C
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Diagnosis Results</h6>
								</div>
								<div class="pull-right">
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">

									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="imageView"></div>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
										<strong><span id="imName"></span></strong><br /><br />
										<span id="imClass"></span><br />
										<span id="imResult"></span><br />
										<span id="imConf"></span>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<?php include dirname(__FILE__) . '/../Includes/Footer.php'; ?>

		</div>

		<?php  include dirname(__FILE__) . '/../Includes/JS.php'; ?>

		<script type="text/javascript" src="/iotJumpWay/Classes/mqttws31.js"></script>
		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWay.js"></script>
		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWayUI.js"></script>
		<script type="text/javascript" src="/AI/Classes/AiAgents.js"></script>

		<script type="text/javascript">

	 	 	 $(document).ready(function() {
				AiAgents.StartAgentLife();
				AiAgents.setOpacity();
				AiAgents.prepareUploadForm();
	 	 	 });

		</script>

	</body>
</html>