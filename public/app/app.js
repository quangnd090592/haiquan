var defaultModules =
[
	'ui.bootstrap',
	'ngResource',
	'ngTable',
	'Home'
];

if(typeof modules != 'undefined'){
	defaultModules = defaultModules.concat(modules);
}
var myApp = angular.module('haiquan', defaultModules);