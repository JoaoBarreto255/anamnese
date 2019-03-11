

var app = angular.module("AnamnApp", ["ngRoute"]);
console.log("module AnamnApp done");

app.controller("myControl", function($scope, $http, $route, $timeout){
  console.log("comeco do controller");
  let headers = new Headers();
  headers.append('Content-Type','application/json');
  console.log("headers feitas");
  $scope.swTable=true;
  $scope.swVis=false;

  console.log("initializer vars");
  $scope.myform = {id:null, anamnese:null, resposta:null};
  $scope.myurl = "api/anamnese/create.php";
  $scope.resp = {array:null, cod:0, msg:null};
  $scope.btnLabel = "Criar";

  $scope.updatePage = function(){
    $scope.swTable = true;
    $scope.swVis = false;
    console.log("comeco de updatePage");
    console.log("comeco da comunicação com api/anamnese/read.php");
    $http.get("api/anamnese/read.php")
    .then(
      function(response){
        console.log("response bem sucedida.")
        $scope.resp.cod = 0;
        $scope.resp.array = response.data;
      },
      function(response){
        console.log("response com erro");
        $scope.resp.cod = response.status;
        $scope.resp.msg = response.data.mensagem;
      }
    );
    console.log("fim updatePage");
  }

  $scope.cadastrarMudarRemoverAnamn = function(){
    console.log("comeco da funcao cadastrar ou Mudar ou Remover Anamnese");
    var form = JSON.stringify($scope.myform);
    console.log("form result: "+form);
    console.log("url: "+$scope.myurl);
    $http.post($scope.myurl, form, {headers:headers})
    .then(
      function(response){
        console.log("comeco da response");
        $scope.resp.cod = response.status;
        $scope.resp.msg = response.data.mensagem;
        console.log("fim da response");
      }, function(response){
        console.log("comeco da response com erro!");
        $scope.resp.cod = response.status;
        $scope.resp.msg = response.data.mensagem;
        console.log("Fim da response com erro!");
        console.log("mensagem: "+$scope.resp.msg);
      }
    );
    console.log("setando variáveis ao valor original");
    $scope.myurl = "api/anamnese/create.php";
    $scope.myform ={id:null, anamnese:null,resposta:null};
    $scope.btnLabel = "Criar";
    console.log("fim da função cadastrar ou mudar ou Remover");
  };

  $scope.atualizar = function(){
    console.log("comeco função atualizar.");
    $scope.cadastrarMudarRemoverAnamn();
    console.log("fim da função atualizar");
  };

  $scope.atualizarAnamn = function(anamn){
    $scope.swTable = false;
    $scope.swVis = false;
    $scope.myform = anamn;
    $scope.myurl = "api/anamnese/update.php";
    $scope.btnLabel = "Atualizar";
  };

  $scope.deleteAnamn = function(anamn){
    $scope.myform=anamn;
    let idx = $scope.resp.array.indexOf(anamn);
    $scope.resp.array.splice(idx,1);
    $scope.myurl="api/anamnese/delete.php";
    $scope.cadastrarMudarRemoverAnamn();
  };

  $scope.visualizar = function(anamn){
    $scope.swTable = false;
    $scope.swVis = true;
    $scope.myform = anamn;
  };

  $scope.criar = function(){
    $scope.swTable = false;
  };

  $scope.checkCod = function(){
    return $scope.resp.cod === 200 || $scope.resp.cod === 201;
  };

  $scope.updatePage();

});
  