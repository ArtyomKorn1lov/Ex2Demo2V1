<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>

<?php if (!empty($arResult["ITEMS"])) { ?>
<ul>
	<?php foreach ($arResult["ITEMS"] as $user) { ?>
	<li>
		[<?=$user["ID"]?>] - <?=$user["LOGIN"]?>
		<ul>
			<?php foreach ($user["NEWS"] as $new) { ?>
			<li>
				- <?=$new["NAME"]?>
			</li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>
</ul>
<?php } ?>