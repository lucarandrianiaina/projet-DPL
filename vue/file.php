<?php
$title_head ='FICHIER DES ACTIVITES';
include_once 'header.php'; 
$chemain = '../uploads/';
$files = scandir($chemain);
?>
<table id="mytable">
      <thead>
            <th>nom du fichier</th>
            <th>Telecharger</th>
      </thead>
      <tbody>
            <?php 
                  foreach($files as $file):
                        if($file !== '.' && $file !== '..'):
            ?>
                  <tr>
                        <td><?=$file?></td>
                        <td><a href="<?=$chemain.$file?>" class="btn btn-sm btn-primary"><i class="fas fa-download"></i></a></td>
                  </tr>
            <?php
                        endif;
                  endforeach;
            ?>
      </tbody>
</table>

<?php
include_once 'footer.php';
?>