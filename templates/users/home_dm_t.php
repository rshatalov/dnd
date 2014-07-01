<div id='tabs'>
<div class="tab" id="tables-tab">Tavoli</div>
<div class="tab" id="monsters-tab">Mostri & PNG</div>
<div class="tab" id="newTable-tab">Create table</div>
<?php if ($nt != "")
{
    if ($nt == "create_monster")
    {
        echo "<div class='tab' id='createMonster-tab'>Create monster</div>";
    }
    else if ($nt == "edit_monster")
    {
        echo "<div class='tab' id='editMonster-tab'>Edit monster</div>";
    }
    
}
    ?>
<div style="clear: both"></div>
</div>
<div class='tab-content' id="tables-content">
    
    <table>
        <tr>
            <th>Nome</th> 
            <th>Descrizione</th> 
            <th>Giocatori</th> 
            <th>Candidati</th> 
            <th>Stato</th> 
        </tr>
        <?php echo $content; ?>
    </table>
    
</div> <!-- tables-content -->
<div class='tab-content' id="monsters-content">
    <?php 
        echo $mt; /* monsters-tab */
     ?>
   
</div>

<div class='tab-content' id="newTable-content">
    <form action='?tab=tables' method='post'>
        <input type='hidden' name='a' value='create_table'>
        <input type="text" name='table_name' placeholder="Table's name">
        <textarea name='table_desc' placeholder="Table's description"></textarea>
        <input type="submit">
    </form>
   
</div>

<?php if ($nt != "")
{
    if ($nt == "create_monster")
    {
        echo "<div class='tab-content' id='createMonster-content'>";
        $ch->generate_template();
    }
    else if ($nt == "edit_monster")
    {
        echo "<div class='tab-content' id='editMonster-content'>";
         $ch->generate_template();
    }
    
    echo "</div>";
    
}
    ?>