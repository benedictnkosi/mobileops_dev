<!DOCTYPE HTML>

<html>
<head>
<link href="web/css/dropzone.css" media="all" rel="stylesheet"
type="text/css" />
	
	<link href="web/css/dropzone-style.css" media="all" rel="stylesheet"
type="text/css" />
	
	
	<script src="web/js/dropzone.js"></script>
	
</head>
<body class="landing">

<form action="/file-upload"
      class="dropzone"
      id="fileUpload_dropzone"></form>
      
      
      <script type="text/javascript">
      Dropzone.options.fileUpload_dropzone = {
			  paramName: "file", // The name that will be used to transfer the file
			  maxFilesize: 2, // MB
			  accept: function(file, done) {
			    if (file.name == "justinbieber.jpg") {
			      done("Naha, you don't.");
			    }
			    else { done(); }
			  }
			};
			</script>
</body>
</html>
