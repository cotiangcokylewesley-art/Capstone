<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="imgs/favicon1.ico"type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="BaseHomePage.css">  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Sebastian College-Recoletos, Canlubang</title>
</head>


<style>

.footfetish {
    background-color: rgba(255, 205, 4, 0.78);
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 80px;
    position: relative;
    height: 200px;
    margin-top: auto; /* This pushes the footer to the bottom */
    margin-bottom: 0;
    padding: 20px 0;
    flex-wrap: wrap;
    align-items: center;
    margin-top: 265px;
}

/* Content container to push footer down */
.content-wrapper {
    flex: 1;
    min-height: calc(100vh - 200px); /* Viewport height minus footer height */ 
}

/* Footer content styling improvements */
.logodos {
    height: 80%;
    max-height: 160px;
}

.links {
    display: flex;
    flex-direction: column;
}

.linklum {
    margin-bottom: 10px;
}

.linkerton {
    text-decoration: none;
    color: #333;
    padding-left: 5px;
}

.linkerton:hover {
    color: #cc0000;
    text-decoration: underline;
}

.socmed {
    display: flex;
    justify-content: center;
    gap: 15px;
}

footer p {
    position: absolute;
    bottom: 10px;
    text-align: center;
    width: 100%;
    font-size: 12px;
    color: #333;
    margin: 0;
    padding: 0 15px;
}

@media (max-width: 768px) {
    .footfetish {
        flex-direction: column;
        gap: 20px;
        height: auto;
        padding-bottom: 40px;
    }
    
    footer p {
        position: relative;
        margin-top: 20px;
    }
}

</style>

<body>
    <footer class="footfetish">
        <img src="imgs/header.png" class="logodos">
        <div class="links">
            <div class="linklum">
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  CONTACT DIRECTORY</a></i><br>
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  ADMISSIONS</a></i><br>
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  BROCHURES</a></i><br>
            </div>
            <div class="linklum">
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  ONLINE SERVICES</a></i><br>
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  CAREERS</a></i><br>
                <i class="glyphicon glyphicon-play" style="color:red"><a href="https://sscrmnl.edu.ph/#" class="linkerton">  PRIVACY POLICY</a></i>
            </div>
        </div>
        <div class="socmed">
        </div>
        <p > San Sebastian College-Recoletos. All rights reserved 2025</p>
    </footer>

</body>
</html>