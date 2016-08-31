<?php
//管理员
Breadcrumbs::register('admin.access.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('管理员管理', route('admin.access.user.index'));
});
Breadcrumbs::register('admin.access.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.access.user.index');
    $breadcrumbs->push('管理员', route('admin.access.user.create'));
});
Breadcrumbs::register('admin.access.user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.access.user.index');
    $breadcrumbs->push('管理员', route('admin.access.user.edit', $id));
});
//角色
Breadcrumbs::register('admin.access.role.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('管理员管理', route('admin.access.role.index'));
});
Breadcrumbs::register('admin.access.role.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.access.role.index');
    $breadcrumbs->push('角色管理', route('admin.access.role.create'));
});
Breadcrumbs::register('admin.access.role.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.access.role.index');
    $breadcrumbs->push('角色管理', route('admin.access.role.edit', $id));
});
//权限
Breadcrumbs::register('admin.access.permission.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push('管理员管理', route('admin.access.permission.index'));
});
Breadcrumbs::register('admin.access.permission.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.access.permission.index');
    $breadcrumbs->push('权限管理', route('admin.access.permission.create'));
});
Breadcrumbs::register('admin.access.permission.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.access.permission.index');
    $breadcrumbs->push('权限管理', route('admin.access.permission.edit', $id));
});