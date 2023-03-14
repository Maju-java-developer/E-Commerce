<!-- <script>
    variants_title = ["Color", "Size","Memory","Processor","RAM","Cemera"];
    variants_values = [
        "Red|Green|Blue",
        "12x14 | 14x16",
        "2 GB RAM | 4 GB RAM | 8 GB RAM",
        "Slicon Chips",
        "4 RAM | 8 RAM",
        "14 Front Cemera | 20 Background Camera"
    ];
    variants_desc = ["This is color Description ", "This is size Description"];
    
</script>

<?php
// $titles = array();
    $data = [];

    array_push($data,"
    <script>
    for(i = 0; i < variants_title.length; i++){
        document.write('<br>'+variants_title[i] + '_');
        if(i == variants_title.length-1){
            document.write('_');
        }
    }
    </script>");

    array_push($data,"
    <script>
    for(i = 0; i < variants_values.length; i++){
        document.write('<br>'+variants_values[i]);
        if(i == variants_values.length-1){
            document.write('_');
        }
    }
    </script>");
 
    for ($i=0; $i < sizeof($data); $i++) { 
        echo $data[$i];
    }

    $varinats_title = "";

    $variants_title = $data[0];
    echo $variants_title;

    $variants_titles = explode("_",$variants_title);

    for ($x=0; $x < sizeof($variants_titles); $x++) { 
        echo $variants_titles[$x];
    }

?>

<!-- <script>
    var variants_title = ['Color',"Size","Memory"];
    var variants_values = ['RED',"12x14","4 gb ram"];
    
        <?php
        // $size = "<script>variants_title.length</script>";
        // echo $size ; -->

//         for ($i=0; $i < ; $i++) { 
//             # code...
//         }
// array_push($titles,
//         "<script>
//             // for(var i=0; i < variants_title.length;i++){
//                 document.write(variants_title[0]);
//             // }
//         </script>"
//         );    
    ?>
</script>
<?php

// echo "Title: " .$titles[0] . "<br>";
    
// echo sizeof($titles);
 
// $data = explode("_" , $titles[0]);
// echo sizeof($data);

// for ($index=0; $index < sizeof($data); $index++) { 
//     echo $data[$index];
// }

// $varaints_data = [];

    // array_push($titles,"<script>document.write(variants_title[0])</script>");
    // array_push($titles,"<script>document.write(variants_title[1])</script>");
    // array_push($titles,"<script>document.write(variants_title[2])</script>");
    
    // for ($i=0; $i < sizeof($titles); $i++) { 
    //     echo "Titles: " . $titles[$i] . "<br>";
    // }
    // echo "Titles: " . $titles[1] . "<br>";
    // echo "Titles: " . $titles[2] . "<br>";

    // echo "SIZE OF DATA : ". sizeof($varaints_data) . "<br>";
    // echo "$varaints_data[0]";
    // $varinats_titles = $varaints_data[0]; 
    // echo "Variant Title: $varinats_titles";

    // for ($i=0; $i < sizeof($varaints_data); $i++) {
    // }

    // Pushing Value In Array With Array_push Method 
    // $slots = array('Majid', 'Sajid', 'Wajid');

    // array_push($slots, 'Hamid');
    // foreach($slots as $slot){
    //     echo $slot . "<br>";
    // }


    // Expolding To Value:
    // $data = "Size_12x14 : Color_RED|GREEN|BLUE:";
    // $mainData = explode(":",$data);
    // echo "$data <br>";
    // echo (sizeof($mainData)-1) ."<br><br>";

    // $variants_title = null;
    // $varinats_values = null;

    // for ($i=0; $i < sizeof($mainData)-1; $i++) { 
    //     echo "Value $i: ". $mainData[$i] ."<br>";

    //     $subvalues = explode("_", $mainData[$i]);
    //     $variants_title = $subvalues[0];
    //     $varinats_values = $subvalues[1];

    //     echo "Title: " . $variants_title . "<br>";
    //     echo "Values: ". $varinats_values. "<br>";
        
    // }

    ?>

<!-- <script>
    const names = ['Majid', 'Sajid', 'Wajid'];
</script>

<div id="test"></div>
<script>
    const testContainer = document.getElementById("test");
    for(var i = 0; names.length; i++){
        // document.write(names[i]);
    }
</script>

<?php 

// echo "working file";
// $names = ["Majid","Faraz Hussain"];

// echo $names[0];
// echo $names[1];

// $names = [];

// $names[] = "Majid";
// $names[] = "Sajid";
// $names[] = "Wajid";

// echo $names[0];
// echo $names[1];
// echo $names[2];

?>
script
<?php // echo "Working";?>

&variants=color:red|blue|green|,dimension:190|200,
 -->


<?php

include_once('templates/footer.php');

session_start();
ob_start();

function addToCart_2($sessNam, $sessVal){
    if(isset($_SESSION[$sessNam])){
        if($_SESSION[$sessNam] == null || $_SESSION[$sessNam] == ""){
            $_SESSION[$sessNam] = $sessVal;
        }else{
            foreach(explode("|", $_SESSION[$sessNam]) as $tempVal){
                if($sessVal == $tempVal){
                    header('Location: ?alert=101');
                    exit();
                }
            }

            $_SESSION[$sessNam] = $_SESSION[$sessNam] . "|" . $sessVal;
            
            // if(strpos($_SESSION[$sessNam], $sessVal)){
            //     echo "Already added!";
            // }else{
            //     $_SESSION[$sessNam] = $_SESSION[$sessNam] . "|" . $sessVal;
            // }
        }
        // echo $_SESSION[$sessNam];
    }else{
        $_SESSION[$sessNam] = $sessVal;
    }

    
    // echo "<h2 style='width: 30px; height: 30px; border-radius: 100%; color: #fff; background: #330099; padding: 10px; margin: 10px;'>" . sizeof(explode("|", $_SESSION[$sessNam])) . "</h2>";

    // $convertToString = implode('|', $values);

    // $_SESSION['LOVE'] = $convertToString;

    // if($_SESSION['LOVE'] != null || $_SESSION['LOVE'] != ""){
    //     $tempArr = array();
    //     foreach(explode('|', $_SESSION['LOVE']) as $array){
    //         array_push($tempArr, $array);
    //     }

    //     array_push($tempArr, "D");

    //     $convertToString = implode('|', $tempArr);
    //     $_SESSION['LOVE'] = $convertToString;

    //     echo $_SESSION['LOVE'];
    //     // foreach($tempArr as $tempVal){
    //     //     echo $tempVal;
    //     // }
    // }
}

// unset($_SESSION['LOVE']);

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['product_id'])){
    $val = $_GET['product_id'];
    addToCart("LOVE", $val);
}

