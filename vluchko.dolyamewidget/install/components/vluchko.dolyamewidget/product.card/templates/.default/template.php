<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$this->addExternalJs($templateFolder . '/vendor/tingle/tingle.min.js');
$this->addExternalCss($templateFolder . '/vendor/tingle/tingle.min.css');
?>

<div class="dolyame-widget js-dolyame-widget-popup-button">
    <div class="dolyame-widget__container">

        <img class="dolyame-widget__icon" src="<?=$templateFolder . '/images/logo.svg'?>">

        <div class="dolyame-widget__text">
            4 платежа по <?=$arResult['PRICE']?> ₽
        </div>
    </div>
</div>
<div class="js-dolyame-widget-content" style="display: none">
    <div class="dolyame-widget__popup">
        <div class="dolyame-widget__popup-close js-dolyame-widget-popup-close"></div>
        <img class="dolyame-widget__icon dolyame-widget__icon--popup" src="<?=$templateFolder . '/images/logo-white.svg'?>">
        <div class="dolyame-widget__popup-header">
            Оплатите с Долями <br>
            только 25% стоимости покупки
        </div>
        <div class="dolyame-widget__popup-body">
            Оставшиеся три платежа спишутся автоматически с шагом в две недели
            <img class="dolyame-widget__image" src="<?=$templateFolder . '/images/image.svg'?>">
            <img class="dolyame-widget__image dolyame-widget__image--mobile" src="<?=$templateFolder . '/images/image-mobile.svg'?>">
        </div>
        <div class="dolyame-widget__popup-footer">
            Подробную информацию о работе сервиса можно посмотреть на сайте <a href="https://dolyame.ru/" target="_blank">dolyame.ru</a>
        </div>
    </div>
</div>
