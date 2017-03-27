<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Alumnos</h1>


<table class="table table-bordered">


 <?php foreach($emplea as $rows): ?>

 <tr>


         <td><?= var_dump($rows) ?></td>

 <td><?= $rows->PRIVILEGIO ?></td>
 </tr>


    <?php endforeach; ?>
</table>
