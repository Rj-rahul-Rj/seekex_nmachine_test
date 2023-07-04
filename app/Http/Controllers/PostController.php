<? echo $users; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Seeker Machine Test</title>
    <style>
        *{
            /* border:1px solid red; */
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" >
                <h1>Bucket Form</h1>
                <div class='p-3' style="border:1px solid gray" > 
                
                        <div class='p-3 d-flex justify-content-between'>
                            <label for="" >Bucket Name : </label>
                            <input class="w-50" type="text" name="bucket_name"  id='bucket_name' onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required>
                           
                        </div>
                        <div class='p-3 d-flex justify-content-between' >
                            <label for="">Volume (in inches) : </label><input class="w-50" type="number" name='bucket_volume'  id='bucket_volume' required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" name="bucket" value="Save" onclick="storeValue()" >
                        </div>
                    
                </div>
            </div>
            <div class="col-md-6">
                <h1>Ball Form</h1>
                <div class='p-3' style="border:1px solid gray">
                <!-- <form action="createBall" method="post">
                    @csrf -->
                    <div class='p-3 d-flex justify-content-between'>
                        <label for="">Ball Name : </label>
                        <!-- <select class="w-50 " name="ball_name" id="ball" onchange="getVolumeValue()" required>
                        <option value="">Select Ball</option>
                            @foreach ($ball as $balls)
                            <option value="{{$balls->id}},{{$balls->ball_value}}">{{ $balls->ball_name }}</option>
                            @endforeach 

                        </select> -->
                        <input class="w-50" type="text" name="ball_name"  id='ball' onkeypress="return (event.charCode > 64 && 
event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  required>
                    </div>
                    <input class="w-50" type="hidden"  name='bucketname' id='bucket_val'>
                    <input class="w-50" type="hidden"  name='bucket_vol' id='bucket_vol'>
                    <div class='p-3 d-flex justify-content-between'>
                        <label for="">Volume (in inches) : </label><input class="w-50" type="text" name="ball_volume" value='' id='ball_val'>
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="Save" value="Save"  onclick="getVolumeValue()">
                    </div>
                <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
 
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>
</html>
<script type="text/javascript">

    
    function storeValue(){
        var bucket = $('#bucket_name').val().toUpperCase();

        var bucket_volume = $('#bucket_volume').val();
        
       if(bucket.length == '' || bucket_volume.length == ''){
            alert('All Field\'s are mandatory!')
       }else{
        
    
        $.ajax({
            url: '/createBucket',
            type: 'post',
            data:{bucket_name:bucket, bucket_volume:bucket_volume},
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            error: function(xhr, status, error) {
          alert(xhr.responseText+error);
        },
            success: function(response){  
                $('#bucket_val').val(bucket);

                $('#bucket_vol').val(bucket_volume);
                $('#bucket_volume').val(response.data)
                alert(response.message);
                alert("Bucket added, Please fill ball in selected Bucket");
            }
        });
       }
       
       
    }

    function getVolumeValue(){
       var ball = $('#ball').val().toUpperCase();
       var bucket = $('#bucket_val').val().toUpperCase();

       var bucket_vol = $('#bucket_vol').val();
       var ball_val = $('#ball_val').val();
       if(ball.length == '' || ball_val.length == ''){
            alert('All Field\'s are mandatory!')
       }else{
        $.ajax({
            url: '/createBall',
            type: 'post',
            data:{bucket_name:bucket, bucket_volume:bucket_vol,ball_name:ball,ball_volume:ball_val},
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            error: function(xhr, status, error) {
          alert(xhr.responseText+error);
        },
            success: function(response){    
                // $('#bucket_volume').val(response.data)
                alert(response.message);
                // alert("Bucket added, Please fill ball in selected Bucket");
            }
        });
       }
       





    }
 
</script>