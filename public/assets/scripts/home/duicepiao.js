
//----------漂浮 by www.duice.net-----------
var piaofu_el;
function duicepiao_piaofoHide()
{
	piaofu_el.style.display="none";

}
//调用flash中的命令 begin
function piaofu_DoFSCommand(command,args){
		if (command == "quit"){
			document.getElementById("cz_Large_flash").style.display="none";
		}
}

if (document.getElementById){
		document.writeln('<Script language="JavaScript" For="paiofu" Event="FSCommand(command,args)">');
		document.writeln('	paiofu_DoFSCommand(command,args);');
		document.writeln('</Script>');

}
function duicepiao_chinaFloating(ell)
{
var el=ell;
var w=120;
var h=80;
 var img=el.getElementsByTagName("img");
 if(img[0]!=null){
 w=img[0].getAttribute("width");
 h=img[0].getAttribute("height");
 }
 var obj=el.getElementsByTagName("object");
 if(obj[0]!=null)
 {
	 w=obj[0].getAttribute("width");
 h=obj[0].getAttribute("height");
	 }
if(w==null||h==null)
{
	w=120;
	h=80;
	}
 el.style.width=w+"px";
 el.style.height=h+"px";
 el.style.backgroundColor="#CCCCCC";
el.innerHTML="<div style='' >"+el.innerHTML+"</div><div id='piaofu_close' style='color:#333333; background-color: #CCCCCC; font-size: 10px;text-align:center; border:dashed;border-width:0' onclick='duicepiao_piaofoHide();return false;'><a style=\"font-size: 12px; color: rgb(0, 0, 0); text-decoration: none;\"  target=\"_self\" href=\"#\">关闭</a></div>";
if(!document.all){
el.style.height=Number(el.offsetHeight+12)+"px";
}
el.style.zIndex=100;
el.style.position="absolute";

el.style.left=Number(document.body.clientWidth-el.offsetWidth-1)+"px";
el.style.top=Number(document.documentElement.scrollTop+document.documentElement.clientHeight-20-el.offsetHeight-2)+"px";
piaofu_el=el;
setTimeout("duicepiao_piaofuChange()",50);
}
function duicepiao_piaofuChange()
{
var el=piaofu_el;
el.style.left=Number(document.body.clientWidth-el.offsetWidth-1)+"px";
el.style.top=Number(document.documentElement.scrollTop+document.documentElement.clientHeight-20-el.offsetHeight-2)+"px";
setTimeout("duicepiao_piaofuChange()",50);
}
//漂浮 单个接口
function duicepiao_piaofu(apcode)
{
	var el=document.getElementById(apcode);
	var adid=el.getAttribute("adid");

	if(adid/5>1){
		duicepiao_piaofulunbo(apcode);
	}else{
		var adidObj = document.getElementById(adid);
		adidObj.style.visibility = "visible";
		adidObj.style.display="block";
		duicepiao_chinaFloating(el);
	}
}
//漂浮广告轮播接口函数
function duicepiao_piaofulunbo(apcode)
{
	var obj=new Object();
	var el=document.getElementById(apcode);
	el.style.visibility = "hidden";

	var adid=el.getAttribute("adid");
	var arr=new Array();
	var rnum =Math.round(Math.random()*100);
	for(i=0;i<adid.length/5;i++)
	{

		var min = 100/(adid.length/5)*(i);
		var max = 100/(adid.length/5)*(i+1);

		if(rnum <= max && rnum >=min){
			var adidStr = adid.substr(i*5,5);
			var adidObj = document.getElementById(adidStr);
			adidObj.style.visibility = "visible";
			adidObj.style.display="block";
			duicepiao_chinaFloating(adidObj);
		}else{
			var adidStr = adid.substr(i*5,5);
			var adidObj = document.getElementById(adidStr);
			adidObj.style.visibility = "hidden";
			adidObj.style.display="none";
		}
	}

}
