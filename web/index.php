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
       $pdo = new PDO ("pgsql:host=$hostname;dbname=$dbname","$username","$pw");
  }catch (PDOException $e){
       echo "Failed to get DB handle: ".$e->getMessage()."\n";
       exit;
  }
?>
<form action="index.php" method="post">
  <input type="text" name="tarea" placeholder="Escribe tu tarea aqui">
  <input type="submit" value="Crear">
</form>
<table>
<thead><td colspan='2'>Para Hacer</td></thead>;
<?php
  if ( isset( $_POST['tarea'] ) && $_POST['tarea'] !== "" ) {
      $task = $_POST['tarea'];
      $query = $pdo->prepare("INSERT INTO tasks (nombre, done) VALUES('$task', 0)");
      $query->execute();

    }
    $sql="Select * from tasks";
    $query = $pdo -> prepare($sql);
    $query -> execute();
    while( $tareas = $query->fetch()){
      $id=$tareas['id'];
      if($tareas['done']==0){

        echo "<tr>";
        echo "<td>".$tareas["id"]."</td>";
        echo "<td>".$tareas['nombre']."</td>";
        echo "<td><a href='do.php?id=$id'>Hacer</a></td>";
        echo "<td><a href='eliminar.php?id=$id'>Eliminar</a></td>";
        echo "</tr>";
        echo "<br>";
      }else{
        echo "<thead><td colspan='2'>Hecho</td></thead>";
        echo "<tr>";
        echo "<td>".$tareas["id"]."</td>";
        echo "<td>".$tareas['nombre']."</td>";
        echo "<td><a href='undo.php?id=$id'>Deshacer</a></td>";
        echo "<td><a href='eliminar.php?id=$id'>Eliminar</a></td>";
        echo "</tr>";
        echo "<br>";
      }

    }
?>
</table>
