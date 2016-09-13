var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 | Metronic 模板gulp 失败注意使用  cd node_modules/gulp-sass/ 然后 npm install node-sass@3.3.2版本
 */

elixir(function(mix) {
	mix
    .webpack('app.js')
    /**
     * 从 node_modules目录复制到公共目录
     */
    .copy([
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'node_modules/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'node_modules/bootstrap-switch/dist/js/bootstrap-switch.min.js',
        'node_modules/select2/dist/js/select2.min.js',
        'node_modules/js-cookie/src/js.cookie.js',
        'node_modules/bootstrap-daterangepicker/moment.min.js',
        'node_modules/bootstrap-daterangepicker/daterangepicker.js',
        'node_modules/datatables/media/js/jquery.dataTables.min.js',
        'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'node_modules/sweetalert/dist/dist/sweetalert.min.js',
        'node_modules/icheck/icheck.min.js',
    ],'resources/assets/js/vendor')
    /**
     * 前台样式
     */
	.sass([
		'frontend/app.scss'
	],'resources/assets/css/frontend/default.css')
    .styles([
        'frontend/default.css',
    ], 'public/css/frontend/default.css')
    /**
     * js插件样式
     * 后台合并所有插件样式
     */
    .less(
        'app.less',
        'resources/assets/css/backend/app.css'
    )
    .styles([
        'backend/app.css',
        'vendor/jquery.dataTables.min.css',
        'vendor/dataTables.bootstrap.css'
    ], 'resources/assets/css/backend/plugin.css')
    /**
     * 后台样式
     * 模板样式（没有圆角）
     */
    .sass([
        'backend/global/components.scss',
    ], 'resources/assets/css/backend/components.css')
    .styles([
        'resources/assets/css/backend/components.css'
    ],'public/css/backend/components.css')
    /**
     * 模板样式（没有圆角有阴影）
     */
    .sass([
        'backend/global/components-md.scss',
    ], 'resources/assets/css/backend/components-md.css')
    .styles([
        'resources/assets/css/backend/components-md.css'
    ], 'public/css/backend/components-md.css')
    /**
     * 模板样式（有圆角）
     */
    .sass([
        'backend/global/components-rounded.scss',
    ], 'resources/assets/css/backend/components-rounded.css')
    .styles([
        'resources/assets/css/backend/components-rounded.css'
    ], 'public/css/backend/components-rounded.css')
    /**
     * 默认模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/default.scss',
    ], 'resources/assets/css/backend/default.css')
    .styles([
        'backend/plugin.css',
        'backend/default.css',
    ], 'public/css/backend/default.css')
    /**
     * blue模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/blue.scss',
    ], 'resources/assets/css/backend/blue.css')
    .styles([
        'backend/plugin.css',
        'backend/blue.css',
    ], 'public/css/backend/blue.css')
    /**
     * darkblue模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/darkblue.scss',
    ], 'resources/assets/css/backend/darkblue.css')
    .styles([
        'backend/plugin.css',
        'backend/darkblue.css',
    ], 'public/css/backend/darkblue.css')
    /**
     * grey模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/grey.scss',
    ], 'resources/assets/css/backend/grey.css')
    .styles([
        'backend/plugin.css',
        'backend/grey.css',
    ], 'public/css/backend/grey.css')
    /**
     * light模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/light.scss',
    ], 'resources/assets/css/backend/light.css')

    .styles([
        'backend/plugin.css',
        'backend/light.css',
    ], 'public/css/backend/light.css')
    /**
     * light2模板
     */
    .sass([
        'backend/app.scss',
        'backend/global/plugins.scss',
        'backend/global/components.scss',
        'backend/admin/layout/layout.scss',
        'backend/admin/layout/themes/light2.scss',
    ], 'resources/assets/css/backend/light2.css')

    .sass([
        'backend/pages/login.scss'
    ], 'public/css/backend/login.css')

    .styles([
        'backend/plugin.css',
        'backend/light2.css',
    ], 'public/css/backend/light2.css')

    /**
     * 后台JS
     * 合并JS
     */
    .scripts([
        'vendor/bootstrap.min.js',
        'vendor/bootstrap-switch.min.js',
        'vendor/bootstrap-hover-dropdown.min.js',
        'vendor/jquery.slimscroll.min.js',
        'vendor/jquery.blockUI.js',
        'vendor/js.cookie.js',
        'vendor/moment.min.js',
        'vendor/daterangepicker.js',
        'vendor/jquery.dataTables.min.js',
        'vendor/dataTables.bootstrap.js',
        'vendor/bootstrap-datepicker.min.js',
        'vendor/select2.min.js',
        'vendor/sweetalert.min.js',
        'vendor/icheck.min.js',
        'theme.js',
        'layout.js',
        'datatable.js',
        'quick-sidebar.js',
        'customer.js',
        /**
         * JS插件语言包
         */
        'language/*.js'
    ], 'public/js/backend.js')

     /**
	 * 版本控制
	 */
    .version([
    	"public/css/backend/*.css",
        "public/js/backend.js"
    ]);

});
