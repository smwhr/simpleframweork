<?php 
  $name = $request->get('name','teapot'); 
  if($name == "teapot") $response->setStatusCode(418);
  $sname = htmlspecialchars($name);
?>

<?php printf('Au revoir %s', $sname);?>