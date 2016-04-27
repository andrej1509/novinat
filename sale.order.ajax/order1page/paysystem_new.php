<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section">
	<div class="bx_section paysystem">
		<h4><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></h4>
		<ul class="payment-method">
		<?
		uasort($arResult["PAY_SYSTEM"], "cmpBySort"); // resort arrays according to SORT value

		foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
		{
			if (count($arResult["PAY_SYSTEM"]) == 1)
			{
				?>
				<li class="bx_element selectPaymentWay">
					<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
					<input type="radio"
						id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
						name="PAY_SYSTEM_ID"
						value="<?=$arPaySystem["ID"]?>"
						<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
						onclick="changePaySystem();"
						/>
					<label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
						<?
						if (count($arPaySystem["PSA_LOGOTIP"]) > 0):
							$imgUrl = $arPaySystem["PSA_LOGOTIP"]["SRC"];
						else:
							$imgUrl = $templateFolder."/images/logo-default-ps.gif";
						endif;
						?>
						<div class="bx_logotype">
							<span style="background-image:url(<?=$imgUrl?>);"></span>
							<?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
								<strong><?=$arPaySystem["PSA_NAME"];?></strong>
							<?endif;?>
						</div>
					</label>
					<div class="clear"></div>
				</li>
				<?
			}
			else // more than one
			{
			?>
				<li class="bx_element selectPaymentWay">
					<input type="radio"
						id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
						name="PAY_SYSTEM_ID"
						value="<?=$arPaySystem["ID"]?>"
						<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
						onclick="changePaySystem();" />
					<label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
						<?
						if (count($arPaySystem["PSA_LOGOTIP"]) > 0):
							$imgUrl = $arPaySystem["PSA_LOGOTIP"]["SRC"];
						else:
							$imgUrl = $templateFolder."/images/logo-default-ps.gif";
						endif;
						?>
						<div class="bx_logotype">
							<span style='background-image:url(<?=$imgUrl?>);'></span>
							<?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
								<strong><?=$arPaySystem["PSA_NAME"];?></strong>
							<?endif;?>
						</div>
					</label>
					<div class="clear"></div>
				</li>
			<?
			}
		}
		//Description
		?>
		</ul>
		<div class="paymentWay">
		<?
		foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
		{
			if (count($arResult["PAY_SYSTEM"]) == 1)
			{
				?>
						<div class="bx_description <?if (
															$arPaySystem["CHECKED"]=="N" && 
															($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")
														) echo "hidden";?>">
							<p>
								<?
								if (intval($arPaySystem["PRICE"]) > 0)
									echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
								else
									echo $arPaySystem["DESCRIPTION"];
								?>
							</p>
						</div>
				<?
			}
			else // more than one
			{
			?>

						<div class="bx_description <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo ""; else echo "hidden";?>">
							<p>
								<?
								if (intval($arPaySystem["PRICE"]) > 0)
									echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
								else
									echo $arPaySystem["DESCRIPTION"];
								?>
							</p>
						</div>
			<?
			}
		}
		?>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>