<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>壹仓优品电视平台</title>
</head>
<body>
<div id="soli"></div>
<script src="http://cdn.staticfile.org/jquery/1.8.3/jquery.min.js"></script>
<style>
    *{margin: 0;padding: 0;}
    html,body{width: 100%;height: 100%;}
    #soli{width: 100%;height: 100%;position: relative;}
    .pic,.video{
        position: absolute;
        top: 0;
        left:0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .pic img{width: 100%;}
    .video {height: 0;}
    .video video{width: 100%; margin: 0 auto;display: block;}
</style>
<script>
    var html = '';
    var setTimeoutId=[];//播放节目内容的计时器
    var setTimeoutListId=[];//节目列表的计时器
    var intervalID=0;//当前循环播放的节目的句柄
    var timeCount = 0;//当前循环播放的节目的内容总时间
    // var timeOver = 0;
    var times=0;//当前节目循环次数
    var update=0;
    var newupdate=10000;
    var nowtime=0;//服务器当前时间
    var resultData={};
    var startTimes=[];//节目的开始时间数组
    var nowdate=new Date();
    nowtime=nowdate.getHours()*3600+nowdate.getMinutes()*60+nowdate.getSeconds();
    $(function () {
        console.log("kaishi");
        $.ajax({
            url:"http://tv.yicangyoupin.com/index.php?r=app/tv/tvdl",
            type:"get",
            success:function (result,status,xhr) {
                // console.log(result);
                // nowtime=result.nowtime;
                nowtime=43210;
                console.log('nowtime:'+nowtime);
                resultData=result;
                var length=resultData.length;
                var ListTimeCount=0;
                //获取当前应该播放的节目和内容
                var once=0;
                startTimes=zhuanghuan(resultData);
                console.log('startTimes:'+startTimes[length-1]);
                for (var a = 0; a < length; a++) {
                    var nowResult;//当前节目序号
                    console.log("a:"+a);
                    if(nowtime<startTimes[a] && nowtime>startTimes[0]){//
                        console.log("得到第一个大于的开始时间了");
                        if(once===0){
                            nowResult=a-1;
                            // console.log(resultData[nowResult].data);
                            console.log("节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                            setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                            once++;
                            if(a === length-1){//最后一次再加一个
                                nowResult=a;
                                ListTimeCount=(startTimes[a]-nowtime)*1000;
                                console.log("最后节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                                // console.log(resultData[nowResult].data);
                                setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                                once++;
                            }
                        }else{
                            // nowResult=resultData[a-1].data;
                            nowResult=a-1;
                            ListTimeCount=(startTimes[a-1]-nowtime)*1000;
                            console.log("节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                            // console.log(resultData[nowResult].data);
                            setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                            once++;
                            if(a === length-1){//最后一次再加一个
                                nowResult=a;
                                ListTimeCount=(startTimes[a]-nowtime)*1000;
                                console.log("最后节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                                // console.log(resultData[nowResult].data);
                                setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                                once++;
                            }
                        }
                    }else if(nowtime<startTimes[0] || nowtime===startTimes[a]){//第一个节目没有开始的时候 或者当前时间等于当次播放时间
                        console.log("得到小于第一个的开始时间了");
                        // console.log("小于最小时间");
                        if(a===0){
                            nowResult=a;
                            console.log("节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                            setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                        }else{
                            // nowResult=resultData[a-1].data;
                            nowResult=a;
                            ListTimeCount=(startTimes[a]-nowtime)*1000;
                            console.log("节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                            // console.log(resultData[nowResult].data);
                            setTimeoutListId[a]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                            once++;
                        }
                    }else if(nowtime>startTimes[length-1]){//当前时间当前时间大于最后一节目开始时间
                        // console.log("小于最小时间");
                        if(a===length-1){
                            nowResult=length-1;
                            console.log(resultData[nowResult].data);
                            console.log("节目"+(nowResult+1)+"等待时间:"+ListTimeCount);
                            setTimeoutListId[length-1]=setTimeout("startNew("+nowResult+")",ListTimeCount);
                        }
                    }
                }
                // console.log("timeCount"+timeCount);
                update=newupdate;
            }
        });
        // window.setInterval(function(){
        //     $.ajax({
        //         url:"http://tv.yicangyoupin.com/web/a.json",
        //         type:"get",
        //         success:function (result,status,xhr) {
        //             nowtime=result.nowtime;
        //             // console.log(nowtime);
        //             resultData=result.alldata;
        //             //获取当前应该播放的节目和内容
        //             for (var a = 0; a < resultData.length; a++) {
        //                 if(nowtime<resultData[a].time){
        //                     nowResult=resultData[a-1].data;
        //                     console.log("时间段:"+resultData[a].time);
        //                     break;
        //                 }else if(nowtime==resultData[a].time){
        //                     nowResult=resultData[a].data;
        //                     console.log("时间段:"+resultData[a].time);
        //                     break;
        //                 }
        //             }
        //         	// console.log(nowResult);
        //             if(update===0 || newupdate!=update){
        //                 // window.clearInterval(intervalID);
        //                 // getnewlist(nowResult);
        //                 // // console.log(timeCount);
        //                 // intervalID=window.setInterval(function(){
        //                 //     setTimeoutList(nowResult);
        //                 // },timeCount);
        //                 // startNew(nowResult,timeCount);
        //                 console.log("timeCount"+timeCount);
        //                 update=newupdate;
        //                 console.log("节目变了");
        //             }else{
        //                 console.log("节目不变");
        //                 console.log("timeCount"+timeCount);
        //             }
        //              console.log(times);
        //         }
        //     });
        // },1000000000);
    });
    function imgId(id) {
        var trueId = "#"+id;
        // console.log(trueId);
        $(trueId).siblings(".pic").fadeOut(2000);
        $(trueId).fadeIn(2000);
    }
    function videoId(id,pltime,path) {
        var trueId = ".videoId_"+id;
        $(trueId).siblings(".pic").fadeOut(0);
        $(trueId).height("100%");
        // $('#videoId_'+id).height("100%");
        var video = document.getElementById('videoId_'+id);
        if(video.src===""){video.src=path;}
        video.play();
        video.addEventListener('ended', function(){
            console.log('videoId_'+id+'播放结束');
            $(trueId).height("0");
        });
        // console.log('videoId_'+id+'视频开始播放');
        // setTimeoutId.push(setTimeout('$("'+trueId+'").height("0");',pltime-50));
        // console.log('videoId_'+id+'=='+pltime+'视频暂停播放');
    }
    function startNew(result){
        window.clearInterval(intervalID);
        // console.log("开始执行了");
        // console.log(resultData[result].data);
        getnewlist(resultData[result].data);
        // console.log('下一次播放的队列时间'+timeCount);
        intervalID=window.setInterval(function(){
            setTimeoutList(resultData[result].data);
        },timeCount);
        console.log('startNew循环一次的时间'+timeCount);
    }
    function setTimeoutList(result) {
        var times;
        // for(var x in setTimeoutId){
        //     // console.log(setTimeoutId[x]);
        //     clearTimeout(setTimeoutId[x]);
        // }
        setTimeoutId.splice(0,setTimeoutId.length);//
        timeCount=0;
        // $("p").hide();
        for(var i=0;i<result.length;i++){
            if(i === 0){
                if(result[i].type==="image/jpeg"){
                    setTimeoutId[i]=setTimeout("imgId('imgId_"+i+"')",timeCount);
                }else if(result[i].type==="mp4"){
                    setTimeoutId[i]=setTimeout("videoId("+i+","+(result[i].pay_time*1000)+")",timeCount);
                    console.log('循环中'+i+'视频播放的等待时间'+timeCount);
                }
                times++;
                // console.log(setTimeoutId[i]);
            }else{
                if(result[i].type==="image/jpeg"){
                    timeCount+=(result[i-1].pay_time*1000);
                    setTimeoutId[i]=setTimeout("imgId('imgId_"+i+"')",timeCount);
                }else if(result[i].type==="mp4"){
                    timeCount+=(result[i-1].pay_time*1000);
                    setTimeoutId[i]=setTimeout("videoId("+i+","+(result[i].pay_time*1000)+")",timeCount);
                    console.log('循环中'+i+'duo视频播放的等待时间'+timeCount);
                }
                times++;
            }
        }
        // console.log(setTimeoutId);
    }
    function getnewlist(result) {
        for(var x in setTimeoutId){
            // console.log(setTimeoutId[x]);
            clearTimeout(setTimeoutId[x]);
        }
        var html = '';
        $("#soli").html("");
        timeCount=0;
        setTimeoutId.splice(0,setTimeoutId.length);
        for(var i=0;i<result.length;i++){
            if(i === 0){
                timeCount=0;
                if(result[i].type==="image/jpeg" || result[i].type==="image/png"){
                    html+="<div class='pic' id='imgId_"+i+"'><img src='"+ result[i].path+"'></div>";
                    setTimeoutId[i]=setTimeout("imgId('imgId_"+i+"')",timeCount);
                }else if(result[i].type==="mp4"){
                    html+="<div class='video videoId_"+i+"'><video id='videoId_"+i+"' controls='controls' ></video></div>";
                    setTimeoutId[i]=setTimeout("videoId("+i+","+(result[i].pay_time*1000)+",'"+(result[i].path)+"')",timeCount);
                    // console.log(i+'视频播放的等待时间'+timeCount);
                }
                if(i===result.length-1){
                    timeCount+=(result[i].pay_time*1000);
                }
            }else{
                if(result[i].type==="image/jpeg" || result[i].type==="image/png"){
                    html+="<div class='pic' id='imgId_"+i+"'><img src='"+ result[i].path+"'></div>";
                    timeCount+=(result[i-1].pay_time*1000);
                    setTimeoutId[i]=setTimeout("imgId('imgId_"+i+"')",timeCount);
                }else if(result[i].type==="mp4"){
                    html+="<div class='video videoId_"+i+"'><video id='videoId_"+i+"' controls='controls' ></video></div>";
                    timeCount+=(result[i-1].pay_time*1000);
                    setTimeoutId[i]=setTimeout("videoId("+i+","+(result[i].pay_time*1000)+",'"+(result[i].path)+"')",timeCount);
                    console.log(i+'视频播放的等待时间'+timeCount);
                }
                if(i===result.length-1){
                    timeCount+=(result[i].pay_time*1000);
                }
            }
            // console.log(timeCount);
        }
        // console.log(setTimeoutId);
        $("#soli").append(html);
    }
    function zhuanghuan(data){
        var timestrs=[];
        var time;
        var strs=[];
        for(var x in data){
            timestrs[x]=data[x].time;
        }
        for(var y in timestrs){
            strs=timestrs[y].split(":");
            startTimes[y]=parseInt(strs[0]*3600+strs[1]*60);
        }
        return startTimes;
    }
</script>
</body>
</html>