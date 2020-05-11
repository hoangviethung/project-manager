
<?php if(in_array($this->controller, array('user','products'))){?>
<script src="statics/directory/vendor/datatables/js/jquery.dataTables.js"></script>
<script src="statics/directory/vendor/datatables/js/dataTables.bootstrap.js"></script>
<?php }?>

<?php if($this->controller=='product'){?>
<script src="statics/directory/js/products.js"></script>
<?php } ?>

<?php if($this->controller=='user'){?>
<script src="statics/directory/js/users.js"></script>
<?php } ?>

<link rel="stylesheet" href="statics/directory/vendor/flatpickr/n_flatpickr.css">
<link rel="stylesheet" href="statics/directory/css/custome.css">
<script src="statics/directory/vendor/flatpickr/n_flatpickr.js"></script>
<script src="statics/directory/js/myweb.js"></script>
<script type="text/javascript">
	flatpickr('.flatpickr-input', {
		enableTime: false,
		dateFormat: "m-d-Y",
		allowInput:true,
		//minDate: "today",
	});

	flatpickr('.datetime', {
		enableTime: true,
		enableSeconds:true,
		dateFormat: "Z",
		time_24hr:false,
		altFormat: 'Y-m-d h:i:s',
		allowInput:true
		//minDate: "today",
	});


	/*var cleave = new Cleave('.cleave-num', {
		numeral: true,
		numeralThousandsGroupStyle: 'thousand'
	});*/


</script>
<script>
	var chart_labels_7=[];
	for(var j=0;j<7;j++)
	{
		chart_labels_7[j]=moment().subtract(6-j, 'days').format("DD-MM-YYYY");
	}
var last_7 = document.getElementById('last_7');
var myChart_7 = new Chart(last_7, {
	maintainAspectRatio : false,
    type: 'line',
    data: {
		labels: chart_labels_7,
        datasets: [{
            label: 'Members Registered',
            data: ChartData_7,
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Members Registered in 7 days'
        }
    }
});

var chart_labels=[];
for(var i=0;i<30;i++)
{
	chart_labels[i]=moment().subtract(29-i, 'days').format("DD-MM-YYYY");
}

var last_30 = document.getElementById('last_30');
var myChart_30 = new Chart(last_30, {
	maintainAspectRatio : false,
    type: 'line',
    data: {
		labels: chart_labels,
        datasets: [{
            label: 'Members Registered',
            data: ChartData_30,
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Members Registered in 30 days'
        }
    }
});

var chart_labels_year=[];
	for(var k=0;k<12;k++)
	{
		chart_labels_year[k]=moment().subtract(11-k, 'months').format("MM-YYYY");
	}
var last_year = document.getElementById('last_year');
var myChart_year = new Chart(last_year, {
	maintainAspectRatio : false,
    type: 'line',
    data: {
		labels: chart_labels_year,
        datasets: [{
            label: 'Members Registered',
            data: ChartData_year
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Members Registered in a year'
        }
    }
});

moment().format();

</script>