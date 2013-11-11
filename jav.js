function clickk()
{
	var user,pass;
	user=document.getElementById('user').value;
	pass=document.getElementById('pass').value;
	if(user=="" || pass=="")
	{
		if(user=="" && pass=="")
		{
			document.getElementById('us').innerHTML='<font color="red">Requied</font>';
			document.getElementById('pw').innerHTML='<font color="red">Requied</font>';
			return false;
		}
		else
		{
			if(user=="")
			{
				document.getElementById('us').innerHTML='<font color="red">Requied</font>';
				return false;
			}
			if(pass=="")
			{
				document.getElementById('pw').innerHTML='<font color="red">Requied</font>';
				return false;
			}
		}
	}
	else
		return true;
}