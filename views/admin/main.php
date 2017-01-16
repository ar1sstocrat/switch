<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Панель администратора - <?=$current_section?></title>
<?php foreach($css_files as $files=>$css):?>
    <link type="text/css" rel="stylesheet" href="<?=$css?>">
<?php endforeach;?>
<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/admin/css/datepicker3.css" rel="stylesheet">
<link href="/assets/admin/css/styles.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<link href="/assets/admin/css/rgba-fallback.css" rel="stylesheet">
<script src="/assets/admin/js/html5shiv.js"></script>
<script src="/assets/admin/js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                            <a class="navbar-brand" href="http://vinnitsa.volia.com" target="blank"><span>ВОЛЯ</span> Винница</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
							<i class="glyphicon glyphicon-bell"></i>  <span class="label label-primary">18</span>
						</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li>
								<a href="#">
									<div>
										<em class="glyphicon glyphicon-envelope"></em> 1 New Message
										<span class="pull-right text-muted small">3 mins ago</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">
									<div>
										<em class="glyphicon glyphicon-heart"></em> 12 New Likes
										<span class="pull-right text-muted small">4 mins ago</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">
									<div>
										<em class="glyphicon glyphicon-user"></em> 5 New Followers
										<span class="pull-right text-muted small">4 mins ago</span>
									</div>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            
            <div class="user-settings-wrapper ">
                <img alt="<?=$user['username']?>" src="<?=$user['img']?>" width="50" height="50" class="img-circle small ">
                <strong><?=$user['first_name'].' '.$user['last_name']?></strong>
            </div>
            <ul class="nav menu"><li role="presentation" class="divider"></li></ul>
            <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Поиск">
			</div>
            </form>
		<ul class="nav menu">
<?php foreach($menu as $key=>$value)
{
    if(!is_array($value))
    {
        $active = $current_section==$value ? 'active' : '';
        echo "<li class='{$active}'><a href='/{$key}'>{$value}</a></li>";
    }
    else
    {
        foreach($value as $keys=>$val)
        {
            echo "<li class='parent'><a href='#'>{$keys} <span data-toggle='collapse' href='#{$key}' class='icon pull-right'><em class='glyphicon glyphicon-s glyphicon-plus'></em></span></a>";
            echo "<ul class='children collapse' id='{$key}'>";
            foreach($val as $k=>$v)
            {
                $active = $current_section==$v ? 'active' : '';
                echo "<li><a class='{$active}' href='/{$k}'><span class='glyphicon glyphicon-share-alt'></span> {$v}</a></li>";
            }
            echo "</ul>";
        }
    }
}
?>
			<li role="presentation" class="divider"></li>
			<li><a href="/admin/auth/logout"><span class="glyphicon glyphicon-log-out"></span>Выйти</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/admin"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><?=$current_section;?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header"><?=$current_section;?></h2>
			</div>
		</div><!--/.row-->
		<?=$output?>
	</div>	<!--/.main-->

	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/chart.min.js"></script>
	<script src="/assets/admin/js/chart-data.js"></script>
	<script src="/assets/admin/js/easypiechart.js"></script>
	<script src="/assets/admin/js/easypiechart-data.js"></script>
	<script src="/assets/admin/js/bootstrap-datepicker.js"></script>
	<script src="/assets/admin/js/custom.js"></script>
        <?php foreach($js_files as $file):?>
            <script src="<?=$file?>"></script>
        <?php endforeach;?>
	<script>
	window.onload = function(){ 
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart2 = document.getElementById("bar-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)", 
			scaleFontColor: "#ffffff"
		});
		var chart5 = document.getElementById("radar-chart").getContext("2d");
		window.myRadarChart = new Chart(chart5).Radar(radarData, {
			responsive : true,
			scaleLineColor: "rgba(255,255,255,.05)",
			angleLineColor : "rgba(255,255,255,.2)"
		});
		
	};
	</script>
</body>

</html>

