<script type="text/javascript">
	
	function formatDate(date) {

        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            var strDate = month + '/' + day + '/' + year;

        return strDate;

        //return [month, day, year].join('/');
    }

    function formatTime(date) {

        var d = new Date(date),
            
            hours = d.getHours();
            minutes = d.getMinutes();
            seconds = d.getSeconds();

            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
        
        return strTime;

        //return [month, day, year].join('/');
    }
    
</script>