<?php 
  use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
  
  $sname = htmlspecialchars($name);
  $aurevoirlink = 
      $generator->generate(
          'aurevoir',
          ["name" => $name],
          UrlGeneratorInterface::ABSOLUTE_URL);
?>

<?php printf('Bonjour %s', $sname);?>

<br>
<a href='<?php echo $aurevoirlink?>'>Quitter</a>
