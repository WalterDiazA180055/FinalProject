<?php 
//Configuracion
include 'conexion.php';
$conectar=new Conexion();
//Metodo Get
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
    $consulta=$conectar->prepare("Select * from país WHERE Id=:id");
    $consulta->bindValue(':id',$_GET['id']);
    $consulta->execute();
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($consulta->fetchAll());
    exit;
    }
    else{
    $consulta=$conectar->prepare("Select * from país");
    $consulta->execute();
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($consulta->fetchAll());
    exit;
}
}
//METODO POST
if($_SERVER['REQUEST_METHOD']=='POST'){
    $consulta=$conectar->prepare("INSERT INTO país(Pais,Irc,Eventos,Ayo)
         VALUES(:pais,:irc,:eventos,:ayo)");
    $consulta->bindValue(':pais',$_POST['pais']);
    $consulta->bindValue(':irc',$_POST['irc']);
    $consulta->bindValue(':eventos',$_POST['eventos']);
    $consulta->bindValue(':ayo',$_POST['ayo']);
    $consulta->execute();
    $ultimoId=$conectar->lastInsertId();
    if($ultimoId){
        header("HTTP/1.1 200 OK");
        echo json_encode($ultimoId);
        exit;
    }
}
//METODO PUT
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $consulta=$conectar->prepare("UPDATE país SET Pais=:pais,Irc=:irc,Eventos=:eventos,Ayo=:ayo
    WHERE Id=:id");
    $consulta->bindValue(':pais',$_GET['pais']);
    $consulta->bindValue(':irc',$_GET['irc']);
    $consulta->bindValue(':eventos',$_GET['eventos']);
    $consulta->bindValue(':ayo',$_GET['ayo']);
    $consulta->bindValue(':id',$_GET['id']);
    $consulta->execute();
    header("HTTP/1.1 200 OK");
    exit;
}
//METODO DELETE
if($_SERVER['REQUEST_METHOD']=='DELETE'){
    $consulta=$conectar->prepare("DELETE FROM país WHERE Id=:id");
    $consulta->bindValue(':id',$_GET['id']);
    $consulta->execute();
    header("HTTP/1.1 200 OK");
    exit;
}
header("HTTP/1.1 400 Error");
?>