<?php
    include("functions.php");
    
    include("views/header.php");

    if($_GET['page'] == 'timeline')
    {
        include("views/timeline.php");
    }
    else if($_GET['page']== 'yourTweet')
    {
        include("views/yourtweets.php");
    }
    else if($_GET['page']== 'search')
    {
        include("views/search.php");
    }
    else if($_GET['page']== 'publicprofile')
    {
        include("views/publicprofile.php");
    }
    else
    {
        include("views/home.php");
    }

//publicprofile.php?userid=2
    
    include("views/footer.php");




?>