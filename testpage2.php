<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Search</title>
        <style>
            body{
                font-size: 10pt;        /*設定字體大小*/
                background-color: rgba(170, 59, 8, 0.801);      /*設定背景顏色*/
                width: 100%;        /*寬度100%*/
                margin: 0px;        /*將body的margin設為0*/
            }
            .comaddress{
                margin-top: 0;      /*將上方margin設為0*/
                font-size: 13pt;        /*字體大小*/
            }
            .topview{       /*頂欄*/     
                background-color: white;/*想到再換顏色*/
                padding-block: 1%;      /*四邊padding設為1%*/
                padding-left: 30px;     /*左邊留空白比較好看*/
            }
            .card{      /*每個公司的區塊*/
                background-color: aquamarine;       /*背景顏色*/
                margin-inline : 125px;      /*寬度*/
                margin-top: 30px;       /*與上一個的間隔*/
                padding: 10px;      /*內出血*/
                padding-top: 0px;       /*上方出血*/
                border-radius: 10px;        /*圓角半徑*/
            }
            .cardtitle{     /*標題*/
                display: flex;      /*用flex模式排列*/
                align-items: center;        /*對齊X軸*/
                justify-content:space-between;      /*平均分配寬度，第一項和最後一項貼齊邊緣*/
            }
            .cardinside{        /*內文*/
                /*display: flex;*/      /*還沒放其他東西所以沒有排列*/
                flex-direction: column;     /*用column排*/
            }
            .comname{          /*公司名稱*/
                align-items: left;      /*靠左對齊*/

            }
            .comphone{      /*公司電話*/
                align-items: right;     /*靠右對齊*/     
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
                            <div class=\"comaddress\">地址: ". $runrows["地址"] ."</div>
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