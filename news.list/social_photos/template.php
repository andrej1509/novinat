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
$this->setFrameMode(true);
?>
<div class="soc-pics-slider owl-carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	// var_dump($arItem);
	$cachedFile = CFile::ResizeImageGet($arItem[DETAIL_PICTURE][ID], array('width'=>230, 'height'=>310), BX_RESIZE_IMAGE_EXACT, true);
	if ($cachedFile) {
		$cachedFile[SRC] = $cachedFile[src];
		unset($cachedFile[src]);
		$arOneRow[PREVIEW_PICTURE] = $cachedFile;
	}
	//else $arOneRow[PREVIEW_PICTURE] = $arOffer[PREVIEW_PICTURE];
	// unset($cachedFile);
	// var_dump($cachedFile);
	?>
	<div class="soc-pic-item owl-item1">
		<a rel="soc-pic-item-list" href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
			<img
				class="preview_picture lazyOwl"
				border="0"
				data-src="<?='http://novi-natali.ru'.$cachedFile["SRC"]?>"
				width="<?=$cachedFile["WIDTH"]?>"
				height="<?=$cachedFile["HEIGHT"]?>"
				alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
				title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"
			/>
		</a>
	</div>
<?endforeach;?>
</div>
