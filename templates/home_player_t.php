<div id='tabs'>
<div class="tab" id="tables-tab">Tavoli</div>
<div class="tab" id="character-tab">Character</div>

<div style="clear: both"></div>
</div>
<div class='tab-content' id="tables-content">
  
    
   
    <?php echo $content; ?>
</div> <!-- tables-content -->

<div class='tab-content' id="character-content">
    <?php echo $_SESSION['email'];?>
    <hr/>
    <div id="avatar"><img height="150" width="150" src="<?php echo $ch_info['avatar']?>"></div>
    <?php if($ch_info['avatar']==""):?>
    <form enctype="multipart/form-data" method="post">
        <input type="file" name="file">
    <input type="submit">
    <input type="hidden" name="a" value="file_upload">
    </form>
    <?php endif;?>
</div>