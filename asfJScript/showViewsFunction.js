function showViewsPt($numclkd)
{
	console.log("you clicked: " + $numclkd);
	var clkdItemsClass	=	document.getElementById("ptTabsHdr").childNodes[$numclkd].className;
	if(clkdItemsClass=="")
	{
		var one	=	document.getElementById("ptTabsHdr").childNodes[1].className="";
		var two	=	document.getElementById("ptTabsHdr").childNodes[3].className="";
		var tre	=	document.getElementById("ptTabsHdr").childNodes[5].className="";
		var fur	=	document.getElementById("ptTabsHdr").childNodes[7].className="";

		var HTone	=	document.getElementById("ptTabsHdr").childNodes[1].innerHTML;
		var HTtwo	=	document.getElementById("ptTabsHdr").childNodes[3].innerHTML;
		var HTtre	=	document.getElementById("ptTabsHdr").childNodes[5].innerHTML;
		var HTfur	=	document.getElementById("ptTabsHdr").childNodes[7].innerHTML;

		var HTCone	=	document.getElementById("ptTabsHdr").innerHTML;
		
		document.getElementById("ptTabsHdr").childNodes[$numclkd].className="selected";
		//var numclkdchng	=	document.getElementById("ptTabsHdr").childNodes[$numclkd].className;
		//console.log(numclkdchng);

		$dataelement1	=	document.getElementById("view1").style.display="none";
		$dataelement2	=	document.getElementById("view2").style.display="none";
		$dataelement3	=	document.getElementById("view3").style.display="none";
		$dataelement4	=	document.getElementById("view4").style.display="none";

		switch($numclkd)
		{
			case 1 :	document.getElementById("view1").style.display="block";	console.log("clkd1: "); break;
			case 3 :	document.getElementById("view2").style.display="block";	console.log("clkd2: "); break;
			case 5 :	document.getElementById("view3").style.display="block";	console.log("clkd3: "); break;
			case 7 :	document.getElementById("view4").style.display="block";	console.log("clkd4: ");
						document.getElementById("filter").focus(); break;
		}
		console.log(one+","+two+","+tre+","+fur);
		console.log(HTone+","+HTtwo+","+HTtre+","+HTfur);
		
		console.log($dataelement1+","+$dataelement2+","+$dataelement3+","+$dataelement4);
		console.log(HTCone);
	}
	else
	{
		console.log("class name clicked: " + clkdItemsClass);
	}
	
}