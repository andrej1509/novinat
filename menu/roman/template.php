<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (empty($arResult["ALL_ITEMS"]))
	return;

$menuBlockId = "catalog_menu_".$this->randString();
$dir='http://'.$_SERVER['SERVER_NAME'];
// var_dump($arResult);die();
?>

	<ul class="hidden-xs" id="nav">
	<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>     <!-- first level-->
		<?$existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]) ? true : false;?>
		<?$existPictureDescColomn = false;?>
		<?
		$sUrl = strpos($arResult["ALL_ITEMS"][$itemID]['LINK'], 'http') === 0 ? $arResult["ALL_ITEMS"][$itemID]["LINK"] : $dir.$arResult["ALL_ITEMS"][$itemID]["LINK"];
		// var_dump($sUrl);die();
		?>
		<li class="level0 <?if($arResult["ALL_ITEMS"][$itemID]["SELECTED"]):?>current<?endif?><?if (is_array($arColumns) && count($arColumns) > 0):?> drop-menu<?endif?>">
			<?
			$r_color = $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["color"];
			$r_color_darkred="";
			if (!empty($r_color) && $r_color == "darkred") {
				$r_color_darkred = 'class="red"';
			}
			$r_icon = $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["icon"];
			?>
			<a <?if (!empty($r_icon)):?>class="icon"<?endif?> href="<?=$sUrl?>" <?=$r_color_darkred?> <?if (is_array($arColumns) && count($arColumns) > 0 && $existPictureDescColomn):?>onmouseover="obj_<?=$menuBlockId?>.changeSectionPicure(this);"<?endif?>>
				<?if (!empty($r_icon)):?>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/<?= $r_icon?>" alt="" />
				<?endif?>
				<span><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></span>
			</a>
		<?if (is_array($arColumns) && count($arColumns) > 0):?>

				<?foreach($arColumns as $key=>$arRow):?>

					<ul class="level1" style="display: none;">
					<?foreach($arRow as $itemIdLevel_2=>$arLevel_3):?>  <!-- second level-->
					<?
					$sUrl2 = strpos($arItem['LINK'], 'http') === 0 ? $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"] : $dir.$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"];
					?>
					
						<li class="parent">
							<a href="<?=$sUrl2?>" <?if ($existPictureDescColomn):?>ontouchstart="document.location.href = '<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>';"<?endif?> data-picture="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["picture_src"]?>">
								</span><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></span>
							</a>
							<?
							/*
							<span class="bx_children_advanced_panel animate">
								<img src="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["picture_src"]?>" alt="">
							</span>
							*/
							?>
						<?if (is_array($arLevel_3) && count($arLevel_3) > 0):?>
							<ul>
							<?foreach($arLevel_3 as $itemIdLevel_3):?>	<!-- third level-->
								<li>
									<a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>" <?if ($existPictureDescColomn):?>ontouchstart="document.location.href = '<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>';return false;" onmouseover="obj_<?=$menuBlockId?>.changeSectionPicure(this);return false;"<?endif?> data-picture="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["picture_src"]?>">
										</span><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></span>
									</a>
									<span style="display: none">
										<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["description"]?>
									</span>
									<span class="bx_children_advanced_panel animate">
										<img src="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["picture_src"]?>" alt="">
									</span>
								</li>
							<?endforeach;?>
							</ul>
						<?endif?>
						</li>
					<?endforeach;?>
					</ul>

				<?endforeach;?>
				<?if ($existPictureDescColomn):?>
				<div class="bx_children_block advanced">
					<div class="bx_children_advanced_panel">
						<span class="bx_children_advanced_panel animate">
							<a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><span class="bx_section_picture">
								<img src="<?=$arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"]?>"  alt="">
							</span></a>
							<img src="<?=$this->GetFolder()?>/images/spacer.png" alt="" style="border: none;">
							<strong><?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?></strong><span class="bx_section_description bx_item_description"><?=$arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]?></span>
						</span>
					</div>
				</div>
				<?endif?>
				<div style="clear: both;"></div>

		<?endif?>
		</li>
	<?endforeach;?>
	</ul>
	<div style="clear: both;"></div>


<script>
</script>