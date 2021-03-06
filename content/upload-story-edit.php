<!-- 
    Todo:
     - Check for CSRF Token
     - Make sure Session Username matches story author
 -->

<?php
    session_start();
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }


    require("../database.php");
    $story_pk = $_POST['story_pk'];
    $title = $_POST['new-title'];
    $link = $_POST['new-link'];
    $author = $_SESSION['username'];

    $query_string = "UPDATE stories SET title=?, link=? WHERE story_pk=?";
    $bind_string = "ssi";
    $data = array($title, $link, $story_pk);

    require("shared.php");
    if (edit_data($query_string, $bind_string, $data)){
        header("Location: main.php");
    }

    // $stmt = $mysqli->prepare("UPDATE stories SET title=?, link=? WHERE story_pk=?");
    // if(!$stmt){
    //     printf("Query Prep Failed: %s\n", $mysqli->error);
    //     exit;
    // }

    // $stmt->bind_param('sss', $title, $link, $story_pk);

    // if ($stmt->execute()){
    //     printf("Edit uploaded successfully.");
    //     header('Location: main.php');
    //     $stmt->close();
    // }else{
    //     printf("Edit failed.");
    //     $stmt->close();
    // }

    
    
?>