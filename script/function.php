<?
function hashplz($str) {
  $salt="Oj9e1Nsl";
  return hash('sha256', $salt.$str, false);
}
?>
