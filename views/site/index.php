<?php
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">

        <h2>World Stat</h2>
		
			<div class="row">
				<?php \yii\widgets\Pjax::begin(['enablePushState' => false]); ?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
					'summary' => '',
					'columns' => [
						'Continent',
						'Region',
						'Countries',
						'LifeDuration',
						'Population',
						'Cities',
						'Languages'
					],
				]); ?>
				<?php \yii\widgets\Pjax::end(); ?>
			</div>
		
        
		<div id="result"></div>
    </div>
</div>
