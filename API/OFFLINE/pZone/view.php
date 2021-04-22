<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
    <title>NSU Print Zone</title>

    <style>
        tr {
            line-height: 35px;
            min-height: 35px;
            height: 35px;
        }
        .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
            background-color: #b8d9f5;
        }
        th {
            font-family: ‘Comfortaa’, serif;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row my-5">
        <div class="col-12 center-block text-center">
            <h1 class="text-secondary mb-3 ">Current Status</h1>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="bg-info font-weight-bold">
            <tr>
                <th scope="col">Printer Name</th>
                <th scope="col">User Name</th>
                <th scope="col">ID</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody id="current_status">

            </tbody>
        </table>
    </div>



    <div class="row my-5">
        <div class="col-12 center-block text-center">
            <h1 class="text-secondary mb-3 ">Card Punched</h1>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white font-weight-bold">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">ID</th>
                <th scope="col">Printer Name</th>
                <th scope="col">Tentative Starting Time</th>
            </tr>
            </thead>
            <tbody id="punch_data">


            </tbody>
        </table>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>

      $(document).ready(function(){
        $('html').on('contextmenu', function(e){
          return false;
        })
      })

      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      var raw = JSON.stringify({
      "ip": "172.168.0.23",
      "key": "nai",
      "machine": "jani na"
      });

      var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw,
      redirect: 'follow'
      };

      setInterval(function(){
      fetch("http://localhost/pZone/server/any_update.php", requestOptions)
      .then(function(response){
        return response.json()
      })
      .then(function(response){
        fillUp(response);
      })
      .catch(error => console.log('error', error));



      }, 3000);

      function fillUp(response){
      console.log(response);
      $("#current_status").empty();
      $.each(response.status_data, function (key, value) {
          var color = null
          if(value.current_status === '1')
              color = 'text-success'
          else if(value.current_status === '2')
              color = 'text-info'
          else
              color = 'text-danger'
          $("#current_status").append('<tr><td class="text-uppercase">' + value.given_name + '</td><td>' + value.user_name + '</td><td>' + value.u_id + '</td><td class="font-weight-bold text-uppercase '+ color +'">' + value.status + '</td></tr>');
       });


      // Punched Data
      $("#punch_data").empty();
      $.each(response.punch_data, function (key, value) {
          $("#punch_data").append('<tr><td>' + value.index + '</td><td>' + value.name + '</td><td>' + value.id + '</td><td class="font-wight-bold text-uppercase">' + value.printer_name + '</td><td>'+value.time+'</td></tr>');
        });
      }
    
</script>


</body>
</html>

