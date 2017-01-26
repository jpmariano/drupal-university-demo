<?php

/**
 * @file jcarousel-view.tpl.php
 * View template to display a list as a carousel.
 */
?>
<ul class="<?php print $jcarousel_classes; ?>">
  <?php for($i = 0; $i < count($rows); $i +=8): ?>
    <li class="<?php print $row_classes[$i]; ?>">
      <?php for($j = 0; $j < 8; $j ++):?>
        <?php if(isset($rows[$i + $j])):?>
          <div class="view-item">
	        <?php print $rows[$i + $j]; ?>
	      </div>
	    <?php endif;?>
	  <?php endfor;?>
	</li>
  <?php endfor; ?>
</ul>
