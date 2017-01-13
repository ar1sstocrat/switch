<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Панель администратора</title>

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
	
	<?=$output;?>
	
		

	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/chart.min.js"></script>
	<script src="/assets/admin/js/chart-data.js"></script>
	<script src="/assets/admin/js/easypiechart.js"></script>
	<script src="/assets/admin/js/easypiechart-data.js"></script>
	<script src="/assets/admin/js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>