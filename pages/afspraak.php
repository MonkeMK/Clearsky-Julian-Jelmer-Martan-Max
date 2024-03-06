<?php $ERROR = handleAfspraak() ?>
<?php

$db = new Database();
$conn = $db->pdo;

// receive from database
$query = "SELECT date FROM afspraken";
$stmt = $conn->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

// create array with dates only
$dates = array();
foreach ($results as $row) {
    array_push($dates, $row['date']);   
}

// php array to json array
$json_encoded = json_encode($dates);

// putting json array into session storage 
echo "<script>sessionStorage.setItem('unavailable_setad', '$json_encoded')</script>";
?>

<div class="unstyled-container afspraak">
	<h1 class="titel">Maak een afspraak</h1>
	<h5 class="error"><?= isset($ERROR) ? $ERROR : "" ?></h5>
	<form id="myForm" method="post">
		<label class="naamtext" for="name">Naam</label>
		<input class="naam" type="text" placeholder="naam" name="name">
		<label class="datetext" for="datum">Datum:</label>
		<input class="date" type="date" id="date" name="date" oninput="on_date_input(this)">
		<label class="beschrijvingtext" for="beschrijvinigtext">Beschrijving:</label>
		<textarea class="beschrijving" id="description" name="description"></textarea>
		<button disabled id="disabled-button" name="button" class="button"  type="submit">Verzenden</button>
	</form>
</div>

<script>
	const unavailable_setad = sessionStorage.getItem('unavailable_setad');
	console.log(unavailable_setad)

	function on_date_input(element) {
		var selectedDate = new Date(element.value);
		var dayOfWeek = selectedDate.getDay();

		console.log(dayOfWeek);

		const button = document.querySelector("#myForm button[name='button']")

		if (dayOfWeek === 0 || dayOfWeek === 6) {
			window.alert('Please select a weekday (Monday to Friday)');
			button.setAttribute("disabled", "disabled");
		}

		if (!unavailable_setad.includes(element.value)) {
			button.removeAttribute("disabled");
		} else {
			window.alert("This date is unavailable, please pick another one.")
			button.setAttribute("disabled", "disabled");
		}
	} 
</script>
