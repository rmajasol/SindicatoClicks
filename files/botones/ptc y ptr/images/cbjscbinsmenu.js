function IsAllDefined(){for(var i=0;i<arguments.length;++i){if(typeof(arguments[i])=='undefined')return false}return true}
function GetWinH(){var h=0;var a=0;if(((!document.compatMode||document.compatMode=='CSS1Compat')&&!window.opera)&&document.documentElement)a=document.documentElement;else if(document.body)a=document.body;if(a&&a.clientHeight)h=a.clientHeight;else if(IsAllDefined(window.innerWidth,window.innerHeight,document.width)){h=window.innerHeight;if(document.width>window.innerWidth)h=h-15}return h}
function GetWinW(){var w=0;var a=0;if(((!document.compatMode||document.compatMode=='CSS1Compat')&&!window.opera)&&document.documentElement)a=document.documentElement;else if(document.body)a=document.body;if(a&&a.clientWidth)w=a.clientWidth;else if(IsAllDefined(window.innerWidth,window.innerHeight,document.height)){w=window.innerWidth;if(document.height>window.innerHeight)w=w-15}return w}
function GetObjectRect(a){var x=0;var y=0;var o=a;while(a){x+=parseInt(isNS4?a.pageX:a.offsetLeft);y+=parseInt(isNS4?a.pageY:a.offsetTop);if(a.style&&(a.style.position=='absolute'||a.style.position=='relative'))break;a=a.offsetParent}a=o;var w=0;var h=0;if(isOp&&!isOp7)w=a.style.pixelWidth;else if(isNS4)w=a.clip.width;else w=a.offsetWidth;if(isOp&&!isOp7)h=a.style.pixelHeight;else if(isNS4)h=a.clip.height;else h=a.offsetHeight;return{'x':x,'y':y,'w':w,'h':h}}
function LoadSrcImage(a){var b=new Image();b.src=a;return b}
function GetBrowserInfo(){isDOM=document.getElementById;isMz=isDOM&&(navigator.appName=="Netscape");isOp=isDOM&&window.opera;isIE=document.all&&document.all.item&&!isOp;isNS4=document.layers;isOp7=isOp&&document.readyState}
function GetViewRect(){var y=0;var x=0;if(isNS4||isMz||isOp){x=window.pageXOffset;y=window.pageYOffset}else{var a=(document.compatMode=='CSS1Compat'&&!isMz)?document.documentElement:document.body;x=a.scrollLeft;y=a.scrollTop}return{'x':x,'y':y,'w':GetWinW(),'h':GetWinH()}}
function SetElemOpacity(a,b){if(a&&a.style){if(b==1){a.style.opacity=(/Gecko/.test(navigator.userAgent)&&!/Konqueror|Safari|KHTML/.test(navigator.userAgent))?0.999999:null;if(/MSIE/.test(navigator.userAgent))if(a.style['filter'])a.style['filter']=a.style['filter'].replace(/alpha\([^\)]*\)/gi,'')}else{if(b<0.00001)b=0;a.style['opacity']=b;if(/MSIE/.test(navigator.userAgent)){a.style['filter']=(a.style['filter']?a.style['filter'].replace(/alpha\([^\)]*\)/gi,''):'')+'alpha(opacity='+b*100+')'}}}}
function ebmCreateMenuDiv(a,b){var c=document.createElement('div');c.id=a;c.className=b;c.style.position='absolute';if(ebmFadeEffect)SetElemOpacity(c,0);else if(cbnMenuAlpha)SetElemOpacity(c,cbnMenuAlpha);c.ebmFadeEffect=ebmFadeEffect;c.cbnMenuAlpha=cbnMenuAlpha;return c}
function ebmCreateShadowDiv(a,b){var c=ebmCreateMenuDiv(a,b);if(ebmFadeEffect)SetElemOpacity(c,0);else if(cbnMenuAlpha)SetElemOpacity(c,cbnMenuAlpha/2);else SetElemOpacity(c,0.5);return c}
function ebmTickerOn(a){for(var m=a;m;m=m.openSubmenuDiv)if(!m.ticker&&m.id)m.ticker=setTimeout('ebmRemoveSubmenu("'+m.id+'");',350)}
function ebmTickerOff(a){for(var m=a;m;m=m.upperTR?m.upperTR.menuDiv:0)if(m.ticker)m.ticker=clearTimeout(m.ticker)}
function ebmMenuPosY(a,b,c,d,H,e){var f=5;var y=c;var g=H;var h=e;if(g>b-2*f){y=f+a;g=b-2*f}else{if(h==-1)y=c+d-g;else y=c;if(y<a+f){y=a+f;h=1}if(y+H>b+a-f){y-=y+g-(b+a-f);h=-1}}return{'y':y,'direction':h,'size':g}}
function ebmMenuPosX(a,b,c,d,W,e){var f=5;var x=c;var g=W;var h=e;if(((h>=0)&&(c+d+W>b+a-f))||((h<0)&&(c-W<f))){if(c-a>b+a-(c+d))h=-1;else h=1}if(h>=0){x=c+d;if(b+a-f-x<g)g=b+a-f-x}else{x=c-g;if(x-a<f){x=a+f;g=c-(a+f)}}return{'x':x,'direction':h,'size':g}}
function ebmFade(a){var m=document.getElementById(a);if(m){m.cbnOpacity+=0.1;SetElemOpacity(m,m.cbnOpacity);if(m.shadowDiv1&&m.shadowDiv2){var b=m.cbnOpacity/2;SetElemOpacity(m.shadowDiv1,b);SetElemOpacity(m.shadowDiv2,b)}if(m.ebmFadeTimer){clearTimeout(m.ebmFadeTimer);m.ebmFadeTimer=null;if(m.cbnOpacity<(m.cbnMenuAlpha?m.cbnMenuAlpha:1)){var c='ebmFade("'+a+'");';if(!m.ebmFadeTimer)m.ebmFadeTimer=setTimeout(c,20)}}}}
function ebmDisplaySubmenu(a,b,c){var m=document.getElementById(a);if(m&&m.style){if(m.style.visibility=='visible'){ebmTickerOff(m);return}m.style.left='0px';m.style.top='0px';m.style.height='auto';m.style.width='auto';if(!m.depth&&(cbnOpenTopMenu!=m))ebmRemoveSubmenu(cbnOpenTopMenu.id);if(b&&b.menuDiv&&b.menuDiv.openSubmenuDiv)ebmRemoveSubmenu(b.menuDiv.openSubmenuDiv.id);if(m.depth>0){m.cbnDirectionX=m.upperTR.menuDiv.cbnDirectionX;m.cbnDirectionY=m.upperTR.menuDiv.cbnDirectionY}else{m.cbnDirectionX=1;m.cbnDirectionY=1}m.style.overflow='visible';var p=b;if(p.tagName&&p.tagName.toLowerCase()=='a')p=p.parentNode;var d=GetObjectRect(p);var e=GetObjectRect(m);var f=GetViewRect();var g;if(c){g=ebmMenuPosY(f.y,f.h,d.y,d.h,e.h,m.cbnDirectionY)}else{g=ebmMenuPosX(f.y,f.h,d.y,d.h,e.h,m.cbnDirectionY);g.y=g.x}m.cbnDirectionY=g.direction;if(g.size<e.h){if(isOp&&!m.OrigWidth)m.OrigWidth=m.clientWidth;m.style.overflow='auto';if(isIE){m.style.width=(m.offsetWidth+18)+'px';m.style.overflowX='visible'}else if(isMz)m.style.magrinRight=20;m.style.height=g.size+'px';m.scrollTop=0;m.scrollLeft=0;if(isOp)m.style.width=m.OrigWidth+'px'}m.style.top=g.y-e.y+'px';e=GetObjectRect(m);if(c){g=ebmMenuPosX(f.x,f.w,d.x,d.w,e.w,m.cbnDirectionX)}else{g=ebmMenuPosY(f.x,f.w,d.x,d.w,e.w,m.cbnDirectionX);g.x=g.y}m.cbnDirectionX=g.direction;if((g.size<e.w)&&(m.cbnDirectionX>0))g.x=g.x-(e.w-g.size);m.style.left=g.x-e.x+'px';if(m.ebmFadeEffect){if(!m.ebmFadeTimer){var h='ebmFade("'+a+'");';m.cbnOpacity=0;m.ebmFadeTimer=setTimeout(h,20)}}if(!m.depth){cbnOpenTopMenu=m}else{b.menuDiv.openSubmenuDiv=m;b.MakeExpanded()}if(m.shadowDiv1&&m.shadowDiv1.style&&m.shadowDiv2&&m.shadowDiv2.style){e=GetObjectRect(m);m.shadowDiv1.style.left=e.x+ShadowOffsetX;m.shadowDiv1.style.top=e.y+e.h;m.shadowDiv1.style.width=e.w;m.shadowDiv1.style.height=ShadowOffsetY;m.shadowDiv1.style.visibility='visible';m.shadowDiv2.style.left=e.x+e.w;m.shadowDiv2.style.top=e.y+ShadowOffsetY;m.shadowDiv2.style.width=ShadowOffsetX;m.shadowDiv2.style.height=e.h-ShadowOffsetY;m.shadowDiv2.style.visibility='visible'}m.style.visibility='visible'}}
function ebmRemoveSubmenu(a){var m=document.getElementById(a);if(m&&(m.style.visibility=='visible')){if(m.openSubmenuDiv){ebmRemoveSubmenu(m.openSubmenuDiv.id)}if(m.shadowDiv1&&m.shadowDiv1.style)m.shadowDiv1.style.visibility='hidden';if(m.shadowDiv2&&m.shadowDiv2.style)m.shadowDiv2.style.visibility='hidden';m.style.visibility='hidden';m.openSubmenuDiv=0;m.RemoveSelection();if(m.upperTR){m.upperTR.MakeNormal()}if(m.ticker){clearTimeout(m.ticker);m.ticker=null}if(m.ebmFadeEffect){SetElemOpacity(m,0);if(m.shadowDiv1&&m.shadowDiv2){SetElemOpacity(m.shadowDiv1,0);SetElemOpacity(m.shadowDiv2,0)}if(m.ebmFadeTimer){clearTimeout(m.ebmFadeTimer);m.ebmFadeTimer=null}}}}
function ebmGenerateTree(b,c,d,e){var f=document.getElementById('BtnMenuContainer'+ebmMenuName);var g=ebmCreateMenuDiv(b.id+'mdiv',e);f.appendChild(g);if(useShadow){var h=ebmCreateShadowDiv(b.id+'sdiv1',e+'_shadow');f.appendChild(h);g.shadowDiv1=h;h.style.zIndex=100+d*3;var l=ebmCreateShadowDiv(b.id+'sdiv2',e+'_shadow');f.appendChild(l);g.shadowDiv2=l;l.style.zIndex=101+d*3}g.upperTR=c;g.depth=d;g.openSubmenuDiv=0;g.style.zIndex=102+g.depth*3;g.RemoveSelection=function(){for(var i=0;i<this.childNodes[0].rows.length;i++){var a=this.childNodes[0].rows[i];if(a.tagName&&a.tagName.toLowerCase()=='tr'){a.className=a.className.replace('hot','')}}};g.onmouseover=function(){meDoMouseOver(this)};g.onmouseout=function(){meDoMouseOut(this)};var m=document.createElement('table');g.appendChild(m);m.cellSpacing=0;var n=/^([a-zA-Z]*?\:\/\/)?[^\(\)\:]*?(\?.*)?$/;for(var j=0;j<b.childNodes.length;j++){var o=b.childNodes[j];if(o.tagName&&o.tagName.toLowerCase()=='li'){var p=m.insertRow(-1);p.menuDiv=g;p.MakeExpanded=function(){this.className=this.className+' expanded'};p.MakeNormal=function(){this.className=this.className.replace('expanded','')};p.className=o.className;var q=null;var r=null;var s=null;var t=null;for(var k=0;k<o.childNodes.length;k++){var u=o.childNodes[k];if(u.tagName&&u.tagName.toLowerCase()=='a'){s=u}else if(u.tagName&&u.tagName.toLowerCase()=='span'&&u.className&&u.className.substr(0,8)=='ebul_img'){if(!s){if(!r)r=u}}else if(u.tagName&&u.tagName.toLowerCase()=='img'){if(!s){if(!q)q=u}}else if(u.tagName&&u.tagName.toLowerCase()=='ul'){t=u}}if(s!=null||q!=null||r!=null||t!=null){var v=p.insertCell(-1);v.style.borderRightWidth='0px';v.style.paddingRight='2px';if(q)v.appendChild(q);else if(r)v.appendChild(r);else v.innerHTML='&nbsp;';var w=p.insertCell(-1);w.style.borderRightWidth='0px';w.style.borderLeftWidth='0px';w.style.paddingRight='4px';w.style.paddingLeft='4px';if(s){w.appendChild(s);if(s.href&&s.href.match(n)){p.rowClickLink=s.href;p.onclick=function(){window.location.href=this.rowClickLink}}}else w.innerHTML='&nbsp;';var x=p.insertCell(-1);x.style.borderLeftWidth='0px';x.style.paddingLeft='4px';if(t){if(markerSymbol){x.innerHTML='<a style="text-decoration: none;">'+markerSymbol+'</a>'}else{x.innerHTML='&nbsp;'}p.cbnTRSubmenuId=ebmGenerateTree(t,p,d+1,e)}else{x.innerHTML='&nbsp;'}p.onmouseover=function(){this.menuDiv.RemoveSelection();this.className=this.className+' hot';if(this.cbnTRSubmenuId)ebmDisplaySubmenu(this.cbnTRSubmenuId,this,1);else if(this.menuDiv.openSubmenuDiv)ebmTickerOn(this.menuDiv.openSubmenuDiv)};p.onmouseout=function(){this.menuDiv.RemoveSelection()}}else{var y=p.insertCell(-1);var z=document.createElement('div');y.colSpan=3;y.appendChild(z)}}}return g.id}
function meDoMs(a){su=a.substring(0,a.length-1);if(document['ebb'+su])document['ebb'+su].src=window['ebb'+a].src;return false}
function meDoShow(a,b,c){ebmDisplaySubmenu('ebul_'+a+'mdiv',c,b)}
function meDoMouseOut(a){if(a)ebmTickerOn(cbnOpenTopMenu)}
function meDoMouseOver(a){if(a)ebmTickerOff(a)}
function InitEasyMenu(){GetBrowserInfo();var a=document.getElementsByTagName('img');for(var i=0;i<a.length;i++){if(a[i].id&&a[i].id.substring(0,4)=='cbi_'&&a[i].parentNode&&a[i].parentNode.tagName&&a[i].parentNode.tagName.toLowerCase()=='a'){var b=a[i].parentNode;if(b.parentNode&&b.parentNode.parentNode&&b.parentNode.parentNode.parentNode&&b.parentNode.parentNode.parentNode.parentNode){var c=b.parentNode.parentNode.parentNode.parentNode;if(c.tagName&&c.tagName.toLowerCase()=='table'&&c.id==InitTable){b.buttonnumber=a[i].id.substring(4);b.ebmMenuDirection=ebmMenuDirection;b.onmouseover=function(){meDoMs(this.buttonnumber+"o");ebmTickerOff(cbnOpenTopMenu);meDoShow(this.buttonnumber,this.ebmMenuDirection,this)};b.onmouseout=function(){meDoMs(this.buttonnumber+"n");meDoMouseOut(this)};b.onmouseup=function(){meDoMs(this.buttonnumber+"o")};b.onmousedown=function(){meDoMs(this.buttonnumber+"c")}}}}}document.write('<div id="BtnMenuContainer'+ebmMenuName+'"></div>');var d=document.getElementsByTagName('ul');for(var i=0;i<d.length;i++){if(d[i].id&&d[i].id.substring(0,5)=='ebul_'&&d[i].className.substring(0,5)=='ebul_'){ebmGenerateTree(d[i],0,0,d[i].className)}}}var cbnOpenTopMenu=0;ebbcbinsmenu_1n = LoadSrcImage('images/ebbtcbinsmenu1_0.png');ebbcbinsmenu_1o = LoadSrcImage('images/ebbtcbinsmenu1_1.png');ebbcbinsmenu_1c = LoadSrcImage('images/ebbtcbinsmenu1_2.png');ebbcbinsmenu_2n = LoadSrcImage('images/ebbtcbinsmenu2_0.png');ebbcbinsmenu_2o = LoadSrcImage('images/ebbtcbinsmenu2_1.png');ebbcbinsmenu_2c = LoadSrcImage('images/ebbtcbinsmenu2_2.png');var markerSymbol = "&raquo;";var ShadowOffsetX = 2; var ShadowOffsetY = 2; var useShadow = false;var InitTable = "cbinsmenuebul_table";var cbnMenuAlpha = 0;var ebmFadeEffect = true;var ebmMenuDirection = 0;var ebmMenuName = "cbinsmenu";InitEasyMenu();