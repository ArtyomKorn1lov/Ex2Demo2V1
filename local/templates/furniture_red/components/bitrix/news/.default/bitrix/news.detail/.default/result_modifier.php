<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use CIBlockElement;

if ($arParams["CANONICAL_IBLOCK_ID"]) {
	$obj = CIBlockElement::GetList([], ["IBLOCK_ID" => $arParams["CANONICAL_IBLOCK_ID"], "PROPERTY_NEW" => $arResult["ID"]], false, false, ["NAME"]);
	if ($item = $obj->Fetch()) {
		$arResult["CANONICAL_LINK"] = $item["NAME"];
		$this->__component->SetResultCacheKeys(["CANONICAL_LINK"]);
	}
}