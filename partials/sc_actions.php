
<?php
//To restor in sessions and add in shopping cart
//When shopping cart add submit button is clicked
//restor from $_POSTs array to $_$SESSION arrays 
if(isset($_POST['add'])){
foreach($_POST as $key => $value){
if($key == 'hidden_name'){
$_SESSION['name'] = $value;
} elseif($key == 'qty'){
$_SESSION['qty'] = $value;
} elseif($key == 'hidden_cost'){
$_SESSION['cost'] = $value;
} 

}
/*To check values
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
}

//To empty the cart
//When "empty" btn is clicked, unset 'qty','name','cost'SESSIONS
if(isset($_POST['empty'])){
$_SESSION['qty'] = array();
$_SESSION['name'] = array();
$_SESSION['cost'] = array();

}

//initialise $total variable for calculating the total cost
$total = 0;
$discount = 0;
?>
