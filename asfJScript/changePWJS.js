function inzero()
{
	if(document.getElementById("OldPW").value=="")
	{
		if(document.getElementById("NewPW1").value=="")
		{
			if(document.getElementById("NewPW2").value=="")
			{
				document.getElementById("txtInFrntOfPW").innerHTML="";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				document.getElementById("txtInFrntOfPW").innerHTML="";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
		}
		else
		{
			if(document.getElementById("NewPW2").value=="")
			{
				document.getElementById("txtInFrntOfPW").innerHTML="";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				document.getElementById("txtInFrntOfPW").innerHTML="";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				if(document.getElementById("NewPW1").value==document.getElementById("NewPW2").value)
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #00FF00; border-color: #d6e9c6; padding-top:8px;'><span class='label label-success'>Passwords matched</span></div>";
				}
				else
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top: 8px;'><span class='label label-important'>Confirm correctly</span></div>";
				}
			}
		}
		document.getElementById("chngpwbtn").disabled=true;
	}
	else
	{
		if(document.getElementById("NewPW1").value=="")
		{
			if(document.getElementById("NewPW2").value=="")
			{
				if(myPW22!=document.getElementById("OldPW").value)
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
				else
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				document.getElementById("txtInFrntOfPW").innerHTML="";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			document.getElementById("chngpwbtn").disabled=true;
		}
		else
		{
			if(document.getElementById("NewPW2").value=="")
			{
				if(myPW22!=document.getElementById("OldPW").value)
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
				else
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
				if(document.getElementById("OldPW").value==document.getElementById("NewPW1").value)
				{	document.getElementById("txtInFrntOfPW1").innerHTML="<div style='color: #FFFF00; border-color: #eed3d7; padding-top:8px;'><span class='label label-warning'>Old = New (Not Suggested)</span></div>";	}
				else
				{	document.getElementById("txtInFrntOfPW1").innerHTML="";		}
				document.getElementById("txtInFrntOfPW2").innerHTML="";
				document.getElementById("chngpwbtn").disabled=true;
			}
			else
			{
				$oldppp=false, $newsppp=false;
				if(myPW22!=document.getElementById("OldPW").value)
				{
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
					$oldppp=false;
				}

				else
				{
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
					$oldppp=true;
				}
				if(document.getElementById("OldPW").value==document.getElementById("NewPW1").value)
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="<div style='color: #FFFF00; border-color: #eed3d7; padding-top:8px;'><span class='label label-warning'>Old = New (Not Suggested)</span></div>";
				}
				else
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="";
				}
				if(document.getElementById("NewPW1").value==document.getElementById("NewPW2").value)
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #00FF00; border-color: #d6e9c6; padding-top:8px;'><span class='label label-success'>Passwords matched</span></div>";
					$newsppp=true;
				}
				else
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top: 8px;'><span class='label label-important'>Confirm correctly</span></div>";
					$newsppp=false;
				}
				if($oldppp==true && $newsppp==true)
					document.getElementById("chngpwbtn").disabled=false;
				else
					document.getElementById("chngpwbtn").disabled=true;
			}
		}
	}
}
////
function inone_and_two()
{
	if(document.getElementById("OldPW").value=="")
	{
		if(document.getElementById("NewPW1").value=="")
		{
			if(document.getElementById("NewPW2").value=="")
			{
				document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px;'><span class='label label-important'>Please Enter Old Password</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px;'><span class='label label-important'>Please Enter Old Password</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
		}
		else
		{
			if(document.getElementById("NewPW2").value=="")
			{
				document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px;'><span class='label label-important'>Please Enter Old Password</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px;'><span class='label label-important'>Please Enter Old Password</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				if(document.getElementById("NewPW1").value==document.getElementById("NewPW2").value)
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #00FF00; border-color: #d6e9c6; padding-top:8px;'><span class='label label-success'>Passwords matched</span></div>";

				}
				else
				{	document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top: 8px;'><span class='label label-important'>Confirm correctly</span></div>";	}
			}
		}
		document.getElementById("chngpwbtn").disabled=true;
	}
	else
	{
		if(document.getElementById("NewPW1").value=="")
		{
			if(document.getElementById("NewPW2").value=="")
			{
				if(myPW22!=document.getElementById("OldPW").value)
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
				else
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			else
			{
				if(myPW22!=document.getElementById("OldPW").value)
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
				else
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
				document.getElementById("txtInFrntOfPW1").innerHTML="";
				document.getElementById("txtInFrntOfPW2").innerHTML="";
			}
			document.getElementById("chngpwbtn").disabled=true;
		}
		else
		{
			if(document.getElementById("NewPW2").value=="")
			{
				if(myPW22!=document.getElementById("OldPW").value)
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
				else
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
				if(document.getElementById("OldPW").value==document.getElementById("NewPW1").value)
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="<div style='color: #FFFF00; border-color: #eed3d7; padding-top:8px;'><span class='label label-warning'>Old = New (Not Suggested)</span></div>";
				}
				else
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="";
				}
				document.getElementById("txtInFrntOfPW2").innerHTML="";
				document.getElementById("chngpwbtn").disabled=true;
			}
			else
			{
				$oldppp=false, newsppp=false;
				if(myPW22!=document.getElementById("OldPW").value)
				{
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-warning'>Incorrect Old Password</span></div>";
					$oldppp=false;
				}
				else
				{
					document.getElementById("txtInFrntOfPW").innerHTML="<div style='color: #00FF00; border-color: #eed3d7; padding-top:8px; text-align:left;'><span class='label label-success'>Correct</span></div>";
					$oldppp=true;
				}
				if(document.getElementById("OldPW").value==document.getElementById("NewPW1").value)
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="<div style='color: #FFFF00; border-color: #eed3d7; padding-top:8px;'><span class='label label-warning'>Old = New (Not Suggested)</span></div>";
				}
				else
				{
					document.getElementById("txtInFrntOfPW1").innerHTML="";
				}
				if(document.getElementById("NewPW1").value==document.getElementById("NewPW2").value)
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #00FF00; border-color: #d6e9c6; padding-top:8px;'><span class='label label-success'>Passwords matched</span></div>";
					$newsppp=true;
				}
				else
				{
					document.getElementById("txtInFrntOfPW2").innerHTML="<div style='color: #8B0000; border-color: #eed3d7; padding-top: 8px;'><span class='label label-important'>Confirm correctly</span></div>";
					$newsppp=false;
				}
				if($oldppp==true && $newsppp==true)
				{
					document.getElementById("chngpwbtn").disabled=false;
				}
				else
				{
					document.getElementById("chngpwbtn").disabled=true;
				}
			}
		}
	}
}