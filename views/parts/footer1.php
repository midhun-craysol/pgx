    </main>
    </div>
    </div> 
    </body>
    <script src="<?php echo(BASE_URL); ?>/assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
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