var defaultModules =
[
	'ui.bootstrap',
	'ngResource',
	'ngTable',
	'Home',
	'Assets',
	'Departments',
];

if(typeof modules != 'undefined'){
	defaultModules = defaultModules.concat(modules);
}
var myApp = angular.module('haiquan', defaultModules);