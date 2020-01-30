<?php

    include("functions.php");

    if($_GET["action"]=="loginsignup")
    {
        $error="";
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
            $error="Invalid email format";
        }
        else if(!$_POST['password'])
        {
            $error="An Passwor req";
        }
        if($error !== "")
        {
            echo $error;
            exit();
            //$error="";
        }   
        if($_POST['loginactive']=="0")
        {
            $query="SELECT * FROM user WHERE email='". mysqli_real_escape_string($link,$_POST['email'])."'";
            $result=mysqli_query($link,$query);

            if(mysqli_num_rows($result)>0)
            {
                $error="Please choice ather email address";
            }
            else
            {
               $query = "INSERT INTO user(email,password) VALUES ('" .mysqli_real_escape_string($link,$_POST['email'])."','"
               .mysqli_real_escape_string($link,$_POST['password'])."')";
                if(mysqli_query($link,$query))
                {
                    $_SESSION['id']=mysqli_insert_id($link);
                    $hash=md5($_SESSION['id'].$_POST['password']);
                    $idd=$_SESSION['id'];
                    $query= "UPDATE user SET password = '".$hash."' WHERE id=".$idd;
                    if(mysqli_query($link,$query))
                    {
                        echo 1;
                        
                    }
                }
                else
                {
                    $error="Not Created";
                }
            }
        }
        else
        {
            $query="SELECT * FROM user WHERE email='". mysqli_real_escape_string($link,$_POST['email'])."'";
            $result=mysqli_query($link,$query);

            $row=mysqli_fetch_assoc($result);
            $hash=md5($row['id'].$_POST['password']);
            if($row['password']==$hash)
            {   
                $_SESSION['id']=$row['id'];
                echo "1";
            
            }

            else
            {
                echo "0";
            }

            
        }
        if($error !== "")
        {
            echo $error;
            exit();
            //$error="";
        } 
        //print_r($_POST);
        
       
    }
    if($_GET["action"]=="toggleFollow")
    {
        $follower=mysqli_real_escape_string($link,$_SESSION['id']);
        $following=mysqli_real_escape_string($link,$_POST['userid']);
        $query="SELECT * FROM isFollowing WHERE follower='".$follower."' AND isFollowing= '".$following."'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0)
        {
            
            $id=mysqli_real_escape_string($link,$row['id']);
            $query="DELETE FROM isFollowing WHERE id =".$id;
            $result=mysqli_query($link,$query);
            echo 1;
        }
        else
        {
            $id=mysqli_real_escape_string($link,$row['id']);
            $query="INSERT INTO  isFollowing(follower,isFollowing) VALUES($follower,$following)";
            $result=mysqli_query($link,$query);
            echo 2;
        }

    }
    if($_GET["action"]=="postTweet")
    {
        //print_r($_POST['tweetc']);

        if(!$_POST['tweetc'])
        {
            echo" Enter Tweet first";
        }
        else if(strlen($_POST['tweetc']) > 140)
        {
            echo "Your Tweet is To long";
        }
        else
        {
             $content=$_POST['tweetc'];
             $id=mysqli_real_escape_string($link,$_SESSION['id']);
            
             $query="INSERT INTO  tweets(tweet,userid) VALUES('$content',$id)";
            $result=mysqli_query($link,$query);
            echo 1;
        }

    }

    
        

?>