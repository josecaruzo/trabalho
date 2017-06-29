var app = angular.module("App", []);

app.controller("AppCtrl", function($scope) {
     
    $scope.pessoa = [
    	{
    		nome: 'José',
    		cpf: '000.000.000-00',
    		idade: '19'
    	},

    	{
    		nome: 'João',
    		cpf: '000.000.000-01',
    		idade: '25'
    	},

    	{
    		nome: 'Irineu',
    		cpf: '000.000.000-02',
    		idade: '30'
    	}
    ];


    $scope.addPessoa = function(){
    	$scope.pessoa.push(
    		{
    		nome: $scope.inputNome,
    		cpf: $scope.inputCpf,
    		idade: $scope.inputIdade
    		}
    	);
 
    	//$window.location.reload();

    }
    
});