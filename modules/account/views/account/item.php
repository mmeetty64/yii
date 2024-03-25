<?php

use app\models\Category;
use app\models\Status;
use yii\bootstrap5\Html;
?>
<div class="card" style="width: 18rem;">
  <?= Html::img('/img/' . $model->image, ['class' => 'card-img-top']) ?>
  <div class="card-body">
    <h5 class="card-title"><?= Html::encode($model->title) ?></h5>
    <p class="card-text"><?= Html::encode($model->description) ?></p>
    <p class="card-text"><?= Html::encode($model->id) ?></p>
    <p class="card-text"><?= Html::encode(date( 'd.m.Y H:i:s', strtotime($model->date))) ?></p>
    <p class="card-text"><?= Html::encode(Status::getStatus()[$model->status_id]) ?></p>
    <p class="card-text"><?= Html::encode(Category::getCategory()[$model->category_id]) ?></p>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= $model->status_id == 1 ? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : '' ?> 
  </div>
</div>