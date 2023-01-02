<?php 
include 'conn.php'; 
if(isset($_POST['inpt'])){
    $name=$_POST['inpt'];
}

?>
<!DOCTYPE html>
<html lang="!">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="icon" type="image/x-icon"  href="Picture1-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>NutriFacts</title>
</head>
<body>
    <section class="container-fluid" style="background: rgb(121,9,96);background: linear-gradient(169deg, rgba(121,9,96,1) 35%, rgba(3,0,255,1) 100%);" data-aos="fade-down" data-duration="8000">
        <a href="index.php" class="navbar-brand"><h1 style="color: white;" data-aos="zoom-in">NutriFacts</h1></a>
        <br><br><br><br>
        <h1 class="text-center" style="color:aliceblue"><span class="mul"></span></h1>
        <script>
            var typing=new Typed(".mul",{
              strings : ["Know what your body gets from what you eat!"],
              typeSpeed: 100
          });
            
          </script>
        <br><br>
        
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="post" action="index.php">
                    <input class="text-center" name="inpt" placeholder="Search for fruits/vegetables" type="text" id="s1" style="border-radius: 10px;width: 40vw; font-family: 'Times New Roman', Times, serif;font-size: 40px;">
                    <button type="submit" class="btn btn-lg" name="b1"><i class="fa fa-search"  style="font-size: 20px; color:white"></i></button>
                </form>
                
            </div>
        </div>
        <br><br><br><br>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <br>
                <?php 
                    if(isset($_POST['inpt'])){
    
                        $sql="SELECT * FROM fruits_vegies where fname='$name'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row=mysqli_fetch_assoc($result)){?>
                                <?php echo "<h1>".$row['fname']."</h1>";?>
                                <p><?php echo $row['description'];?></p>
                                <img class="img-fluid" src=<?php echo $row['image'];?>> 
                                <i style="color:grey">Image by <a href=<?php echo $row['imglink'];?>><?php echo $row['imgauthor'];?></a> from <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=7130981">Pixabay</i></a>
                                <br><br>
                                <h4>Benefits</h4>
                                <p><i><?php echo "Source: ".$row['bauth'];?></i></p>
                                <ol class="list-group" >
                                    <li class="list-group-item"><?php echo $row['b1'];?></li>
                                    <li class="list-group-item"><?php echo $row['b2'];?></li>
                                    <li class="list-group-item"><?php echo $row['b3'];?></li>
                                    <li class="list-group-item"><?php echo $row['b4'];?></li>
                                    <li class="list-group-item"><?php echo $row['b5'];?></li>
                                    <li class="list-group-item"><?php echo $row['b6'];?></li>
                                    <li class="list-group-item"><?php echo $row['b7'];?></li>
                                    <li class="list-group-item"><?php echo $row['b8'];?></li>
                                </ol>
                                </div>
                                <div class="col-sm-4">
                                    <br><br>
                                    <h4>Nutritional Facts(<?php echo $row['servingsize'];?>)</h4>
                                    <p>%values are based on a 2,000 calorie diet.</p>
                                    <p><i><?php echo "Source:".$row['nsrc'];?></i></p>
                                    <table class="table table-stripped">
                                        <tbody>
                                            <tr>
                                                <td>Calories</td>
                                                <td><?php echo $row['calories'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Total Fat</td>
                                                <td><?php echo $row['totalfat'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Cholestrol</td>
                                                <td><?php echo $row['cholestrol'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Sodium</td>
                                                <td><?php echo $row['sodium'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Potassium</td>
                                                <td><?php echo $row['potassium'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Dietary fiber</td>
                                                <td><?php echo $row['df'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Sugar</td>
                                                <td><?php echo $row['sugar'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Protein</td>
                                                <td><?php echo $row['protein'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Vitamin C</td>
                                                <td><?php echo $row['vitaminc'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Iron</td>
                                                <td><?php echo $row['iron'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Vitamin B6</td>
                                                <td><?php echo $row['vitaminb6'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Magnesium</td>
                                                <td><?php echo $row['magnesium'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Calcium</td>
                                                <td><?php echo $row['calcium'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Vitamin-D</td>
                                                <td><?php echo $row['vitamind'];?></td>
                                            </tr>


                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                
                        
                        <?php  }
                    }
                }?>
                
                
                
                
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <br><br><br><br><br><br><br><br><br><br>

<footer class="text-center"  style="font-family: Oswald;"><h5>&#169;2022, NutriFacts<br>Developed by Aayush Juhukar</h5></footer>
</div>
</body>
</html>