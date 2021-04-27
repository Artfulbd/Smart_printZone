<script type="text/javascript">

      $(document).ready(function(){
        $('html').on('contextmenu', function(e){
          return false;
        })
      })

      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      var raw = JSON.stringify({
      "zone_code": "1",
      "ip": "172.168.0.23",
      "key": "nai",
      "machine": "jani na"
      });

      var requestOptions = {
      method : 'POST',
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

      document.getElementById('zone_name_class').innerHTML = response.zone_name;
      //document.getElementById('zone_name_class').innerHTML = "other text";

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