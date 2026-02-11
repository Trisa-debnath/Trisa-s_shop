<div>
    <!-- Flash Sell Countdown Box -->
<div class="time-flash mt-4 w-100" style="
    background-color: #fff3cd;
    padding: 15px;
    border-left: 5px solid #ffc107;
    font-size: 1.2rem;
    font-weight: 500;
    margin-bottom: 30px;
    text-align: center;
    border-radius: 5px;
    width: 100%;
    display: block;

">



  <span style="color:#856404; font-weight:bold;">⚡ Flash Sell Ending in:</span>
  <div id="flashCountdown" style="margin-top: 10px;">
    <span id="days" style="font-weight: bold; color:#343a40;">07</span> Days
    <span id="hours" style="font-weight: bold; color:#343a40;">12</span> Hours
    <span id="minutes" style="font-weight: bold; color:#343a40;">59</span> Minutes
    <span id="seconds" style="font-weight: bold; color:#343a40;">59</span> Seconds
  </div>
</>

<!-- Countdown Script -->
<script>
  let countdownDate = new Date();
  countdownDate.setDate(countdownDate.getDate() + 7);
  countdownDate.setHours(countdownDate.getHours() + 12);
  countdownDate.setMinutes(countdownDate.getMinutes() + 59);
  countdownDate.setSeconds(countdownDate.getSeconds() + 59);

  function updateCountdown() {
    let now = new Date().getTime();
    let distance = countdownDate - now;

    if (distance <= 0) {
      document.getElementById('flashCountdown').innerHTML = "⏰ Flash Sale Ended!";
      return;
    }

    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerText = String(days).padStart(2, '0');
    document.getElementById("hours").innerText = String(hours).padStart(2, '0');
    document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
    document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');
  }

  updateCountdown();
  setInterval(updateCountdown, 1000);
</script>

</div>