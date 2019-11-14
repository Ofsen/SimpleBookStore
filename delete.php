<?php
include 'config.php';

if(isset($_GET) && !empty($_GET)) {
    $id = htmlspecialchars($_GET['id']);
    if(empty($_GET['all']) && !isset($_GET['all'])) {
        $prep = $db->prepare('SELECT * FROM books WHERE id = ?');
        try {
            $prep->execute([$id]);
            $req = $prep->fetchAll();
            if (isset($req) && !empty($req)) {
                if($req[0]['nb']>1) {
                    try {
                        $del = $db->prepare("UPDATE books SET nb = ? WHERE id = ?");
                        $del->execute(array($req[0]['nb']-1,$id));
                    }catch(Exception $e) {
                    }
                } else {
                    try {
                        $del = $db->prepare("DELETE FROM books WHERE id = ?");
                        $del->execute([$id]);
                    }catch(Exception $e) {
                        echo "Error: Couldn't delete.";
                    }
                }
            }
        } catch(Exception $e) {
            echo "Error: Couldn't delete the book. Problem in executing the prepared statement.";
        }
    } else if(isset($_GET['all']) && !empty($_GET['all']) && htmlspecialchars($_GET['all']) == 'yes') {
        try {
            $del = $db->prepare("DELETE FROM books WHERE id = ?");
            $del->execute([$id]);
        }catch(Exception $e) {
            echo "Error: Couldn't delete.";
        }
    }
}

header('Location:index.php');