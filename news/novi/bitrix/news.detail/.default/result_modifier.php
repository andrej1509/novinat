<?
$arResult["DETAIL_PICTURE"]["SMALL"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>150, 'height'=>'112'), BX_RESIZE_IMAGE_EXACT, true);

$arResult["MORE_PHOTO"] = array();
if(isset($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])) {
	foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $FILE) {
		$FILE = CFile::GetFileArray($FILE);
		if(is_array($FILE)){
			$FILE["SMALL"] = CFile::ResizeImageGet($FILE, array('width'=>150, 'height'=>'112'), BX_RESIZE_IMAGE_EXACT, true);
			$arResult["MORE_PHOTO"][]=$FILE;
		}
	}
}
?>