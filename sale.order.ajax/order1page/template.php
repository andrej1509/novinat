<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			$APPLICATION->RestartBuffer();
			?>
			<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}

	}
}

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
?>

<a name="order_form"></a>

<div class="order_sidebar">
	<div class="menu_left">
		<h4><a href="personal/">Личный кабинет</a></h4>
		<div>
			<a href="order/">Мои заказы</a><br/>
			<a href="/personal/cart/">Корзина</a><br/>

		</div>
		<div>
			<a href="subscribe/">Изменить подписку</a>
		</div>
	</div>
</div>


<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>

<?
if (!function_exists("getColumnName"))
{
	function getColumnName($arHeader)
	{
		return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
	}
}

if (!function_exists("cmpBySort"))
{
	function cmpBySort($array1, $array2)
	{
		if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
			return -1;

		if ($array1["SORT"] > $array2["SORT"])
			return 1;

		if ($array1["SORT"] < $array2["SORT"])
			return -1;

		if ($array1["SORT"] == $array2["SORT"])
			return 0;
	}
}
?>

<div class="bx_order_make">
	<?
	if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if(!empty($arResult["ERROR"]))
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		}
		elseif(!empty($arResult["OK_MESSAGE"]))
		{
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) == 0)
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
			?>
			<script type="text/javascript">

			<?if(CSaleLocation::isLocationProEnabled()):?>

				<?
				// spike: for children of cities we place this prompt
				$city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
				?>

				BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
					'source' => $this->__component->getPath().'/get.php',
					'cityTypeId' => intval($city['ID']),
					'messages' => array(
						'otherLocation' => '--- '.GetMessage('SOA_OTHER_LOCATION'),
						'moreInfoLocation' => '--- '.GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
						'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.GetMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
							'#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
							'#ANCHOR_END#' => '</a>'
						)).'</div>'
					)
				))?>);

			<?endif?>

			var BXFormPosting = false;
			function submitForm(val)
			{
				if (BXFormPosting === true)
					return true;

				BXFormPosting = true;
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');
				BX.showWait();

				<?if(CSaleLocation::isLocationProEnabled()):?>
					BX.saleOrderAjax.cleanUp();
				<?endif?>

				BX.ajax.submit(orderForm, ajaxResult);

				return true;
			}

			function ajaxResult(res)
			{
				var orderForm = BX('ORDER_FORM');
				try
				{
					// if json came, it obviously a successfull order submit

					var json = JSON.parse(res);
					BX.closeWait();

					if (json.error)
					{
						BXFormPosting = false;
						return;
					}
					else if (json.redirect)
					{
						window.top.location.href = json.redirect;
					}
				}
				catch (e)
				{
					// json parse failed, so it is a simple chunk of html

					BXFormPosting = false;
					BX('order_form_content').innerHTML = res;

					<?if(CSaleLocation::isLocationProEnabled()):?>
						BX.saleOrderAjax.initDeferredControl();
					<?endif?>
				}

				BX.closeWait();
				BX.onCustomEvent(orderForm, 'onAjaxSuccess');
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}
			function StepBack()
			{
				BX("step_number").value = parseInt(BX("step_number").value)-1;
				submitForm();
			}
			function StepFwd()
			{
				BX("step_number").value = parseInt(BX("step_number").value)+1;
				submitForm();
			}
			
			</script>
	<script type="text/javascript">
		function changePaySystem(param)
		{
			if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = true;
						BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
						BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

						// deselect all other
						var el = document.getElementsByName("PAY_SYSTEM_ID");
						for(var i=0; i<el.length; i++)
							el[i].checked = false;
					}
				}
				else
				{
					BX("PAY_CURRENT_ACCOUNT").checked = false;
					BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
					BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
				}
			}
			else if (BX("account_only") && BX("account_only").value == 'N')
			{
				if (param == 'account')
				{
					if (BX("PAY_CURRENT_ACCOUNT"))
					{
						BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

						if (BX("PAY_CURRENT_ACCOUNT").checked)
						{
							BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
							BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
						else
						{
							BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
							BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
						}
					}
				}
			}

			submitForm();
		}
	</script>
			<?
			if($_POST["is_ajax_post"] != "Y")
			{
				?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				<div id="order_form_content">
				<?
			}
			else
			{
				$APPLICATION->RestartBuffer();
			}

			if($_REQUEST['PERMANENT_MODE_STEPS'] == 1)
			{
				?>
				<input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
				<?
			}

			if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
			{
				foreach($arResult["ERROR"] as $v)
					echo ShowError($v);
				?>
				<script type="text/javascript">
					top.BX.scrollToNode(top.BX('ORDER_FORM'));
				</script>
				<?
			}
			
			$iStep = $arResult['STEP'];
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
			// include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
			
			?>
			<div class="itog_price">Итоговая стоимость заказа: <?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></div>
			<?

			?><div class="step_counter"><?
			for ($i = 1; $i <= 3; $i++) {
				
				if ($arResult["STEP"] == $i) {
					echo "<b class=\"step active\">".$i."</b>";
				}
				else {
					echo "<b class=\"step\">".$i."</b>";
				}
				if ($i<3) {
					echo "<b class=\"devider\"></b>";
				}
			}
			?></div><?

			if ($arResult['STEP'] == 0) {
				// include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
				// include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
			}
			elseif ($arResult['STEP'] == 1) {
				// var_dump($arResult["ORDER_PROP"]["RELATED"]);die();
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery_new.php");
				// include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
			}
			elseif ($arResult['STEP'] == 2) {
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem_new.php");
				// include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
				
			}elseif ($arResult['STEP'] == 3) {
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
				if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
					echo $arResult["PREPAY_ADIT_FIELDS"];
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/comment.php");
			}
			
			?>
			
			<div class="bx_ordercart_order_pay_center">
				<?
				if ($arResult['STEP'] != 1) {
					?>
					<a href="javascript:void();" onclick="StepBack(); return false;" id="" class="checkout"><?=GetMessage("ROM_PREV_STEP")?></a>
					<?
				}
				if ($arResult['STEP'] != 3) {
					?>
					<a href="javascript:void();" onclick="StepFwd(); return false;" id="" class="checkout"><?=GetMessage("ROM_NEXT_STEP")?></a>
					<?
				} else {
					?>
					<a href="javascript:void();" onclick="submitForm('Y'); return false;" id="ORDER_CONFIRM_BUTTON" class="checkout"><?=GetMessage("SOA_TEMPL_BUTTON")?></a>
					<?
				}
				?>
			</div>
			<?if ($arResult["STEP"] > 1 && $arResult["STEP"] <= 3):?>
				<?
				// var_dump($arResult["USER_VALS"]);
				foreach ($arResult["USER_VALS"]["ORDER_PROP"] as $opa_key => $opa) {
					?><input type="hidden" name="ORDER_PROP_<?= $opa_key ?>" value="<?= $opa ?>"><?
				}
				?>
			<?endif?>
			<?if ($arResult["STEP"] >= 2 && $arResult["STEP"] <= 3):?>
				<input type="hidden" name="DELIVERY_ID" value="<?= $arResult["USER_VALS"]["DELIVERY_ID"] ?>">
			<?endif?>
			<?if ($arResult["STEP"] == 3):?>
				<input type="hidden" name="PAY_SYSTEM_ID" value="<?= $arResult["USER_VALS"]["PAY_SYSTEM_ID"] ?>">
			<?endif?>
			
			<?if($_POST["is_ajax_post"] != "Y")
			{
				?>
					</div>
					<input type="hidden" name="step" id="step_number" value="<?=$iStep?>">
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
					<input type="hidden" name="json" value="Y">
					
				</form>
				<?
				if($arParams["DELIVERY_NO_AJAX"] == "N")
				{
					?>
					<div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
					<?
				}
			}
			else
			{
				?>
				<script type="text/javascript">
					top.BX('confirmorder').value = 'Y';
					top.BX('profile_change').value = 'N';
					top.BX('step_number').value = <?=$iStep?>;
				</script>
				<?
				die();
			}
		}
	}
	?>
	</div>
</div>

<?if(CSaleLocation::isLocationProEnabled()):?>

	<div style="display: none">
		<?// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.steps", 
			".default", 
			array(
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.search", 
			".default", 
			array(
			),
			false
		);?>
	</div>

<?endif?>