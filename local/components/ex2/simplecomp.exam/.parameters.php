<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"IBLOCK_CODE_AUTHORS" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_IBLOCK_CODE_AUTHORS"),
			"TYPE" => "STRING",
		),
		"UF_CODE_AUTHOR_TYPE" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_IBLOCK_CODE_AUTHORS"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME" => ["DEFAULT"=>36000000]
	),
);