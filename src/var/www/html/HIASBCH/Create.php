<?php session_start();

$pageDetails = [
	"PageID" => "HIASBCH",
	"SubPageID" => "HIASBCH",
	"LowPageID" => "Contracts"
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
									<h6 class="panel-title txt-dark">Deploy HIAS Blockchain Smart Contract</h6>
								</div>
								<div class="pull-right"></div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<p>Before you can deploy a contract, you need to write the contract and compile it using solc. Once you have your compiled smart contract use the contents of the YourSmartContract.abi and YourSmartContract.bin files in the form below. Below is an example of compiling a smart contract written in Solidity.</p>
										<p>&nbsp;</p>

										<p>solc --abi /hias/ethereum/contracts/HIAS-3.sol -o /hias/ethereum/contracts/build --overwrite</p>
										<p>solc --bin /fserver/ethereum/contracts/HIAS-3.sol -o /fserver/ethereum/contracts/build --overwrite</p>
										<p>&nbsp;</p>

										<p>Read the official <a href="https://github.com/AIIAL/HIASBCH/docs/" target="_BLANK">HIASBCH Documentation</a> for more information.</p>
										<p>&nbsp;</p>

									</div>

								</div>
							</div>
						</div>
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-wrap">

										<form data-toggle="validator" role="form" id="genisysai_create" autocomplete="false">
										<div class="row">
											<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="name" class="control-label mb-10">HIAS Blockchain Contract Name</label>
														<input type="text" class="form-control" id="name" name="name" placeholder="HIAS Blockchain Contract Name" required value="" autocomplete="false">
														<span class="help-block">New HIAS Blockchain Contract Name</span>
													</div>
													<div class="form-group mb-0">
														<input type="hidden" class="form-control" id="acc" name="acc" required value="<?=$HIAS->hiasbch->un; ?>">
														<input type="hidden" class="form-control" id="p" name="p" required value="<?=$HIAS->hiasbch->up; ?>">
														<input type="hidden" class="form-control" id="deploy_contract" name="deploy_contract" required value="1">
														<button type="submit" class="btn btn-success btn-anim" id="contract_deploy"><i class="icon-rocket"></i><span class="btn-text">Deploy</span></button>
													</div>
												</div>
												<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group">
														<label for="name" class="control-label mb-10">ABI</label>
														<textarea class="form-control" id="abi" name="abi" placeholder="ABI file contents" required></textarea>
														<span class="help-block">Application Binary Interface file contents</span>
													</div>
													<div class="form-group">
														<label for="name" class="control-label mb-10">BIN</label>
														<textarea class="form-control" id="bin" name="bin" placeholder="BIN file contents" required></textarea>
														<span class="help-block">Binary file contents </span>
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
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="dataLog" style="border: 0px solid; height: 385px; overflow: scroll; padding: 5px; color: #fff; font-size: 10px; overflow-x: hidden;"></div>
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
		<script type="text/javascript" src="/HIASBCH/Classes/HIASBCH.js"></script>
		<script src="/HIASBCH/Classes/web3.js"></script>
		<script type="text/javascript">

			iotJumpwayUI.HideSecret();

			window.addEventListener('load', function () {
				HIASBCH.connect("/hiasbch/api/");
				if(HIASBCH.isConnected()){
					msg = "Connected to HIAS HIASBCH!";
					Logging.logMessage("Core", "HIASBCH", msg);
					HIASBCH.logData(msg);
				} else {
					msg = "Connection to HIAS HIASBCH failed!";
					Logging.logMessage("Core", "HIASBCH", msg);
					HIASBCH.logData(msg);
				}
			});
		</script>
	</body>
</html>
