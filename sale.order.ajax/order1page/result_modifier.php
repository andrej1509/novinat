<?
if( isset( $_REQUEST['step'] ) ) {
    $arResult['STEP'] = $_REQUEST['step'];
}

if( !$arResult['STEP'] || ( $arResult['STEP'] < 0 ) ) {
    $arResult['STEP'] = 1;
}
?>