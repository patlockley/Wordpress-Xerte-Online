<!-- 

University of Nottingham Xerte Online Toolkits

HTML to use at the top of the Xerte drawing applicatin window 
Version 1.0

-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="swfobject.js"></script>
</head>

<body>


<div id="flashcontent">
  This text is replaced by the Flash movie.
</div>


<script type="text/javascript">
   var so = new SWFObject("drawEdit.swf", "mymovie", "1600", "1000", "8,0,0,0", "#e0e0e0");
   so.addParam("quality", "high");
   so.addVariable("wordpress", "true");
   so.write("flashcontent");
   </script>
  