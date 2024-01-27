<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if (empty($arParams["NEWS_IBLOCK_ID"])) {
	$arParams["NEWS_IBLOCK_ID"] = 1;
}
if (empty($arParams["IBLOCK_CODE_AUTHORS"])) {
	$arParams["IBLOCK_CODE_AUTHORS"] = "AUTHOR";
}
if (empty($arParams["UF_CODE_AUTHOR_TYPE"])) {
	$arParams["UF_CODE_AUTHOR_TYPE"] = "UF_AUTHOR_TYPE";
}

global $USER;
global $APPLICATION;

if ($USER->IsAuthorized()) {
	$count = 0;
	$arButtons = CIBlock::GetPanelButtons($arParams["NEWS_IBLOCK_ID"]);
	$this->AddIncludeAreaIcon(
        [
            "TITLE" => GetMessage("SIMPLECOMP_EXAM2_ADMIN_IB"),
            "URL" => $arButtons['submenu']['element_list']['ACTION_URL'],
            "IN_PARAMS_MENU" => true,
        ]
    );
	if ($this->StartResultCache()) {
		$rsUser = CUser::GetByID($USER->GetID());
		$curUserFields = $rsUser->Fetch();
		$rsUsers = CUser::GetList([], [], ["!ID" => $USER->GetID(), $arParams["UF_CODE_AUTHOR_TYPE"] => $curUserFields[$arParams["UF_CODE_AUTHOR_TYPE"]]], ["SELECT" => [$arParams["UF_CODE_AUTHOR_TYPE"]]]);
		$arUsers = [];
		$arUserIds = [];
		while ($item = $rsUsers->Fetch()) {
			$arUsers[] = ["ID" => $item["ID"], "LOGIN" => $item["LOGIN"]];
			$arUserIds[] = $item["ID"];
		}
		if (!empty($arUserIds)) {
			$rsElements = CIBlockElement::GetList([], ["!PROPERTY_".$arParams["IBLOCK_CODE_AUTHORS"] => $USER->GetID(), "PROPERTY_".$arParams["IBLOCK_CODE_AUTHORS"] => $arUserIds, "IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"]], false, false, ["ID", "NAME", "IBLOCK_ID", "ACTIVE_FROM"]);
			while ($obElement = $rsElements->GetNextElement()) {
				$item = $obElement->GetFields();
				$props = $obElement->GetProperty("AUTHOR");
				unset($item["ID"]);
				foreach ($arUsers as $key => $user) {
					if (in_array($arUsers[$key]["ID"], $props["VALUE"])) {
						$arUsers[$key]["NEWS"][] = $item;
					}
				}
				$count++;
			}
			$arResult["ITEMS"] = $arUsers;
			$arResult["COUNT"] = $count;
			$this->SetResultCacheKeys("COUNT");
			$this->includeComponentTemplate();
		}
	}
	$APPLICATION->SetTitle("Новостей " . $arResult["COUNT"]);
}