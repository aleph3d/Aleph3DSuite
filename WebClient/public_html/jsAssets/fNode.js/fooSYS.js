function SYSmessage(sysmessagetype,sysmessage) {
	if(sysmessagetype == 'error') {
		document.getElementById('sysmessage').innerHTML='<h2 style=\'color: #800000; font-size: 150%;\'>'+sysmessage+'</h2><input type=\'image\' src=\'media/textures/5050t.png\' style=\'margin-top: 18px; margin-right: 10%;float: right;background-image: url('media/textures/icons.png'); background-position: -4.5px 387.5px; width: 47px; height: 47px;\' onclick=\'hideObject(\'sysmessage\');\' />';
		showObject('sysmessage');
	}
	else if (sysmessagetype = 'success') {
		document.getElementById('sysmessage').innerHTML='<h2 style=\'color: #008000; font-size: 150%;\'>'+sysmessage+'</h2><input type=\'image\' src=\'media/textures/5050t.png\' style=\'margin-top: 18px; margin-right: 10%;float: right;background-image: url('media/textures/icons.png'); background-position: -4.5px 387.5px; width: 47px; height: 47px;\' onclick=\'hideObject(\'sysmessage\');\' />';
		showObject('sysmessage');
	}
	
}
