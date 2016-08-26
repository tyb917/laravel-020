@extends('backend.layouts.app')
@section('page-title')
    角色管理
@stop
@section('content')
{{ Form::model($role, ['route' => ['admin.role.update', $role], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-role']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                编辑角色
            </div>
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route('admin.role.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-secondary-outline">
                    <i class="fa fa-rotate-left"></i>
                    重置
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check"></i>
                    保存
                </button>
                <button class="btn btn-success">
                    <i class="fa fa-check-circle"></i> 
                    保存继续编辑
                </button>
                <button class="btn btn-success">
                    <i class="fa fa-trash"></i> 
                    删除
                </button>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tabbable-bordered">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_general">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', $role->name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                    <span class="help-block"> 只能为小写字母 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    显示名称
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('display_name', $role->display_name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色描述
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('description', $role->description, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    相关权限
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::select('associated-permissions', ['all' => '全部', 'custom' => '自定义'], 'all',['class' => 'form-control', 'id' => 'associated-permissions']) }}
                                    <div id="available-permissions" class="margin-top-20 hidden">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                @if ($permissions->count())
                                                    @foreach ($permissions as $perm)
                                                        <label class="checkbox-inline" for="perm_{{ $perm->id }}">
                                                            <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{in_array($perm->id, $role_permissions) ? 'checked' : ""}}>
                                                            {{ $perm->display_name }}
                                                        </label>
                                                    @endforeach
                                                @else
                                                    <p>有没有可用的权限。</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    排序
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('sort', $role->sort, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop

@section('js')
    <script type="text/javascript">
        var associated = $("select[name='associated-permissions']");
        var associated_container = $("#available-permissions");

        if (associated.val() == "custom")
            associated_container.removeClass('hidden');
        else
            associated_container.addClass('hidden');

        associated.change(function() {
            if ($(this).val() == "custom")
                associated_container.removeClass('hidden');
            else
                associated_container.addClass('hidden');
        });
    </script>
@stop