echo $_SESSION['LOVE'];
echo "<h2 style='width: 30px; height: 30px; border-radius: 100%; color: #fff; background: #330099; padding: 10px; margin: 10px;'>" . sizeof(explode("|", $_SESSION['LOVE'])) . "</h2>";

?>

<script>
    function getProductID(element){
        window.location.href = "?product_id=" + $(element).attr('product_id');
    }
</script>

<button type="submit" name="btn" id="btn" value="ADD" product_id="1417" onclick="getProductID(this);">ADD TO CARD</button>
<button type="submit" name="btn" id="btn" value="ADD" product_id="1418" onclick="getProductID(this);">ADD TO CARD</button>
<button type="submit" name="btn" id="btn" value="ADD" product_id="1419" onclick="getProductID(this);">ADD TO CARD</button>

<?php

// $colors = ['Red', 'Pink', 'Blue','Black'];

// foreach($colors as $color){
//     echo "<div title='". $color ."' style='background: ". $color ."; width: 25px; height: 25px; border-radius: 100%; float: left;'>&nbsp;</div>";
// }

$itemData = "ID_4 | ID_ 3 |";
$itemIDs = explode("|", $itemData);

for ($i=0; $i < sizeof($itemIDs)-1; $i++) { 
    echo "<br> " . explode("_", $itemIDs[$i])[1];
}
?>