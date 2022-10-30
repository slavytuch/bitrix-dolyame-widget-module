<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

?>

<div class="dolyame-payment-description">
    <div class="dolyame-payment-description__container">
        <div class="dolyame-payment-description__prices">
            <?foreach ($arResult['PRICE_PARTS'] as $pricePart):?>
            <div class="dolyame-payment-description__part js-dolyame-order-payment-part">
                <?=$pricePart?> ₽
            </div>
            <?endforeach;?>
        </div>
        <img class="dolyame-payment-description__image"
             src="<?= $templateFolder ?>/images/dolyame.svg">
    </div>
    <div class="dolyame-payment-description__container dolyame-payment-description__container--mobile">
        <div class="dolyame-payment-description__prices">
            <?foreach ($arResult['PRICE_PARTS'] as $pricePart):?>
                <div class="dolyame-payment-description__part js-dolyame-order-payment-part">
                    <?=$pricePart?> ₽
                </div>
            <?endforeach;?>
        </div>
        <img class="dolyame-payment-description__image"
             src="<?= $templateFolder ?>/images/dolyame-mobile.svg">
    </div>
</div>