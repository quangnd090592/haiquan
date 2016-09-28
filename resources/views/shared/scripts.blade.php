 <!-- jQuery -->
{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap -->
{!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')!!}
<!-- Custom Theme Scripts -->
{!! Html::script('js/custom.js')!!}

{!! Html::script('bower_components/angular/angular.js')!!}
{!! Html::script('bower_components/angular-resource/angular-resource.js')!!}
{!! Html::script('bower_components/angular-bootstrap/ui-bootstrap.js')!!}
{!! Html::script('bower_components/angular-bootstrap/ui-bootstrap-tpls.js')!!}
{!! Html::script('bower_components/ng-table/dist/ng-table.min.js')!!}
{!!Html::script('bower_components/select2/dist/js/select2.min.js')!!}

{!! Html::script('app/app.js') !!}
{!! Html::script('app/config.js') !!}

@yield('module-scripts')