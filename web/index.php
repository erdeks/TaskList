<?php
/*
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

$app->get('/cowsay', function() use($app) {
  $app['monolog']->addDebug('cowsay');
  return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});
$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return str_repeat('Hello', getenv('TIMES'));
});

$app->run();
*/
  try {
       $hostname = "ec2-54-83-19-244.compute-1.amazonaws.com";
       $dbname = "dabupu3k2ssbpf";
       $username = "mdzqcusnhqhhmm";
       $pw = "dbb42c0d15296e4827cb89d386f4bc6434d4e9c519927fc1b3edf1c013f99a2d";
       $pdo = new PDO ("mysql:host=$hostname;dbname='$dbname','$username','$pw'");
  }catch (PDOException $e){
       echo "Failed to get DB handle: ".$e->getMessage()."\n";
       exit;
  }
  $sql = "CREATE TABLE IF NOT EXISTS tasks(
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(40),
    done int(1),
    primary key (id))";
  $query = $pdo -> prepare($sql);
  $query -> execute();
?>
<form action="index.php" method="post">
  <input type="text" name="tarea" placeholder="Escribe tu tarea aqui">
  <input type="submit" value="Crear">
</form>
<?php
  if ( isset( $_POST['tarea'] ) && $_POST['tarea'] !== "" ) {
      $task = $_POST['tarea'];
      $query = $pdo->prepare("INSERT INTO tasks (nombre, done) VALUES('$task', 0)");
      $query->execute();

      $sql="Select * from tasks";
      $query = $pdo -> prepare($sql);
      $query -> execute();
      while( $tareas = $query->fetch()){
     			echo "\t<tr>\n";
     			echo "\t\t<td>".$tareas["id"]."</td>\n";
     			echo "\t\t<td>".$tareas['nombre']."</td>\n";
     			echo "\t</tr>\n";
     		}
    }
?>
