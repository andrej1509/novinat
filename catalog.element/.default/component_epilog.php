<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

// var_dump(MakeTimeStamp($arResult['TIMESTAMP_X']));
// var_dump($arResult['TIMESTAMP_X']);
// var_dump(strtotime($arResult['TIMESTAMP_X']));
// var_dump(gmdate('D, d M Y H:i:s', MakeTimeStamp($arResult['TIMESTAMP_X'])));
// var_dump($GLOBALS['lastModified']);
// $LM = MakeTimeStamp($arResult['TIMESTAMP_X']);
// global $lastModified;
// global $HerEbu4i;
// global $lastModifiedrr;
// if (!$lastModified) {
// 	$lastModified = $LM;
// }
// else {
// 	$lastModified = max($lastModified, MakeTimeStamp($arResult['TIMESTAMP_X']));
// }
// if ($LM = MakeTimeStamp($arResult['TIMESTAMP_X'])) {
// 	$lastModified = $LM;
// }
// $HerEbu4i = MakeTimeStamp($arResult['TIMESTAMP_X']);
// $lastModified = strtotime($arResult['TIMESTAMP_X']);
// $pizdec = gmdate("D, d M Y H:i:s", $HerEbu4i);
// $utc = "Last-Modified1: ".$pizdec." GMT";
// var_dump($utc);die();
// $utc = "Last-Modified111: "."Fri, 21 Aug 2015 11:4549";
// var_dump($utc);die();
// $utc = gmdate('D, d M Y H:i:s', $lastModified);
// header('Last-Modified111: '.$utc);
// header($utc);
// header("Last-Modified111: ".$lastModified);
// $HerEbu4i = 1440157549;
// var_dump($lastModified);
// var_dump($utc);die();
// $GLOBALS['lastModified'] = $lastModified;
// var_dump($GLOBALS['lastModified']);
	
// $GLOBALS["$lastModified"] = MakeTimeStamp($arResult['TIMESTAMP_X']);
// $lastModified = 1440157549;
// $lastModified = 1440157549;
// $lastModified = $arResult['TIMESTAMP_X'];
// $lastModifiedrr = true;
// $lastModifiedrr = gmdate('D, d M Y H:i:s', $lastModified).' GMT';
// var_dump($lastModifiedrr);
// $lastModifiedrr = 'Thu, 18 Aug 2016 16:08:19 GMT';
// var_dump($lastModifiedrr);die();
// var_dump($lastModified);die();

if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
	?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
<?
	}
}
if (isset($templateData['JS_OBJ']))
{
?><script type="text/javascript">
BX.ready(BX.defer(function(){
	if (!!window.<? echo $templateData['JS_OBJ']; ?>)
	{
		window.<? echo $templateData['JS_OBJ']; ?>.allowViewedCount(true);
	}
}));
</script><?
}
?>