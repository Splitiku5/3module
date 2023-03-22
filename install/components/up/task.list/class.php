<?php

class TasksListComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$this->prepareTemplateParams();
		$this->fetchTasksList();
		$this->includeComponentTemplate();
	}

	public function onPrepareComponentParams($arParams)
	{
		$arParams['DATE_FORMAT'] = $arParams['DATE_FORMAT'] ?? 'd.m.Y';

		return $arParams;
	}

	protected function prepareTemplateParams()
	{
		$this->arResult['DATE_FORMAT'] = $this->arParams['DATE_FORMAT'];
	}

	protected function fetchTasksList()
	{
		Bitrix\Main\Loader::includeModule('up.tasks');

		$result = \Up\Tasks\TasksTable::getList(['select' => ['*']]);
		$tasks = $result->fetchAll();


		$this->arResult['TASKS'] = $tasks;
	}
}