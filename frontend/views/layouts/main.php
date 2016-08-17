<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);
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
    <title><?= Html::encode('Digital Library - ' . $this->title) ?></title>
    
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
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img style="float:left" width="36px" height="36px"  alt="Library" src="' . Yii::$app->request->baseUrl .'/images/library-icon.png" />Digital Library',
                'brandUrl' => Yii::$app->request->baseUrl . '/library',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'View Cart', 'url' => ['/library/view-cart']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
            if (Yii::$app->session->hasFlash('msg_error'))
            {
                // Alert::begin([
                //     'options' => [
                //         'class' => 'alert alert-warning',
                //     ],
                // ]);

                echo '<div class="alert alert-warning">'.Yii::$app->session->getFlash('msg_error')."</div>";
                // Alert::end();                
            }
            else if (Yii::$app->session->hasFlash('message'))
            {
                // Alert::begin([
                //     'options' => [
                //         'class' => 'alert-success',
                //     ],
                // ]);

                echo '<div class="alert alert-success">'.Yii::$app->session->getFlash('message')."</div>";

                // Alert::end();                
            }

        ?> 
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="navbar navbar-inverse navbar-fixed-bottom responsive block-center">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
