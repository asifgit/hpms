
var auto_refresh1 = setInterval(
	function (){
		fadeIn1();
	}, 1000);

var auto_refresh2 = setInterval(
	function ()
	{
		fadeOut1();
		for (var i = 0; i < 10000000; i++) 
		{
			for (var j = 0; j < 1000; j++) 
			{
				j++;
			};
			i++;

		};
		$('#load_UpdatedNotifications').load('myFooter_homeBody/myPrescribedPatients.php');
	}, 10000000000000);

function fadeIn1()
{
	$('#load_UpdatedNotifications').fadeIn('fast');
}

function fadeOut1()
{
	$('#load_UpdatedNotifications').fadeOut();
}