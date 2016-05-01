<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section">
	<div class="bx_section paysystem">
		<h4><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></h4>
		<ul class="payment-method">
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_10"
                       name="PAY_SYSTEM_ID"
                       value="10"/>
                <label for="ID_PAY_SYSTEM_ID_10">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/119/119cbf6c3934ee33e55b3052746a771b.png);'></span>
                        <strong>Оплата банковской картой</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_13"
                       name="PAY_SYSTEM_ID"
                       value="13"
                    />
                <label for="ID_PAY_SYSTEM_ID_13">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/e41/e411e59821e3f85b940374bab1b5da77.gif);'></span>
                        <strong>Оплата через Яндекс</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_14"
                       name="PAY_SYSTEM_ID"
                       value="14"
                    />
                <label for="ID_PAY_SYSTEM_ID_14">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/b4e/b4ec673e022d2d4d3982ff6eb2d41411.gif);'></span>
                        <strong>Оплата через WebMoney</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_16"
                       name="PAY_SYSTEM_ID"
                       value="16"
                    />
                <label for="ID_PAY_SYSTEM_ID_16">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/ab8/ab83d15a93683fb3ede625ad747beb3c.png);'></span>
                        <strong>Оплата через QIWI</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_1"
                       name="PAY_SYSTEM_ID"
                       value="1"
                    />
                <label for="ID_PAY_SYSTEM_ID_1">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/830/83074a651fd75dd06df08a5ced83bab0.png);'></span>
                        <strong>Наличные курьеру</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
            <li class="bx_element selectPaymentWay">
                <input type="radio"
                       id="ID_PAY_SYSTEM_ID_8"
                       name="PAY_SYSTEM_ID"
                       value="8"
                    />
                <label for="ID_PAY_SYSTEM_ID_8">
                    <div class="bx_logotype">
                        <span style='background-image:url(/upload/sale/paysystem/logotip/1a1/1a10ceb0bf2bc479b76a8a1a289ae504.gif);'></span>
                        <strong>Наличными в кассу</strong>
                    </div>
                </label>
                <div class="clear"></div>
            </li>
		</ul>
		<div class="paymentWay">

		</div>
		<div style="clear: both;"></div>
	</div>
</div>