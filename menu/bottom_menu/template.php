<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (empty($arResult)){
	return;
}
$dir='http://'.$_SERVER['SERVER_NAME'];
?>

<ul>
	<?foreach($arResult as $itemIdex => $arItem):?>
		<?if ($arItem["DEPTH_LEVEL"] == "1"):?>
			<?
			$sUrl = strpos($arItem['LINK'], 'http') === 0 ? $arItem['LINK'] : $dir.$arItem['LINK'];
			?>
			<?
			$target_link = '';
			$r_target = $arItem["PARAMS"]["target"];
			if ($r_target == "blank") {
				$target_link = 'target="_blank"';
			}
			?>
			<li><a <?=$target_link?> href="<?=$sUrl?>"><?=htmlspecialcharsbx($arItem["TEXT"])?></a></li>
		<?endif?>
	<?endforeach;?>
</ul>