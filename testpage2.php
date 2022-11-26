<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search</title>
        <style>
            body{
                font-size: 10pt;
                background-color: rgba(170, 59, 8, 0.801);
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0px;
                left: 0px;
                margin: 0px;
                border-top :0px; 
            }
            p{
                margin-top: 0;
                font-size: 13pt;
            }
            .topview{
                display: block;
                background-color: white;
                
                margin: 0px;
                border: 0px;
                padding-block: 1%;
                padding-left: 30px;
                width: 100%;
            }
            .card{
                background-color: aquamarine;
                margin-inline : 123px;
                margin-top: 30px;
                border-radius: 10px;
            }
            .cardtitle{
                display: flex;
                align-items: center;
                justify-content:space-between;
            }
            .cardinside{
                display: flex;
                flex-direction: column;
            }
            .comname{
                align-items: left;

            }
            .comphone{
                justify-content: right;
            }
        </style>
    </head>
    <body>
        <?php
            $button = $_GET['submit'];
            $search = $_GET['search'];

            // connect to database
            $con = mysqli_connect("127.0.0.1", "root", "", "company_analysis");
            // $con = mysqli_connect("localhost", "compzvbh_root", "sskkyy3702", "compzvbh_companyData");

            $sql = "SELECT * FROM tainan_104 WHERE 公司名稱 LIKE '%$search%'";
            // $sql = "SELECT * FROM help_category WHERE MATCH(help_category_id,name,parent_category_id,url) AGAINST ('%" . $search . "%')";

            $run = mysqli_query($con, $sql);
            $foundnum = mysqli_num_rows($run);

            if ($foundnum == 0) {
                echo "We were unable to find a product with a search term of '<b>$search</b>'.";
            } else {
                echo "
                    <div class=\"topview\">
                        <h2 style=\"display:inline;\"> 搜尋結果  共 $foundnum</h2>
                        <h2 style=\"display:inline;\">筆</h2>
                    </div>
                    ";

                // get num of results stored in database
                $sql = "SELECT * FROM tainan_104 WHERE 公司名稱 LIKE '%$search%'";
                $getquery = mysqli_query($con, $sql);

                while ($runrows = mysqli_fetch_array($getquery)) {
                //   $buyLink = $runrows["URL"];
                //   $imageLink = $runrows["IMAGE_URL"];
                echo "
                    <div class=\"card\">
                        <div class=\"cardtitle\">
                            <h1 class=\"comname\">". $runrows['公司名稱'] . " </h1>
                            <h2 class=\"comphone\" style=\"justify-content:right\">". $runrows["電話"] ."</h2> 
                        </div>
    
                        <div  class=\"cardinside\">
                            <p>地址: ". $runrows["地址"] ."</p>
                        </div>
                    </div>
                    ";
                
                // echo "<h5 class='card-title'>" . $runrows["公司名稱"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["產業類別"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["聯絡人"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["產業描述"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["電話"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["資本額"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["傳真"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["員工人數"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["地址"] . "</h5>";
                // echo "<h5 class='card-title'>" . $runrows["公司網址"] . "</h5>";
                // echo "-------------------------------------------------------------------------------------------------------";
                }
            }

            mysqli_close($con);
        ?>
    </body>
</html>