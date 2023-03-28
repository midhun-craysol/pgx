 
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="<?php echo(BASE_URL); ?>/assets/bootstrap/js/bootstrap.bundle.min.js" ></script> 
    <script src="<?php echo(BASE_URL); ?>assets/js/jquery.dataTables.min.js" ></script>
      <?php 
      if(!empty($scripts)){
      foreach ($scripts as $script) { ?>    
      <script type="text/javascript" src="<?php echo(BASE_URL."assets/custom-js/".$script.".js"); ?>" ></script>  
      <?php  
          }
        }
      ?> 
  </body>
</html>