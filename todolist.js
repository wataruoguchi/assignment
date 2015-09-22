var todoListModule = angular.module("todoApp", ['ngResource']);
todoListModule.value("Tasks", []);

todoListModule.controller("ShowTaskController", function($rootScope, $scope, $resource, Tasks) {
	$scope.tasks = Tasks;
	$scope.isEdit = false;
	$scope.selectedIndex = 0;
	$scope.selectedTask;

	// $scope.dataResource = function(task) {
	// 	console.log(task.id);
	// 	return $resource('./tasks.php', {
	// 		id:task.id,
	// 		name:task.name,
	// 		notes:task.notes,
	// 		created:task.created,
	// 		modified:task.modified
	// 	}, {
	// 		update: {method:'PUT'},
	// 		delete: {method:'DELETE'}
	// 	});
	// };

	//GET
	var taskRes = $resource('./tasks.php');
	Tasks.push(taskRes);
	debugger;

	$scope.editTask = function($index) {
		$scope.isEdit = true;
		$scope.selectedIndex = $index;
		$scope.selectedTask = angular.copy($scope.tasks[$scope.selectedIndex]);
	}

  $scope.deleteTask = function($index) {
		Tasks[$index].active = false;
		//Database
		var data = $scope.dataResource(Tasks[$index]);
		data.delete();
	}

	$scope.addNew = function() {
		$scope.isEdit = false;
	}
});

todoListModule.controller("AddTaskController", function($scope, $resource, Tasks){
	$scope.addTask = function() {
    $scope.created = new Date();
		var task = {name: $scope.name, notes: $scope.notes, created: $scope.created, active: true};
		Tasks.push(task);

		//Database
		var taskRes = $resource('./tasks.php');
		taskRes.save(task);

		$scope.name = '';
    $scope.notes = '';
	};
});

todoListModule.controller("UpdateTaskController", function($scope, $resource, Tasks){
	$scope.updateTask = function() {
    $scope.selectedTask.modified = new Date();
		$scope.tasks[$scope.selectedIndex] = angular.copy($scope.selectedTask);
		$scope.selectedTask.name = '';
    $scope.selectedTask.notes = '';

		//Database
		//Database
		var data = dataResource(Tasks[$index]);
		data.update();
	};
});

todoListModule.directive('ngConfirmClick', [
  function() {
    return {
      link: function(scope, element, attr) {
        var msg = attr.ngConfirmClick;
        var clickAction = attr.confirmedClick;
        element.bind('click', function(event) {
          if (!window.confirm(msg)) {
						event.stopImmediatePropagation();
 					 	event.preventDefault();
          }
        });
      }
    };
  }
]);
