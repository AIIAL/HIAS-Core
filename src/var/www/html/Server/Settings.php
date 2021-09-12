<?php session_start();

$pageDetails = [
	"PageID" => "Server",
	"SubPageID" => "Server",
	"LowPageID" => "Server"
];

include dirname(__FILE__) . '/../../Classes/Core/init.php';
include dirname(__FILE__) . '/../iotJumpWay/Classes/iotJumpWay.php';
include dirname(__FILE__) . '/../iotJumpWay/Classes/iotJumpWayAgents.php';
include dirname(__FILE__) . '/../Server/Classes/Server.php';

$stats = $iotJumpWay->get_stats();
list($on, $off) = $iotJumpWay->get_device_status($HIAS->confs["status"]);
$data = $Server->server_life_graph($HIAS->confs["aid"], 100);

$dates = [];
$points = [];
$legend = [];
$cpu = [];
$memory = [];
$diskspace = [];
$temperature = [];
$dates = [];

if(isSet($data["ResponseData"])):
	foreach($data["ResponseData"] AS $key => $value):
		if(isSet($value["Data"])):
			$cpu[] = $value["Data"]["CPU"];
			$memory[] = $value["Data"]["Memory"];
			$diskspace[] = $value["Data"]["Diskspace"];
			$temperature[] = $value["Data"]["Temperature"];
			$dates[] = $value["Time"];
		endif;
	endforeach;

	$dates = array_reverse($dates);

	$points = [[
		"name" => "CPU",
		"data" => array_reverse($cpu),
		"type" => 'line',
		"smooth" => true,
		"color" => ['orange']
	],
	[
		"name" => "Memory",
		"data" => array_reverse($memory),
		"type" => 'line',
		"smooth" => true,
		"color" => ['yellow']
	],
	[
		"name" => "Diskspace",
		"data" => array_reverse($diskspace),
		"type" => 'line',
		"smooth" => true,
		"color" => ['red']
	],
	[
		"name" => "Temperature",
		"data" => array_reverse($temperature),
		"type" => 'line',
		"smooth" => true,
		"color" => ['purple']
	]];
	$legend = ["CPU","Memory","Diskspace","Temperature"];
