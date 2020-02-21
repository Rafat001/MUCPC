  <div class="col-lg-10">
    <ul class="nav nav-tabs" style="margin-bottom: 10px">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() . "profile/" . $user->username ?>">User Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/oj_profile">Online Judge Profiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile/' . $user->username) ?>/blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active">Tagwise Solve</a>
      </li>
    </ul>
<?php
if($user->codeforces != ""):
$handle=$user->codeforces;
$profileLink="https://codeforces.com/api/user.status?handle=".$handle."&from=1";

$string = file_get_contents($profileLink);
$jsonIterator =json_decode($string,TRUE);

$submissions=$jsonIterator['result'];

$tagsCountAC=Array(); // to store tags of AC submissions
$tagNamesAC=Array(); // to store unique tag names of AC submissions

$problemidAC=Array(); // to store AC problem ID
$problemLinkAC=Array(); // to store AC problem Links
$problemNameAC=Array(); // to store AC problem names

$tagsCountNAC=Array(); //// to store tags of NOT AC submissions
$tagNamesNAC=Array(); //to store unique tag names of NOT AC submissions


// to store problem names tagwise
$tagToProblem=Array(Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
            Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array(),
        Array(),Array(),Array(),Array(),Array());

foreach ($submissions as $result) {
  
  $contestID = $result["problem"]["contestId"];
  $problemNumber = $result["problem"]["index"];
  $problemID = $contestID.$problemNumber;
  
  $problemName = $result["problem"]["name"];
  $verdict = $result["verdict"];
  $tags = $result["problem"]["tags"];
  
  if($contestID > 9999) // excluding gym submissions
    continue;
  
  if($verdict=="OK" && !in_array($problemID, $problemidAC, TRUE)){
    
    $link = "https://codeforces.com/contest/".$contestID."/problem/".$problemNumber ;
    
    array_push($problemLinkAC, $link);
    
    array_push($problemNameAC,  $problemName);
    
    array_push($problemidAC, $problemID);
    
     foreach ($tags as $tagName){
       
      array_push($tagsCountAC,$tagName);
      $temp=array_count_values($tagsCountAC);
      
      if($temp[$tagName]==1)
        array_push($tagNamesAC,$tagName);
      
      $indexOfTag=array_search($tagName,$tagNamesAC);
      
      $value="<a href=".$link.">".$problemName."</a>"; // hyperlink with problem name;
      
      array_push($tagToProblem[$indexOfTag],$value);
      
     }
  }
  else{
    
    foreach ($tags as $tagName){
      
      array_push($tagsCountNAC,$tagName);
      
      $temp=array_count_values($tagsCountNAC);
      
      if($temp[$tagName]==1)
        array_push($tagNamesNAC,$tagName);
      
     }
  }
}



// echo sizeof($tagNamesAC);
// $counts=array_count_values($tagsCountAC);
// echo "AC Solutions Tag List <br>";
// echo "-------------------------<br>";
// foreach ($tagNamesAC as $names){
  // echo $names.' '.$counts[$names]."<br>";
// }
// echo "-------------------------<br>";
// $counts=array_count_values($tagsCountNAC);
// echo "Not AC Solutions Tag List <br>";
// echo "---------------------------<br>";
// foreach ($tagNamesNAC as $names){
  // echo $names.' '.$counts[$names]."<br>";
//}
?>

<table id="tagList" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th> Tag </th>
      <th> Problems </th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($tagNamesAC as $tags){
  $indexOfTag=array_search($tags,$tagNamesAC);
  echo "<tr>";
  echo "<td>".ucwords($tags).' <span style="font-size: 14px" class="badge badge-primary">' .sizeof($tagToProblem[$indexOfTag])."</span></td>";
  echo "<td>";
  
  $lastIndex=end($tagToProblem[$indexOfTag]);
  foreach ($tagToProblem[$indexOfTag] as $index){
    if($index==$lastIndex)
      echo $index;
    else
      echo $index.", ";
  }
  echo "</td>";
  
}
echo "</tbody></table>";
?>
    </tbody>
  </table>
</div>

<script>
$(document).ready(function () {
    $('#tagList').DataTable({
    "order": [],
    responsive: true
    });
  });
</script>
<?php endif; ?>