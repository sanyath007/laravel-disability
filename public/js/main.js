/**
 * AngularJS
 */

var env = {};

 // Import variables if present (from env.js)
if(window){  
    Object.assign(env, window.__env);
}

var app = angular.module('app', ['ngAnimate']);

 /** App Config */
app.constant('CONFIG', env);

app.filter('thdate', function($filter)
{
	return function(input)
	{
		if(input == null){ return ""; } 

		var arrDate = input.split('-');
		var thdate = arrDate[2]+ '/' +arrDate[1]+ '/' +(parseInt(arrDate[0])+543);

		return thdate;
	};
});
