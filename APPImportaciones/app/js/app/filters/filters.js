cordovezApp.filter('dateDiff', ['$filter' , function($filter){
	return function(endDate, startDate){
		if(endDate == null || startDate == null){return '';}
			var start = moment(startDatet);
			var end = moment(endDate);
			return end.diff(start, ' dias');
	};
}]);