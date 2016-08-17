<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\helpers\DLHelper;

/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'simplex';
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= 'Digital Library - ' . Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            padding-top: 70px;
            padding-bottom: 30px;
            background-color: beige;
        }

        .navbar-brand {
            padding: 0px 15px;
        }

        .container {
            width: 90%;
            padding-left: 10px;
        }
    </style>

</head>
<body>
    <?php $this->beginBody() ?>

    <div>
        <?php
            NavBar::begin([
                'brandLabel' => '<img style="float:left" width="36px" height="36px" alt="Library" src="' . Yii::$app->request->baseUrl .'/images/library-icon.png" />Digital Library',
                'brandUrl' => Yii::$app->request->baseUrl . '/book',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
//                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest)
            {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            }
            else
            {
/*        		$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
                $permissions = array();
                //Get a colln of all permissions for the logged in user
                foreach($roles as $role)
                {
                    $roleName = $role->name;
                    $perforRole = DLHelper::getPermissionsArray($roleName);
                    $permissions = array_merge($permissions, $perforRole);
                }
*/
				$permissions = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
                asort($permissions);
                foreach($permissions as $value)
                {
                    $menuItems[] = [
                        'label' => $value->name,
                        'url' => ['/' . (!strcasecmp($value->name, 'AdminUsers') ? 'admin-user' :  Inflector::singularize(lcfirst($value->name)))],
                    ];
                }

            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItems,
            ]);
            if (!Yii::$app->user->isGuest)
            {
                $menuItems_1[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];

	            echo Nav::widget([
	                'options' => ['class' => 'navbar-nav navbar-right'],
	                'items' => $menuItems_1,
	            ]);

			}

            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="navbar navbar-inverse navbar-fixed-bottom responsive block-center">
        <p class="pull-left" style="color:white">Developed by Krish Chandra </p>
        <p class="pull-right" style="color:white"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
