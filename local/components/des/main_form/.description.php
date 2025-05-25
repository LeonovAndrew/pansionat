<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Форма для главной",
	"DESCRIPTION" => "",
	"ICON" => "/images/icon.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
  "PATH" => array(
    "ID" => "Desperado Components", // for example "my_project"
    "CHILD" => array(
      "ID" => "DesForm", // for example "my_project:services"
      "NAME" => "Форма для главной",  // for example "Services"
    ),
  ),
	"COMPLEX" => "N",
);

?>