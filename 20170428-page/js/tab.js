function setTab(name,cursel,n){
    for(var i=1;i<=n;i++){
	    var main_menu = document.getElementById(name+i);
		var sub_menu = document.getElementById('con-'+name+'-'+i); 
		main_menu.className = (i==cursel)?'hover':'';
		sub_menu.style.display = (i==cursel)?'block':'none';
	}
}