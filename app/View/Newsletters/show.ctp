<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  </script>
</head>
<body>
  <div id="accordion">
    <?php foreach ($year as $yearkey=>$years): ?>
     <h3><?php echo $yearkey;?></h3>
     <div>
       <?php foreach ($years as $month): ?>
       	<p>
          <?php echo $month;?>
        </p>
      <?php endforeach; ?>    
    </div>   
    <?php endforeach; ?>	  
  </div>
</body>