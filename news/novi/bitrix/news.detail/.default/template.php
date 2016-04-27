<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// print_r("Rom");
// var_dump($arResult);
// die();

?>

<div class="bx_news_detail">
    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
    <h2><?=$arResult["NAME"]?></h2>
    <?endif;?>
    <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
    <div class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div><br>
    <?endif;?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"]["SMALL"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SMALL"]["src"]?>" width="<?=$arResult["DETAIL_PICTURE"]["SMALL"]["width"]?>" height="<?=$arResult["DETAIL_PICTURE"]["SMALL"]["height"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<? 
	// additional photos
	$LINE_ELEMENT_COUNT = 2; // number of elements in a row
	if(count($arResult["MORE_PHOTO"])>0):?>
		<div class="more_photo">
		<?foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
			<? $file = $PHOTO["SMALL"] ?>
				<!-- <a href="<?=$PHOTO["SRC"]?>" name="more_photo"> -->
				<a rel="news_more_photo_group" href="<?=$PHOTO["SRC"]?>" name="more_photo" title="<?=(strlen($arResult["DETAIL_PICTURE"]["DESCRIPTION"]) > 0 ? $arResult["DETAIL_PICTURE"]["DESCRIPTION"] : $arResult["NAME"])?>">
					<img border="0" src="<?=$file["src"]?>" width="<?=$file["width"]?>" height="<?=$file["height"]?>"
					alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				</a>
		<?endforeach?>
		</div>
	<?endif?>
</div>