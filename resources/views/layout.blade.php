<!DOCTYPE html>
<html>
<head>
	<title>Tasks</title>
</head>

<body>
	<div id="time" style="float: right">
	    <p>{{\Carbon\Carbon::parse(date('d.m.Y H:i:s'))->toFormattedDateString()}}</p>
	</div>

	<div style="clear: both; text-align: center; margin:auto; width: 50%">
		@yield('content')
	</div>
</body>
</html>