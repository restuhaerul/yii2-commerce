<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

\yii\web\JqueryAsset::register($this);
\yii\bootstrap5\BootstrapAsset::register($this);
\yii\bootstrap5\BootstrapPluginAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    } else {
        echo Html::beginTag('div', ['class' => 'dropdown d-flex']);

        // Tombol dropdown dengan username
        echo Html::button(
            Yii::$app->user->identity->getDisplayName() . ' <span class="caret"></span>',
            [
                'class' => 'btn btn-link dropdown-toggle text-decoration-none text-white',
                'data-bs-toggle' => 'dropdown', // Diubah untuk Bootstrap 5
                'aria-expanded' => 'false'
            ]
        );

        // Menu dropdown
        echo Html::beginTag('div', ['class' => 'dropdown-menu dropdown-menu-end text-gray']); // Diubah untuk Bootstrap 5
        echo Html::a('Profile', ['/site/profile'], ['class' => 'dropdown-item text-gray']);
        echo Html::a('Logout', ['/site/logout'], [
            'class' => 'dropdown-item',
            'data-method' => 'post'
        ]);
        echo Html::endTag('div');

        echo Html::endTag('div');
}
NavBar::end();
   ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
