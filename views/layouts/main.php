<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel'            => 'eBotEX',
		'brandUrl'              => Yii::$app->homeUrl,
		'options'               => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
		'innerContainerOptions' => ['class' => 'container-fluid'],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items'   => [
			['label' => 'Home', 'url' => ['/main/index']],
			['label' => 'About', 'url' => ['/main/about']],
			['label' => 'Matches', 'url' => ['/matches']],
			['label' => 'Contact', 'url' => ['/main/contact']],
			Yii::$app->user->isGuest? (
			['label' => 'Login', 'url' => ['/main/login']]
			) : (
				'<li>'
				. Html::beginForm(['/main/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>'
			),
		],
	]);
	NavBar::end();
	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<div class="panel panel-default">
					<script>
						function goToMatch() {
							var id = $("#match_id_go").val();
							if (id > 0)
								document.location.href = "<?= Yii::$app->urlManager->createAbsoluteUrl("/matches/view/?id="); ?>" + id;
						}
					</script>
					<?= Nav::widget([
						'options' => ['class' => 'nav nav-pills nav-stacked'],
						'items'   => [
							['label' => 'Home', 'url' => ['/main/index']],
							('
								<li>
									<div class="input-group" style="margin: 5px;">
										<input class="form-control" id="match_id_go" size="16" type="text" placeholder="' . Yii::t('app',"Match id") . '">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button" onclick="goToMatch();">' . Yii::t('app',"Go") . '</button>
										</span>
									</div>
								</li>
							'),
							['label' => 'Matches', 'url' => ['/matches/index']],
							['label' => 'Seasons', 'url' => ['/seasons/index']],
							['label' => 'Statistics', 'url' => ['/stats']],
							['label' => 'Global statistics', 'url' => ['/stats/global']],
							['label' => 'Statistics by map', 'url' => ['/stats/map']],
							['label' => 'Statistics by weapon', 'url' => ['/stats/weapon']],
							['label' => 'Ingame Help', 'url' => ['/main/ingame']],
						],
					]);
					?>
				</div>
			</div>
			<div class="col-md-10">
				<?= Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs'])? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= $content ?>
			</div>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="container-fluid">
		<p class="pull-left"><?= Yii::$app->name ?> WEB panel <?= Yii::$app->version ?> &copy; <a
					href="http://github.com/CodersGit">PolarWolf</a> 2016-<?= date('Y') ?></p>

		<p class="pull-right"><?= Yii::powered() ?> and <a href="http://getbootstrap.com" target="_blank">Bootstrap</a>
		</p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>