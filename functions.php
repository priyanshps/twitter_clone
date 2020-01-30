<?php

    session_start();

    include('conn.php');

    if (isset($_GET['function'])=='logout')
    {
        session_unset();
    }
    
    

    function displayTweets($tweets)
    {
       
        global $link;
        if ($tweets =='public')
        {
            $where="";
        }
        else if($tweets=="isFollowing")
        {
            $follower=mysqli_real_escape_string($link,$_SESSION['id']);
            $query="SELECT * FROM isFollowing WHERE follower='".$follower."'";
            $result=mysqli_query($link,$query);
            $where="";
            while($row=mysqli_fetch_assoc($result))
            {
                if($where == "") $where="WHERE";
                else $where.=" OR";
                $where.=" userid= ".$row['isFollowing'];


            }
        }
        else if($tweets=="yourTweets")
        {
            $userId=mysqli_real_escape_string($link,$_SESSION['id']);
            $where="WHERE userid= ".$userId;
        }
        else if($tweets=="search")
        {
                $searchData=mysqli_real_escape_string($link,$_GET['q']);
                echo "<p>Showing Result for ' ".$searchData." '";
                $where="WHERE tweet  LIKE '%".$searchData."%'";
        }
        else if(is_numeric($tweets))
        {
            $userQuery= "SELECT * FROM user WHERE id= ".mysqli_real_escape_string($link,$tweets)." LIMIT 1";
            $userQueryResult=mysqli_query($link,$userQuery);
            $user=mysqli_fetch_assoc($userQueryResult);
            echo "<h2>".mysqli_real_escape_string($link,$user['email'])." Tweets</h2>";
            $where="WHERE userid= ".mysqli_real_escape_string($link,$tweets);
        }
        // "SELECT * FROM tweets ". $where ." ORDER BY data DESC LIMIT 10";
        $query= "SELECT * FROM tweets ".$where." ORDER BY date DESC LIMIT 20";
        $result=mysqli_query($link,$query);
        $rowcount=mysqli_num_rows($result); 
        if($rowcount==0)
        {
            echo "There no Tweets Post Yet";
        }
        else
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $userQuery= "SELECT * FROM user WHERE id= ".mysqli_real_escape_string($link,$row['id'])." LIMIT 1";
                $userQueryResult=mysqli_query($link,$userQuery);
                $user=mysqli_fetch_assoc($userQueryResult);
                //print_r($user);

                echo " <div class='tweets'> <p>".$user['email']." <span class='time'>".$row['date']." ago</span></p>";
                echo "<p>".$row['tweet']."</p>";

                echo "
                    <p>
                        <a class='btn btn-light toggleFollow' data-userId='".$row['userid']."'>";
                    $follower=mysqli_real_escape_string($link,$_SESSION['id']);
                    $following=mysqli_real_escape_string($link,$row['userid']);
                     $isFollowingquery="SELECT * FROM isFollowing WHERE follower='".$follower."' AND isFollowing= '".$following."'";
                    $isFollowingqueryresult=mysqli_query($link,$isFollowingquery);
                    
                    if(mysqli_num_rows($isFollowingqueryresult)>0)
                    {
                        echo "unfollow";
                    }
                    else
                    {
                        echo "follow";
                    }


                        
                echo "</a></p></div>";
            }
        }
    }   

    function displaySearch()
    {
        echo
        '
        <form class="form-inline sideit">
            <input type="hidden" name="page" value="search">
            <input type="text" name="q" class="form-control mb-2 mr-sm-2" id="Search" placeholder="Search">  
            <button  class="btn btn-primary mb-2">Search</button>
        </form>

        ';
    }
    function displayTweetBox()
    {
        if (isset($_SESSION['id'])>0)
        {
            echo
            '
                <div class="form sideit">
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Add Tweets" id="tweetholder" rows="2"></textarea>
                    </div>
                        <button id="post-tweet-btn" class="btn btn-primary mb-2">Post Tweets</button>
                </div>
            ';

        }
        else
        {

        }

        
    }
    function displayUser()
    {
        global $link;
        $query="SELECT * FROM user LIMIT 10";
        $result=mysqli_query($link,$query);
        while($row=mysqli_fetch_assoc($result))
        {
            echo "<p><a href='?page=publicprofile&userid=".$row['id']."'>".$row['email']."</a></p>";
        }
    }
    


?> 