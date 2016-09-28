var defaultModules =
[
	'ui.bootstrap',
	'ngResource',
	'ngTable',
	'Home',
	'Assets',
	'Departments',
	'Producers',
];

if(typeof modules != 'undefined'){
	defaultModules = defaultModules.concat(modules);
}
var myApp = angular.module('haiquan', defaultModules);