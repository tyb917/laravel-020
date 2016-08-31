@extends('backend.layouts.app')

@section('page-title')
    编辑管理员
@stop

@section('content')
{{ Form::model($user, ['route' => ['admin.access.user.update', $user], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-user']) }}
    <div class="portlet">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route('admin.access.user.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check-circle"></i>
                    保存
                </button>
                @if ($user->id>1)
                <button class="btn btn-danger" type="button" href="{{ route('admin.access.user.destroy', $user->id) }}" data-method="delete">
                    <i class="fa fa-trash"></i> 
                    删除
                </button>
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="tabbable-bordered">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_general">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', $user->name, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    角色
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="icheck-inline">
                                                @foreach ($roles as $role)
                                                    <label for="role_{{ $role->id }}">
                                                        <input type="checkbox" name="permissions[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{in_array($role->id, $user_role) ? 'checked' : ""}}>
                                                        {{ $role->display_name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
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
                            </div> --}}
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
        $(function(){
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });

            /**
             * 删除操作
             */
            $('body').on('submit', 'form[name=delete_item]', function(e){
                e.preventDefault();
                var form = this;
                var link = $('[data-method="delete"]');
                var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
                var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
                var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个项目吗？";

                swal({
                    title: title,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: cancel,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: confirm,
                    closeOnConfirm: true
                }, function(confirmed) {
                    if (confirmed)
                        form.submit();
                });
            });
        })
    </script>
@stop