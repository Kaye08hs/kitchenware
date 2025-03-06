<?php include 'header.php'; ?>
<div class="col-md-3">
	<div class="box1">
		<h3>Total Students</h3>
		<h1>234</h1>
	</div>
</div>
<div class="col-md-3">
	<div class="box2">
		<h3>Total Items</h3>
		<h1>234</h1>
	</div>
</div>
<div class="col-md-3">
    <div class="box3 date-time">
        <h3>Date and Time</h3>
        <p id="current-date"></p>
        <p id="current-time"></p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
	function updateDateTime() {
    const dateElement = document.getElementById('current-date');
    const timeElement = document.getElementById('current-time');

    const now = new Date();
    const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };

    const formattedDate = now.toLocaleDateString(undefined, optionsDate);
    const formattedTime = now.toLocaleTimeString(undefined, optionsTime);

    dateElement.textContent = formattedDate;
    timeElement.textContent = formattedTime;
}
setInterval(updateDateTime, 1000);


</script>
<?php include 'footer.php'; ?>
	        