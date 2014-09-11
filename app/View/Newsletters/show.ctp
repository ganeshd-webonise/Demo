<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
   <?php
    echo $this->Html->script(array('jQuery/jquery-1.9.1','jQuery/jquery-ui-1.10.3'), false);
    echo $this->Html->css(array('accordion'), 'stylesheet', array('inline' => false));
  ?> 
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