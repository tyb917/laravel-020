<?php

namespace App\Repositories\Backend\Service;

interface ServiceInterface
{
	public function getAllServices($order_by = 'id', $sort = 'asc');

	public function getForDataTable($request);
}