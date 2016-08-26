<?php

namespace App\Repositories\Backend\Service;

use App\Models\Backend\Services;
use App\Repositories\Backend\Service\ServiceInterface;

class ServiceRepository implements ServiceInterface
{
	/**
	 * [获取所有服务]
	 * @Ben
	 * @DateTime 2016-08-18T11:21:55+0800
	 * @param    string                   $order_by [排序]
	 * @param    string                   $sort     [升序或降序]
	 * @return   [type]                             [数据]
	 */
	public function getAllServices($order_by = 'id', $sort = 'asc')
    {
        return Services::orderBy($order_by, $sort)
            ->get();
    }

    public function getForDataTable($request)
    {

    	if ($request->has('id')) {
            $query->where('id', '=', $request->get('id'));
        }

        if ($request->has('name')) {
            $query->where('name', 'like', "%{$request->get('name')}%");
        }

        if($request->has('usort_from') && !$request->has('usort_to')){
            $query->where('usort','>=',"{$request->get('usort_from')}");
        }

        if(!$request->has('usort_from') && $request->has('usort_to')){
            $query->where('usort','<=',"{$request->get('usort_to')}");
        }
        
        if($request->has('usort_from') && $request->has('usort_to')){
            $query->whereBetween('usort',["{$request->get('usort_from')}","{$request->get('usort_to')}"]);
        }

        if($request->has('created_from') && !$request->has('created_to')){
            $query->where('created_at','>=',"{$request->get('created_from')}");
        }

        if(!$request->has('created_from') && $request->has('created_to')){
            $query->where('created_at','<=',"{$request->get('created_to')}");
        }

        if($request->has('created_from') && $request->has('created_to')){
            $query->whereBetween('created_at',["{$request->get('created_from')}","{$request->get('created_to')}"]);
        }

        if (isset($query)) {
	        return Services::select('id', 'name', 'imgurl', 'usort' ,'created_at')
	        	->query($query)
	            ->get();
        }

        return Services::select('id', 'name', 'imgurl', 'usort' ,'created_at')
        	->orderBy('id','asc')
            ->get();
    }
}