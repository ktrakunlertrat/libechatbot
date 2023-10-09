<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> NCS  </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        
        
        <nav class= " navbar navbar-expand-lg">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <img src="ass/NULOGO-Download-297x300.png" alt="logo" width="50" height="50">

                <h1>Name Check System</h1>

              </div>
            </div>
          </nav>

          <style>
            body.logo{
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              opacity: 50%;
            }
          </style>

    </head>
    
    <body background="ass/Background.png">
    <div class="mb-3 d-flex align-items-center justify-content-center" style="height: 50vh;">
    <div class="mb-3">
       
        </div>
        <form method="post" action="loginsystem.php">
            <div class="mb-3">
            <H3>Login</H3> 
                <input type="text" name="username" placeholder="Username" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div id="usernamehelp" class="form-text">We'll never share your username and password with anyone else.</div>
        </form>
    </body>
</div>
      
</html>
