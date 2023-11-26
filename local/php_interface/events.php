<?php

AddEventHandler("main", "OnBuildGlobalMenu", "onBuildGlobalMenuHandler");

function onBuildGlobalMenuHandler(&$aGlobalMenu, &$aModuleMenu) {
	$contentEditorGroupId = 5;
	global $USER;
	if (!$USER->IsAdmin() && in_array($contentEditorGroupId, $USER->GetUserGroupArray())) {
		$aModuleMenuNew = [];
		unset($aGlobalMenu["global_menu_desktop"]);
		foreach ($aModuleMenu as $key => $item) {
			if ($aModuleMenu[$key]['items_id'] !== 'menu_iblock_/news') {
                unset($aModuleMenu[$key]);
            }
        }
	}
}