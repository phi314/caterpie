<script type="text/javascript">
monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
"Juli", "Agustus", "September", "Oktober", "November", "Desember"];
dayNames = ["<big>Minggu</big>", "<big>Senin</big>", "<big>Selasa</big>", "<big>Rabu</big>", "<big>Kamis</big>", 
"<big>Jumat</big>", "<big>Sabtu</big>"];
function waktuTanggal(oneDate) {
var theDay = dayNames[oneDate.getDay()];
var theMonth = monthNames[oneDate.getMonth()];
var theYear = oneDate.getFullYear();
return theDay + ", " + oneDate.getDate() + " " + theMonth + 
" " + theYear;
}
</script>
<script type="text/javascript">
document.write(waktuTanggal(new Date()))
</script>
<div>
<font face="calibri" size="-6">
    <h4 id="waktu"></h4>
</font>

<script type="text/javascript">
        function showClock()
        {
            thisTime = new Date();
            jam = thisTime.getHours();
            menit = thisTime.getMinutes();
            detik = thisTime.getSeconds();
            var waktu;
            waktu = (jam > 9)? jam : ("0" +jam);
            waktu += (menit > 9)? ":"+menit : (":0"+menit);
            waktu += (detik > 9)? ":"+detik : (":0"+detik);
            document.getElementById("waktu").innerHTML = waktu;     
            setTimeout("showClock()",200);
        }
        showClock();
		
</script>