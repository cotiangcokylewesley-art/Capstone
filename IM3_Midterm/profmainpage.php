<?php
require("config/authuser.php");
if ($_SESSION['role'] != 'teacher') {
    header('Location: config/unauth.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="imgs/favicon1.ico"type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="BaseHomePage.css">
    <script src="basehomepage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>San Sebastian College-Recoletos, Canlubang</title>
</head>




<body>
    <header>
        <div class="upperhead">
            <img src="imgs/header.png" class="headlogo">
            <a href="https://sscrmnl.edu.ph" target="_blank"><button class="headbutton">OFFICIAL WEBSITE</button></a>
        </div>
        <div class="lowerhead" style="padding-right: 240px;">
            <button class="hbutt" onclick="location.href='profmainpage.php'">HOME</button>
            <button class="hbutt" onclick="window.open('imgs/docu.pdf', '_blank');">DOCUMENTATION</button>
            <button class="hbutt" onclick="location.href='profprofile.php'">PROFILE</button>
            <button class="hbutt" onclick="location.href='profattendance.php'">VIEW ATTENDANCE</button>
            <button class="hbutt" onclick="location.href='BaseHomePage.php'">LOGOUT</button>
        </div>
    </header>



    <div class="infolog">
    <div class="intro-container">
        <button class="intro-button">Introduction <i class="glyphicon glyphicon-triangle-bottom"></i></button>
        <div class="intro-content">
            <p>   &nbsp;&nbsp;&nbsp;&nbsp;  Effective and accessible administration of student attendance is critical in the modern educational setting. Conventional approaches, which frequently depend on manual record-keeping, are difficult, prone to mistakes, and do not provide real-time accessibility. In order to better serve the needs of administrators, teachers, and students, this paper presents a dynamic web-based platform that streamlines and improves student attendance management. The website, which was created with PHP, HTML, CSS, and JavaScript, offers a centralized system for viewing and editing student attendance data in addition to user management features and crucial institutional data.
	        <br><br>  &nbsp;&nbsp;&nbsp;&nbsp;  The project provides a website wherein teachers can view and edit student attendance records for easier administrative handling. The website will hold a database that will retrieve data from a biometric scanner and record the time in and time out of the students. Admins will also be able to edit and delete users, and view audit logs which are detailed, chronological records of events and changes within the system which will help with security and accountability.
	        <br><br>  &nbsp;&nbsp;&nbsp;&nbsp;  Regular attendance in class is essential because it has a big impact on students' academic performance, socioemotional development, and future opportunities.According to Daily et al. (2020)  chronic absenteeism is associated with academic difficulties and decreased use of school resources. This problem affects any organization where attendance is important, not just educational institutions. Problems also arise when using a traditional or manual approach to taking attendances like proxies are possible risks when attendances are taken manually (Nadhan et al., 2022).  Therefore, it is important to give careful thought to putting in place efficient attendance management systems. Even the study conducted by Suthari et al., (2023) agrees that to overcome the challenges or drawbacks of manual attendance taking methods automated attendance systems are needed.
	        <br><br>  &nbsp;&nbsp;&nbsp;&nbsp;  According to Rahman et al., (2023) an automated class attendance system also makes it less difficult for educators and administrators as they can keep tabs on students' attendance, monitor punctuality, and spot tardy or absent students. With this in mind, pairing the project with a website that will be able to provide a user friendly interface for both student and teacher alike will effectively enhance efficiency and effectiveness of an automated attendance system. Even according to the study conducted by Al-Emadi et al., (2021) where they emphasize the importance of user friendliness as it enables users to understand how to operate a system without the need to refer to a user manual. 
</p>
        </div>
        <button class="refer-button" style="margin-top: 40px;">References <i class="glyphicon glyphicon-triangle-bottom"></i></button>
        <div class="refer-content"> 
            <p>Al-Emadi, Khalid & Kassim, Zorah & Razzaque, Anjum. (2021). User Friendly and User Satisfaction Model Aligned With FinTech. 10.4018/978-1-7998-3257-7.ch017. 
                <br><br>Daily, S. M., Smith, M. L., Lilly, C. L., Davidov, D. M., Mann, M. J., & Kristjansson, A. L. (2020). Using school climate to improve attendance and grades: Understanding the importance of school satisfaction among middle and high school students. Journal of School Health, 90(9), 683–693. https://doi.org/10.1111/josh.12929
                <br><br>Nadhan, A. S., Tukkoji, C., Shyamala, B., Lal, N. D., Kumar, A. N. S., Gowda, V. M., Adhoni, Z. A., & Endaweke, M. (2022). Smart Attendance Monitoring Technology for Industry 4.0. Journal of Nanomaterials, 2022(1). https://doi.org/10.1155/2022/4899768
                <br><br>Rahman, Md & Rumman, K & Ahmmed, Rubab & Rahman, Md & Sarker, Md. (2023). Fingerprint Based Biometric Attendance System Section A -Research paper of European Chemical Bulletin. 12. 184-190. 10.31838/ecb/2023.12.s3.026.
                <br><br>Suthari, V., Tharun, G., Sai, G., Reddy, S., & Meera, S. (2023). ATTENDANCE MANAGEMENT SYSTEM. International Research Journal of Modernization in Engineering Technology and Science. https://doi.org/10.56726/irjmets34949
</p>
        </div>
        
    </div>
</div>




    <div class="mivi">
        <div class="container">
            <div class="row">
                <div class="col-md-6 rmv">
                    <h1 class="mivih">VISION & MISSION</h1>
                    <div class="mission-text">
                        <p>San Sebastian College-Recoletos, Canlubang is a spiritually and socially responsive Catholic educational institution, nurturing persons to become globally competent and deeply rooted in the Augustinian Recollect values through transformative integral formation.</p>
                        <br>
                        <p>SSC-R Canlubang Vision is one that is deeply rooted in its commitment to nurture individuals under their care to become not just globally-competent but also grounded in the Augustinian Recollect values. Through transformative integral formation, the Institution envisions to develop students to become well-rounded and capable of making significant contribution to the development of society.</p>
                    </div>
                </div>
                <div class="col-md-6 lmv">
                    <h1>EXPERIENCE OUR TRADITION<br>OF EXCELLENCE</h1>
                    
                    <div class="stats">
                        <div class="stat-row">
                            <div class="statnum">84</div>
                            <div class="stattext">Years of Providing Transformative Catholic Christian Education</div>
                        </div>
                        
                        <div class="stat-row">
                            <div class="statnum">9</div>
                            <div class="stattext">Ranked Law School in the Philippines with successful Bar takers from 2011-2020</div>
                        </div>
                        
                        <div class="stat-row">
                            <div class="statnum">8</div>
                            <div class="stattext">Ranked Psychometrician Licensure Examination</div>
                        </div>
                        
                        <div class="stat-row">
                            <div class="statnum">20</div>
                            <div class="stattext">Certified Public Accountant (CPA) Topnotchers</div>
                        </div>
                        
                        <div class="stat-row">
                            <div class="statnum">56</div>
                            <div class="stattext">NCAA Volleyball Championships</div>
                        </div>
                        
                        <div class="stat-row">
                            <div class="statnum">5</div>
                            <div class="stattext">Longest NCAA Championships in Seniors' Basketball</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="blog">
        <div class="topblog">
            <h1 class="newshead">SSC-R News and Events</h1>
            <button class="viwall">VIEW ALL</button>
        </div>
        <div class="news">
            <img src="imgs/news.jpg">
            <p>🎉 Happy Birthday, Mr. Arnaldo M. Dilig! 🎉</p>
        </div> 
        <div class="news">
            <img src="imgs/news2.jpg">
            <p>CONGRATULATIONS!!! New Certified Public Accountatns #BastaBasteDiBastaBasta</p>
        </div>           
    </div>




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
        <p >© San Sebastian College-Recoletos. All rights reserved 2025</p>
    </footer>

</body>
</html>