<!DOCTYPE html>
<html>
<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
 <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
 <meta name="csrf-token" content="{{ csrf_token() }}" /> 
	<title>@yield('title')</title>
</head>

<body>
	<div style="text-align: center; margin:auto; width: 50%">
		@yield('content')
	</div>
</body>

</html>