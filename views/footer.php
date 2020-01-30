    
    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">&copy: priyansh shukla</span>
        </div>
    </footer>
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logintitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="alert alert-danger" id="loginAlert">

            </div>
                <form>
                    <input id="loginactive" type="hidden" name="login" value="1"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="Email" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="toggleSignup" class="btn btn-secondary" >Sign up</button>
                <button id="toggleLogin" type="button" class="btn btn-primary">Login</button>
            </div>
            </div>
        </div>
    </div>
  
  <script>
    $("#toggleSignup").click(function(){
        if ($("#loginactive").val()=="1")
        {
            $("#loginactive").val("0");

            $("#logintitle").html("Sign up");

            $("#toggleSignup").html("Login");

            $("#toggleLogin").html("Sign up");

        }
        else
        {
            $("#loginactive").val("1");

            $("#logintitle").html("Log in");

            $("#toggleSignup").html("Sign up");

            $("#toggleLogin").html("login");

        } 
    });

    $("#toggleLogin").click(function(){

        $.ajax({
            type: "POST",
            url: "action.php?action=loginsignup",
            data: "email="+ $("#Email").val() + "&password="+ $("#Password").val() +"&loginactive="+$("#loginactive").val(),
            success: function(result)
            {
                if(result==1)
                {
                    window.location.href="index.php";
                }
                else
                {
                    $("#loginAlert").html(result).show();  
                }
            }
        })

        
    }); 

    $(".toggleFollow").click(function()
    {
        var id= $(this).attr("data-userid");
        console.log(id);
        $.ajax({
            type: "POST",
            url: "action.php?action=toggleFollow",
            data: "userid="+ id,
            success: function(result)
            {
                // console.log("result "+result);
                if(result=="1")
                {
                     $("a[data-userId='"+id+"']").html("Follow");
                    // console.log("data-userId="+id);
                    echo(id);
                }
                else if(result=="2")
                {
                    // $("a[data-userid=' "+$(this).attr("data-userid")+"']").html("Following");
                    alert(id);
                }
            }
        })

    })
    $("#post-tweet-btn").click(function()
    {
        //alert($("#tweetholder").val());
        $.ajax({
            type: "POST",
            url: "action.php?action=postTweet",
            data: "tweetc="+ $("#tweetholder").val(),
            success: function(result)
            {
                alert(result);
                
            }
        })
    })

  </script>
  
  
  
  
  
  
  </body>
</html>