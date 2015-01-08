<script>
setTimeout(function(){
   window.location.reload(1);
}, 2000);
</script>

<?php foreach ($viewmodel as $request) { 

echo "Name: " . $request["NAME"] . "; Requests: " . $request["REQUESTS"] . "<br/>";

}
?>
