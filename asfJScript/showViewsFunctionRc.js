function showViewsRc($numclkd)
{
	/*for (var i = 0; i < 1000000000000000000000; i++) {
			console.log("hahahahahahah");
		};*/
	//console.log("you clicked: " + $numclkd);
	var clkdItemsClass	=	document.getElementById("ptTabsHdr").childNodes[$numclkd].className;
	if(clkdItemsClass=="")
	{
		var one	=	document.getElementById("ptTabsHdr").childNodes[1].className="";
		var two	=	document.getElementById("ptTabsHdr").childNodes[3].className="";
		var tre	=	document.getElementById("ptTabsHdr").childNodes[5].className="";
		var fro	=	document.getElementById("ptTabsHdr").childNodes[7].className="";
		var fiv	=	document.getElementById("ptTabsHdr").childNodes[9].className="";		

		var HTone	=	document.getElementById("ptTabsHdr").childNodes[1].innerHTML;
		var HTtwo	=	document.getElementById("ptTabsHdr").childNodes[3].innerHTML;
		var HTtre	=	document.getElementById("ptTabsHdr").childNodes[5].innerHTML;
		var HTfro	=	document.getElementById("ptTabsHdr").childNodes[7].innerHTML;
		var HTfiv	=	document.getElementById("ptTabsHdr").childNodes[9].innerHTML;

		var HTCone	=	document.getElementById("ptTabsHdr").innerHTML;
		
		document.getElementById("ptTabsHdr").childNodes[$numclkd].className="selected";
		//var numclkdchng	=	document.getElementById("ptTabsHdr").childNodes[$numclkd].className;
		//console.log(numclkdchng);

		$dataelement1	=	document.getElementById("view1").style.display="none";
		$dataelement2	=	document.getElementById("view2").style.display="none";
		$dataelement3	=	document.getElementById("view3").style.display="none";
		$dataelement4	=	document.getElementById("view4").style.display="none";
		$dataelement5	=	document.getElementById("view5").style.display="none";
		
		switch($numclkd)
		{
			case 1 :	document.getElementById("view1").style.display="block";	console.log("clkd1: "); break;
			case 3 :	document.getElementById("view2").style.display="block"; document.getElementById("filter").focus();	console.log("clkd2: "); break;
			case 5 :	document.getElementById("view3").style.display="block"; document.getElementById("filter").focus();	console.log("clkd3: "); break;
			case 7 :	document.getElementById("view4").style.display="block"; document.getElementById("filter").focus();	console.log("clkd4: "); break;
			case 9 :	document.getElementById("view5").style.display="block"; document.getElementById("filter").focus();	console.log("clkd5: "); break;
		}
		//console.log(one+","+two+","+tre);
		//console.log(HTone+","+HTtwo+","+HTtre);
		
		//console.log($dataelement1+","+$dataelement2+","+$dataelement3);
		//console.log(HTCone);
	}
	else
	{
		//console.log("class name clicked: " + clkdItemsClass);
	}
	
}