
        <?php
if(isset($_POST["id"]))
{
    require_once "config.php";
    $userid = $db->real_escape_string($_POST["id"]);
    $sql = "DELETE FROM Sport WHERE id = '$userid'";
    if($db->query($sql)){
         
        header("Location: welcome1.php");
    }
    else{
        echo "Ошибка: " . $db->error;
    }
    $db->close();  
}
?>
