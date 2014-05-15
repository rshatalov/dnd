<div id='tabs'>
<div class="tab" id="tables-tab">Tavoli</div>
<div class="tab" id="monsters-tab">Mostri & PNG</div>
<div style="clear: both"></div>
</div>
<div class='tab-content' id="tables-content">
    <a href='?a=create_table' id='create-table-button'>Crea nuovo tavolo</a>
    
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
    <?php echo $monsters;?>
    <hr/>
   
</div>