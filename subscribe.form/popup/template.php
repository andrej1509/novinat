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
?>
<div class="subscribe-form"  id="subscribe-form-popup">
<?
// $frame = $this->createFrame("subscribe-form", false)->begin();
?>
	<h1>
		<p class="text-center">Акции, скидки<br />каждую неделю!</p>
	</h1>
	<h4>Каждую неделю у нас проходят акции, скидки, распродажи, специальные предложения. Хотите получать одежду Натальи Новиковой на очень выгодных условиях?</h4>
	<form action="<?=$arResult["FORM_ACTION"]?>">

	<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
			<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
		</label><br />
	<?endforeach;?>

		<table border="0" cellspacing="0" cellpadding="2" align="center">
			<tr>
				<td><input type="text" name="sf_EMAIL" size="20" placeholder="<?=GetMessage("subscr_form_email_title")?>" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" /></td>
			</tr>
			<tr>
				<td align="right"><input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
			</tr>
		</table>
	</form>
<?
$frame->beginStub();
?>
	<form action="<?=$arResult["FORM_ACTION"]?>">

		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<label for="sf_RUB_ID_<?=$itemValue["ID"]?>">
				<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" /> <?=$itemValue["NAME"]?>
			</label><br />
		<?endforeach;?>

		<table border="0" cellspacing="0" cellpadding="2" align="center">
			<tr>
				<td><input type="text" name="sf_EMAIL" size="20" value="" title="<?=GetMessage("subscr_form_email_title")?>" /></td>
			</tr>
			<tr>
				<td align="right"><input type="submit" name="OK" value="<?=GetMessage("subscr_form_button")?>" /></td>
			</tr>
		</table>
	</form>
<?
// $frame->end();
?>
</div>


<!-- <div class="jumbotron">
  <div class="cont">
    <h1>
      <p class="text-center">Акции, скидки
        <br />
      каждую неделю!</p>
     </h1>

    <div class="form-group">
      <br />

      <div class="row">
        <div class="col-md-8">
          <h4>Каждую неделю у нас проходят акции, скидки, распродажи, специальные предложения. Хотите получать одежду Натальи Новиковой на очень выгодных условиях?</h4>
         </div>

        <div class="col-md-4 pull-center">
          <div class="inp">
            <div class="input-group"> <?=$FORM->ShowFormErrors()?><input type="text" class="inputtext" name="form_email_6" value="" size="0" placeholder="Введите эл. почту" /> </div>
           </div>
         </div>
       </div>
     </div>

    <div class="row">
      <div class="btn-group"> <?=$FORM->ShowSubmitButton("","btn btn-info btn-default btn-lg pull-center")?> </div>
     </div>
   </div>
 </div>
  -->
