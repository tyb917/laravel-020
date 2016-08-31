<?php
/**
 * 后台导航
 */
//首页
Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route('admin.dashboard'));
});

/**
 * Access开始
 */
require __DIR__ . '/Breadcrumbs/Backend/Access/Collection.php';