endif;

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
		<link href="/dist/css/style.css" rel="stylesheet" type="text/css">
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
									<h6 class="panel-title txt-dark">Server Resource Monitor</h6>
								</div>
								<div class="pull-right">
									<select class="form-control" id="currentSensor" name="currentSensor" required>
										<option value="Life">Life Monitor</option>

									</select>
									<div class="pull-left inline-block dropdown">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="e_chart_1" class="" style="height: 375px;"></div>
								</div>
							</div>
						</div>
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Hospital Intelligent Automation System Server</h6>
								</div>
								<div class="pull-right"></div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">

									<p>The HIAS Server is the core of the HIAS network, powering a network of intelligent, IoT connected devices. This page allows you to update the core configuration required for the server.</p>

								</div>
							</div>
						</div>
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Edit HIAS Server Settings</h6>
								</div>
								<div class="pull-right"></div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-wrap">
										<form data-toggle="validator" role="form" id="server_update">
											<div class="row">
												<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="name" class="control-label mb-10">HIAS Version</label>
														<input type="text" class="form-control" id="version" name="version" placeholder="HIAS Version" required value="<?=$HIAS->confs["version"]; ?>">
														<span class="help-block">HIAS Version Number</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">Domain</label>
														<input type="text" class="form-control hider" id="domainString" name="domainString" placeholder="HIAS Domain Name" required value="<?=$HIAS->confs["domainString"] ? $HIAS->helpers->oDecrypt($HIAS->confs["domainString"]) : ""; ?>">
														<span class="help-block"> Domain Name For HIAS Server</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">phpMyAdmin Directory</label>
														<input type="text" class="form-control hider" id="phpmyadmin" name="phpmyadmin" placeholder="HIAS phpMyAdmin Directory" required value="<?=$HIAS->confs["phpmyadmin"]; ?>">
														<span class="help-block">HIAS phpMyAdmin Directory</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">Default Latitude</label>
														<input type="text" class="form-control hider" id="lt" name="lt" placeholder="Default Latitude" required value="<?=$HIAS->confs["lt"] ? $HIAS->helpers->oDecrypt($HIAS->confs["lt"]) : ""; ?>">
														<span class="help-block"> Default Latitude Used In HIAS</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">Default Longitude</label>
														<input type="text" class="form-control hider" id="lg" name="lg" placeholder="Default Longitude" required value="<?=$HIAS->confs["lg"] ? $HIAS->helpers->oDecrypt($HIAS->confs["lg"]) : ""; ?>">
														<span class="help-block"> Default Longitude Used In HIAS</span>
													</div>
													<div class="form-group mb-0">
														<input type="hidden" class="form-control" id="update_server" name="update_server" required value="1">
														<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Update</span></button>
													</div>
												</div>
												<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="name" class="control-label mb-10">Google Maps API Key</label>
														<input type="text" class="form-control hider" id="gmaps" name="gmaps" placeholder="Google Maps API Key" required value="<?=$HIAS->confs["gmaps"] ? $HIAS->helpers->oDecrypt($HIAS->confs["gmaps"]) : ""; ?>">
														<span class="help-block"> Google Maps API Key</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">Recaptcha API Public Key</label>
														<input type="text" class="form-control hider" id="recaptcha" name="recaptcha" placeholder="Recaptcha API Public Key" required value="<?=$HIAS->confs["recaptcha"] ? $HIAS->helpers->oDecrypt($HIAS->confs["recaptcha"]) : ""; ?>">
														<span class="help-block"> Recaptcha Public API key</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">Recaptcha API Private Key</label>
														<input type="text" class="form-control hider" id="recaptchas" name="recaptchas" placeholder="Recaptcha API Public Key" required value="<?=$HIAS->confs["recaptchas"] ? $HIAS->helpers->oDecrypt($HIAS->confs["recaptchas"]) : ""; ?>">
														<span class="help-block"> Recaptcha Private API key</span>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Server Stats</h2>
								</div>
								<div class="pull-right"><span id="offline1" style="color: #33F9FF !important;" class="<?=$on; ?>"><i class="fas fa-power-off" style="color: #33F9FF !important;"></i> Online</span> <span id="online1" class="<?=$off; ?>" style="color: #99A3A4 !important;"><i class="fas fa-power-off" style="color: #99A3A4 !important;"></i> Offline</span></div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<i class="fa fa-microchip data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="svrecpu"><?=$HIAS->confs["cpu"]; ?></span>% &nbsp;&nbsp;
									<i class="zmdi zmdi-memory data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="svremem"><?=$HIAS->confs["mem"]; ?></span>% &nbsp;&nbsp;
									<i class="far fa-hdd data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="svrehdd"><?=$HIAS->confs["hdd"]; ?></span>% &nbsp;&nbsp;
									<i class="fa fa-thermometer-quarter data-right-rep-icon txt-light" aria-hidden="true"></i>&nbsp;<span id="svretempr"><?=$HIAS->confs["tempr"]; ?></span>°C
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12"></div>
				</div>

			</div>

			<?php include dirname(__FILE__) . '/../Includes/Footer.php'; ?>

		</div>

		<?php  include dirname(__FILE__) . '/../Includes/JS.php'; ?>

		<script type="text/javascript" src="/iotJumpWay/Classes/mqttws31.js"></script>

		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWay.js"></script>
		<script type="text/javascript" src="/iotJumpWay/Classes/iotJumpWayUI.js"></script>

		<script type="text/javascript" src="/vendors/bower_components/echarts/dist/echarts-en.min.js"></script>
		<script type="text/javascript" src="/vendors/echarts-liquidfill.min.js"></script>

		<script>

			var eChart_1 = echarts.init(document.getElementById('e_chart_1'));

			var option = {
				tooltip: {
					trigger: 'axis',
					backgroundColor: 'rgba(33,33,33,1)',
					borderRadius: 0,
					padding: 10,
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: 'rgba(33,33,33,1)'
						}
					},
					textStyle: {
						color: '#fff',
						fontStyle: 'normal',
						fontWeight: 'normal',
						fontFamily: "'Montserrat', sans-serif",
						fontSize: 12
					}
				},
				xAxis: {
					type: 'category',
					name: 'Time',
					nameLocation: 'middle',
					nameGap: 50,
					axisLabel: {
						textStyle: {
							color: '#fff',
							fontStyle: 'normal',
							fontWeight: 'normal',
							fontFamily: "'Montserrat', sans-serif",
							fontSize: 12
						},
						interval: 1,
						rotate: 45
					},
					data: <?=json_encode($dates); ?>
				},
				yAxis: {
					axisLabel: {
						textStyle: {
							color: '#fff',
							fontStyle: 'normal',
							fontWeight: 'normal',
							fontFamily: "'Montserrat', sans-serif",
							fontSize: 12
						}
					},
					type: 'value',
					name: 'Y-Axis',
					nameLocation: 'center',
					nameGap: 50
				},
				legend: {
					data: <?=json_encode($legend); ?>,
					inactiveColor: '#fff',
					padding: [0, 0, 20, 0]
				},
				grid: {
					top: 10,
					left: 0,
					right: 0,
					bottom: 100,
					containLabel: true
				},
				series: <?=json_encode($points); ?>
			};
			eChart_1.setOption(option);
			eChart_1.resize();

			setInterval(function() {
				iotJumpWay.updateServerLifeGraph();
			}, 60000);
		</script>

	</body>

</html>
