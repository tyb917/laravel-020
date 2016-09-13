<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'O2Ousername管理中心')</title>
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'O2Ousername管理中心')">
    <meta name="author" content="@yield('meta_author', 'btan')">
    @yield('meta')

    <link rel="shortcut icon" href="favicon.ico"/>
    <!-- Styles -->
    @yield('before-styles-end')
    {!! Html::style(elixir('css/backend/default.css'),['id'=>'style_color']) !!}
    {!! Html::style(elixir('css/backend/components.css'),['id'=>'style_components']) !!}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/login.css') }}">
    @yield('after-styles-end')
    @yield('css')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class=" login">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('images/logo-big.png') }}" alt=""> 
        </a>
    </div>
    <div class="content">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <h3>注册</h3>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label visible-ie8 visible-ie9">用户名</label>

                <div class="input-icon">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label visible-ie8 visible-ie9">邮箱</label>

                <div class="input-icon">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                <label for="mobile" class="control-label visible-ie8 visible-ie9">手机</label>

                <div class="input-icon">
                    <input id="mobile" type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}">
                    
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {!! Geetest::render() !!}
            </div>

            <div class="form-group{{ $errors->has('verifyCode') ? ' has-error' : '' }}">
                <label for="verifyCode" class="control-label visible-ie8 visible-ie9">手机验证码</label>

                <div class="input-icon">
                    <input id="verifyCode" type="text" class="form-control" name="verifyCode">
                    <span class="help-block">
                        <a href="javascript:;" class="js-send">点击发送验证码</a>
                    </span>

                    @if ($errors->has('verifyCode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('verifyCode') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label visible-ie8 visible-ie9">密码</label>

                <div class="input-icon">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="control-label visible-ie8 visible-ie9">确认地址</label>

                <div class="input-icon">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="input-icon col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        注册
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScripts -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script><script src="{{ asset('js/laravel-sms.js') }}"></script>
    <script>
        var captchaPass = false;
        $('.js-send').sms({
            //laravel csrf token
            token       : "{{csrf_token()}}",
            //请求间隔时间
            interval    : 60,
            //请求参数
            requestData : {
                //手机号
                mobile : function () {
                    return $('input[name=mobile]').val();
                },
                //手机号的检测规则
                mobile_rule : 'check_mobile_unique'
            }
        });
    </script>
</body>
</html>
