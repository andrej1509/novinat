<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;
		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};
		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});
		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}
</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<? if($arResult["DELIVERY"]["simple"]["PROFILES"]["simple"]["CHECKED"]== "Y") {
	$PARAM_DEL = 1;
} elseif ($arResult["DELIVERY"]["ems"]["PROFILES"]["delivery"]["CHECKED"]== "Y") {
	$PARAM_DEL = 2;
} elseif ($arResult["DELIVERY"]["2"]["CHECKED"]== "Y") {
	$PARAM_DEL = 3;
}elseif ($arResult["DELIVERY"]["sdek"]["PROFILES"]["courier"]["CHECKED"]== "Y"){
	$PARAM_DEL = 4;
}
if (count($arResult["DELIVERY"]) == 1) {
	$PARAM_STR = "str_deliv";
}else {
	$PARAM_STR = "";
}
$arResult["DELIVERY"] = array();
?>

<div id="delive_hidden" style="display: none"><? echo $PARAM_DEL?></div>
<div id="offer_price_hidden" style="display: none"><? echo $arResult["ORDER_PRICE"]?></div>
<div id="deliv_str_hidden" style="display: none"><? echo $PARAM_STR?></div>
<div class="bx_section delivery">
    <h4>Выберите способ доставки</h4>
    <ul class="delivery-method">

        <li class="bx_element selectDeliveryWay">
            <label for="ID_DELIVERY_simple_simple">
                <input
                    type="radio"
                    id="ID_DELIVERY_simple_simple"
                    name="DELIVERY_ID"
                    value="simple:simple"
                   onclick="changeForm();"/>
                <div class="bx_logotype">
                    <div class="logotype_border">
                        <strong>
                            Доставка курьером (по Москве и МО)
                        </strong>
                    </div>
                </div>
            </label>
        </li>

        <li class="bx_element selectDeliveryWay active">
            <label for="ID_DELIVERY_ems_delivery">
                <input
                    type="radio"
                    id="ID_DELIVERY_ems_delivery"
                    name="DELIVERY_ID"
                    value="ems:delivery"
					onclick="recAdress();submitForm()"/>
                <div class="bx_logotype">
                    <div class="logotype_border">
                        <strong>
                            EMS (экспресс-доставка)
                        </strong>
                    </div>
                </div>
            </label>
        </li>

        <li class="bx_element selectDeliveryWay">
            <label for="ID_DELIVERY_ID_2">
                <input
                    type="radio"
                    id="ID_DELIVERY_ID_2"
                    name="DELIVERY_ID"
                    value="2"
					onclick="changeForm();"/>
                <div class="bx_logotype">
                    <div class="logotype_border">
                        <strong>
                            Самовывоз
                        </strong>
                    </div>
                </div>
            </label>
        </li>

        <li class="bx_element selectDeliveryWay">
            <label for="ID_DELIVERY_sdek_courier">
                <input
                    type="radio"
                    id="ID_DELIVERY_sdek_courier"
                    name="DELIVERY_ID"
                    value="sdek:courier"
					onclick="recAdress();submitForm()"/>
                <div class="bx_logotype">
                    <div class="logotype_border">
                        <strong>
                            СДЭК (Доставка курьером)
                        </strong>
                    </div>
                </div>
            </label>
        </li>
    </ul>
<div class="clear"></div>
</div>