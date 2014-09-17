var map=null;
var transit=null;
window.openInfoWinFuns = null;
function mapInit()
{
    if(map == null)
    {
        map = new BMap.Map("l-map");            // 创建Map实例
    }
    
    map.centerAndZoom($('#city_id option:selected').text(), 13); //new BMap.Point(116.404, 39.915)
    search($('#address').val());
    drive($('#address').val());

}

function openInfoWindow(point,i)
{
    var marker = addMarker(point,i); //results.getPoi(i).point
    addInfoWindow(marker,results.getPoi(i),i);
}

// 添加标注
function addMarker(point, index){
  var myIcon = new BMap.Icon("http://api.map.baidu.com/img/markers.png", new BMap.Size(23, 25), {
    offset: new BMap.Size(10, 25),
    imageOffset: new BMap.Size(0, 0 - index * 25)
  });
  var marker = new BMap.Marker(point, {icon: myIcon});
  map.addOverlay(marker);
  return marker;
}
// 添加信息窗口
function addInfoWindow(marker,poi,index){

    var maxLen = 10;
    var name = null;
    if(poi.type == BMAP_POI_TYPE_NORMAL){
        name = "地址：  "
    }else if(poi.type == BMAP_POI_TYPE_BUSSTOP){
        name = "公交：  "
    }else if(poi.type == BMAP_POI_TYPE_SUBSTOP){
        name = "地铁：  "
    }
    // infowindow的标题
    var infoWindowTitle = '<div style="font-weight:bold;color:#CE5521;font-size:14px">'+poi.title+'</div>';
    // infowindow的显示信息
    var infoWindowHtml = [];
    infoWindowHtml.push('<table cellspacing="0" style="table-layout:fixed;width:100%;font:12px arial,simsun,sans-serif"><tbody>');
    infoWindowHtml.push('<tr>');
    infoWindowHtml.push('<td style="vertical-align:top;line-height:16px;width:38px;white-space:nowrap;word-break:keep-all">' + name + '</td>');
    infoWindowHtml.push('<td style="vertical-align:top;line-height:16px">' + poi.address + ' </td>');
    infoWindowHtml.push('</tr>');
    infoWindowHtml.push('<tr>');
    infoWindowHtml.push('<td colspan=2><button type="button" class="btn blue" onclick="drive(\''+poi.title+'\')">选为目的地</button></td>');
    infoWindowHtml.push('</tbody></table>');
    var infoWindow = new BMap.InfoWindow(infoWindowHtml.join(""),{title:infoWindowTitle,width:200}); 
    var openInfoWinFun = function(){
        marker.openInfoWindow(infoWindow);
        for(var cnt = 0; cnt < maxLen; cnt++){
            if(!document.getElementById("list" + cnt)){continue;}
            if(cnt == index){
                document.getElementById("list" + cnt).style.backgroundColor = "#f0f0f0";
            }else{
                document.getElementById("list" + cnt).style.backgroundColor = "#fff";
            }
        }
    }
    marker.addEventListener("click", openInfoWinFun);
    return openInfoWinFun;
}

function search(address)
{
    var local = new BMap.LocalSearch(map, {
        renderOptions:{map: map},
        onSearchComplete: function(results){
            // 判断状态是否正确
            if (local.getStatus() == BMAP_STATUS_SUCCESS){
                var s = [];
                s.push('<div style="font-family: arial,sans-serif; border: 1px solid rgb(153, 153, 153); font-size: 12px;">');
                s.push('<div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">');
                s.push('<ol style="list-style: none outside none; padding: 0pt; margin: 0pt;">');
                openInfoWinFuns = [];
                for (var i = 0; i < results.getCurrentNumPois(); i ++){
                    var marker = addMarker(results.getPoi(i).point,i);
                    var openInfoWinFun = addInfoWindow(marker,results.getPoi(i),i);
                    openInfoWinFuns.push(openInfoWinFun);
                    // 默认打开第一标注的信息窗口
                    var selected = "";
                    if(i == 0){
                        selected = "background-color:#f0f0f0;";
                        openInfoWinFun();
                    }
                    s.push('<li id="list' + i + '" style="margin: 5px 0pt; padding: 0pt 5px 0pt 3px; cursor: pointer; overflow: hidden; line-height: 17px;' + selected + '" onclick="openInfoWinFuns[' + i + ']()">');
                    s.push('<span style="width:1px;background:url(assets/img/red_labels.gif) 0 ' + ( 2 - i*20 ) + 'px no-repeat;padding-left:10px;margin-right:3px"> </span>');
                    s.push('<span style="color:#7F9FC5;text-decoration:none">' + results.getPoi(i).title.replace(new RegExp(results.keyword,"g"),'<b>' + results.keyword + '</b>') + '</span>');
                    s.push('<div style="color:#666;padding-left:20px;"> ' + results.getPoi(i).address + '</div>');
                    s.push('</li>');
                    s.push('');
                }
                s.push('</ol></div></div>');
                document.getElementById("r-result").innerHTML = s.join("");
            }
        }
    });
    local.search(address);    
}

function drive(a)
{
    transit = new BMap.DrivingRoute(map, {renderOptions: {map: map},
        onSearchComplete: function (results){
            if (transit.getStatus() != BMAP_STATUS_SUCCESS){
                return ;
            }
            var plan = results.getPlan(0);
            var d = (parseInt(plan.getDistance(false))/1000).toFixed(1);
            $('#order_distance').html(d);
            price(d);
        },
        onPolylinesSet: function(){        
            //setTimeout(function(){alert(output)},"1000");
        }
    });
    var type = $('#type').val();
    var airport = $('#airport_id  option:selected').text();
    if(type == 1)
    {
        transit.search(airport, a);
    }
    else if(type==2)
    {
        transit.search(a, airport);
    }
}

function price(d)
{
    var price = 0;
    var normal_luggage_num = parseInt($('#normal_luggage_num').val());
    var special_luggage_num = parseInt($('#special_luggage_num').val());

    if(normal_luggage_num > 0)
    {
        switch(normal_luggage_num)
        {
            case 1:
                price = 69;
                break;
            case 2:
                price = 118;
                break;
        }
        if(normal_luggage_num > 2)
        {
            price += 118+(parseInt(normal_luggage_num)-2)*29;
        }
    }
    if(special_luggage_num > 0)
    {
        price += parseInt(special_luggage_num)*89;
    }

    if(d > 40)
    {
        price += parseInt(d)-40;
    }
    $('#distance').val(d);
    $('#order_money').html(price);
}