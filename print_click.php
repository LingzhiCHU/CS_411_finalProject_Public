<html>
<head>
<script>
function print_clickCounter() {
   document.getElementById("result").innerHTML = "You have clicked the button " + localStorage.clickcount + " time(s).";
}
</script>
</head>
<body>

<p><button onclick="print_clickCounter()" type="button">Check result!</button></p>

<div id="result"></div>

</body>
</html>