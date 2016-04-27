<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
// $this->setFrameMode(true);

// var_dump($arResult["ITEMS"]);die();
if (count($arResult["ITEMS"]) < 1)
	return;
// HEIGHT
?>

<div id="main-slider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?foreach($arResult["ITEMS"] as $key => $arItem):?>
            <li data-target="#main-slider" data-slide-to="<?=$key?>" class="<?if ($key == 0):?>active<?endif?>"></li>
        <?endforeach;?>
    </ol>
 
    <div class="carousel-inner" role="listbox">
        <?foreach($arResult["ITEMS"] as $key => $arItem):?>
        <?
        $linker='#';
            if (!empty($arItem['PROPERTIES']['LINKER']['VALUE'])) {
                $linker = $arItem['PROPERTIES']['LINKER']['VALUE'];
            }
        ?>
            <div class="item lazy-load <?if ($key == 0):?>active<?endif?>">
                <a href="<?=$linker?>">
                    <img
						class="lazyload"
						src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
						data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"
						alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
					>
                    <div class="carousel-caption"></div>
                </a>
            </div>
        <?endforeach;?>
    </div>
 
    <a class="left carousel-control" href="#main-slider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#main-slider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>