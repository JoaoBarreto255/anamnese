# Anamnese
Site usando Angular, PHP e MySQL para cadastro de anamnese usando o padrão MVC associado a api rest.
index.html(view), controle.js(controle) e a pasta api:

## Disposição dos arquivos da api
api/<br>
 |<br>
 +-config/<br>
 |<br>
 +--------database.php (possui classe com a conexão com o banco de dados mysql usando PDO driver)<br>
 |<br>
 +-objects/ (diretório com os objetos do banco de dados.)<br>
 |<br>
 +---------anamnase.php (Possui classe que contém métodos para ler, apagar atualizar e inserir dados no banco de dados)<br>
 |<br>
 +-anamase/ (diretório possui páginas php que realizam as operações básicas (CRUD) usando o padrão Rest)<br>
 |<br>
 +---------read.php (gera array de JSONs com anamneses ou mensagem de erro para a aplicação.<br>
 |<br>
 +---------create.php (insere nova anamnese na base, com JSON enviado no POST)<br>
 |<br>
 +---------update.php (atualiza registro na base, com JSON enviado no POST)<br>
 |<br>
 +---------delete.php (remove registro na base, com id identico ao do JSON enviado no post)<br>
