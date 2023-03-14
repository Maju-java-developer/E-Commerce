<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            font-size: 18pt;  
        }
        .check_box_slot{
            float: left;
            width: 98.5%;
            padding: 10px;
            margin: 0px 0px 3px 0px;
            background: #303030;
            color: #fff;
        }
        .check_box_slot input{
            float: left;
            padding: 0px;
            margin: 0px;
        }
        .check_box_slot h6{
            float: left;
            padding: 0px;
            margin: 0px 0px 0px 20px;
        }
        .wrapper{
            float: left;
        }

    </style>
    <script>
        function generateCheckBoxes(){
            const wrapper = document.getElementById('wrapper');
            for(var i = 0; i < 3; i++){
                wrapper.innerHTML += ''+
                    '<div class="check_box_slot">' +
                        '<input type="checkbox" name="select_PID_'+i+'" onchange="getCheckedStatus(this)" id="select_PID_'+i+'" price="'+ (200*(i+1)) +'">' +
                        '<h6>PID '+i+'</h6>' +
                    '</div>' +
                '';
            }
        }
    </script>
</head>
<body>
    
    <div id="totalContainer" class="totalContainer">
        <p class="totalPrice" id="totalPrice">Rs. 0</p>
    </div>

    <div id="wrapper" class="wrapper">
        <script>
            generateCheckBoxes();
        </script>
    </div>

    <script src="js/jquery.min.js"></script>
    
    <script>
        var dataCollection = null;
        function getCheckedStatus(element){
            if ($(element).is(":checked")){
                var price = $(element).attr('price');
                dataCollection += (parseInt(price));
            }else{
                var price = $(element).attr('price');
                dataCollection -= (parseInt(price));
            }

            var totalPrice = document.getElementById('totalPrice');
            alert('Total Price: ' + dataCollection);
            totalPrice.innerHTML = "Rs. " + dataCollection;
        }           
    </script>
    

    <button onclick="test();"> Click</button>
    <p id="test" style="margin: 10rem;">Rs. 00</p>
    <script>
        function test(){
            var demo = $("#test").text();
            var splitDemo = demo.split(".");

            alert("Split : " + splitDemo[0]);
            alert("Split : " + splitDemo[1]);

        }
    </script>
    <!-- <script src="js/script.js"></script> -->
</body>
</html>