<!DOCTYPE html>
<html>

<head>
  <title>Search</title>
</head>

<body>

  <?php
  $button = $_GET['submit'];
  $search = $_GET['search'];

  // connect to database
  $con = mysqli_connect("127.0.0.1", "root", "", "company_analysis");

  $sql = "SELECT * FROM tainan_104 WHERE 公司名稱 LIKE '%$search%'";
  // $sql = "SELECT * FROM help_category WHERE MATCH(help_category_id,name,parent_category_id,url) AGAINST ('%" . $search . "%')";

  $run = mysqli_query($con, $sql);
  $foundnum = mysqli_num_rows($run);

  if ($foundnum == 0) {
    echo "We were unable to find a product with a search term of '<b>$search</b>'.";
  } else {
    echo "<h1><strong> $foundnum Results Found for \"" . $search . "\" </strong></h1>";

    // get num of results stored in database
    $sql = "SELECT * FROM tainan_104 WHERE 公司名稱 LIKE '%$search%'";
    $getquery = mysqli_query($con, $sql);

    while ($runrows = mysqli_fetch_array($getquery)) {
      //   $buyLink = $runrows["URL"];
      //   $imageLink = $runrows["IMAGE_URL"];

      echo "<h5 class='card-title'>" . $runrows["公司名稱"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["產業類別"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["聯絡人"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["產業描述"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["電話"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["資本額"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["傳真"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["員工人數"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["地址"] . "</h5>";
      echo "<h5 class='card-title'>" . $runrows["公司網址"] . "</h5>";
      echo "-------------------------------------------------------------------------------------------------------";
    }
  }

  mysqli_close($con);
  ?>

</body>

</html>