<!DOCTYPE HTML>
<head>
<title>My Bookings</title>
<link rel='stylesheet' href='web/css/fullcalendar.css' />
<link rel='stylesheet' href='web/css/jquery.qtip.css' />
<script src='web/js/moment.min.js'></script>
<script src='web/js/fullcalendar.js'></script>
<script src='web/js/jquery.qtip.js'></script>
<script src='web/js/events/events_mybookings.js'></script>

<script type="text/javascript">

</script>

<link  href="http://fonts.googleapis.com/css?
family=Reenie+Beanie:regular" 
rel="stylesheet"
type="text/css">

<style>
.bookings_list{
	 color:#000;
  background:#ffc;
  display:block;

  
  padding:1em;
  
  font-family:arial,sans-serif;
  font-size:100%;
  
  font-family:"Reenie Beanie",arial,sans-serif;
  font-size:140%;
  
  /* Firefox */
  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
  /* Safari+Chrome */
  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  /* Opera */
  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  
  -moz-transition:-moz-transform .15s linear;
  -o-transition:-o-transform .15s linear;
  -webkit-transition:-webkit-transform .15s linear;
  
}


a:nth-child(odd) p{
-o-transform:rotate(4deg);
  -webkit-transform:rotate(4deg);
  -moz-transform:rotate(4deg);
  position:relative;
  top:5px;
  background:#cfc;
}


a:nth-child(even) p{
-o-transform:rotate(-3deg);
  -webkit-transform:rotate(-3deg);
  -moz-transform:rotate(-3deg);
  position:relative;
  top:-5px;
  background:#ccf;
}


</style>
</head>
<html>
<body class="landing">
<!-- Two -->
<section id="two" class="wrapper style2">


<div class="container"><header class="major">
<h2>MY BOOKINGS</h2>
</header>

<div id='calendar_list'></div>

<div id='calendar'></div>
</div>
</section>

</body>
</html>
