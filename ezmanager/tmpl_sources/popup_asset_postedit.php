<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">®Postedit_video_title®</h4>
</div>
<div class="modal-body" id="myModal">

  <div id="container" style="margin: 0 auto"></div>
  <div class="container container-relative container-grey" id="videoDiv">
      <center>
          <div style="display:inline-block;width:<?php echo ($has_slides) ? '49%' : '100%'; ?>;" class="popup_video_player"
              id="Popup_Player_<?php echo $asset; ?>_cam">
              <?php
              echo '
              <video src="/ezmanager/distribute.php?action=media&amp;album='.$album.'&amp;asset='.$asset.'&amp;type=cam&amp;quality=low&amp;token='.$asset_token.'&amp;origin=embed" type="video/h264" width="100%" height="100%" id="video_cam" controlslist="nodownload">
              ';
              ?>
          </div>
          <?php if ($has_slides) {
              ?>
              <div style="display:inline-block;width: 49%;" class="popup_video_player"
              id="Popup_Player_<?php echo $asset; ?>_slide">
              <?php
              echo '
              <video src="/ezmanager/distribute.php?action=media&amp;album='.$album.'&amp;asset='.$asset.'&amp;type=slide&amp;quality=low&amp;token='.$asset_token.'&amp;origin=embed" type="video/h264" width="100%" height="100%" id="video_slide" muted controlslist="nodownload">
              ';
              ?>
          </div>
          <?php
      } ?>
    </center>
    <center>
        <div class="container-fluid container-relative container-grey">
            <div class="row centered">
                <div class="col-xs-1 centered">
                    <button type="button" id="btnPlay" class="btn">
                        <i id="btnPlayIcon" class="glyphicon glyphicon-play"></i>
                    </button>
                </div>
                <div class="col-xs-10 centered">

                    <div class="container container-relative  container-grey" id="videoSlider-container">
                        <input id="videoSlider" type="text"/><br/>
                    </div>
                </div>
                <div class="col-xs-1 centered">
                </div>
            </div>
        </div>
    </center>
</div>
<div class="container container-relative" id="curCutDiv">
    <center>
        <div class="container container-relative">
            <div class="row">
                <div class="col-sm-2"></div>
                <label class="col-sm-3" for="cutStart">debut</label>
                <div class="col-sm-2"></div>
                <label class="col-sm-3" for="cutStop">fin</label>
                <div class="col-sm-2"></div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <input class="col-sm-3" id="cutStart" type="number" name="" value="">
                <div class="col-sm-2"></div>
                <input class="col-sm-3" id="cutStop" type="number" name="" value="">
                <div class="col-sm-2"></div>
            </div>

        </div>
        <div class="container-fluid container-relative">
            <div class="row">
                <div class="col-sm-10 centered col-sm-offset-1">
                    <div class="container container-relative" id="cutSlider-container">
                        <input id="cutSlider" type="text"/><br/>
                    </div>
                </div>
                <div class="col-sm-1">

                </div>
            </div>
            <div class="row">
              <div class="col-sm-4 centered col-sm-offset-1">
                  <input class="btn" id="cutPreviewBtn" type="button" name="" value="preview">
              </div>
              <div class="col-sm-2">

              </div>
              <div class="col-sm-4 centered">
                  <input class="btn" id="cutValid" type="button" name="" value="valider la coupure">
              </div>
              <div class="col-sm-1">

              </div>
            </div>
        </div>
    </center>
</div>
<div class="container container-relative" id="cutTableDiv">

    <table id="cutTable" class="table table-striped">
      <thead>
        <tr>
          <th id="cutNumberTh">cutNumber</th>
          <th id="cutStartTh">Start</th>
          <th id="cutStopTh">end</th>
          <th id="cutModTh"></th>
          <th id="cutDelTh"></th>
        </tr>
      </thead>
      <tbody id="cutTableBody">

      </tbody>
    </table>
<input type="button" class="btn centered" id="testThisShit" name="" value="testThisShit">
</div>
<input type="hidden" id="data">
<input type="hidden" id="preview" value="0">
<input type="hidden" id="fusionValue"value="">
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">®Update®</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">®Cancel®</button>
</div>
<div class="modal fade" id="cutsFusionModal" tabindex="-1" role="dialog" aria-labelledby="cutsFusionModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id=""></h4>
      </div>
      <div class="modal-body">
          <div class="container container-relative">
              <div class="row centered">
                  <p>Vous etes sur le point de fusionner</p>
              </div>
              <div class="row centered">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>cutNumber</th>
                        <th>Start</th>
                        <th>end</th>
                      </tr>
                    </thead>
                    <tbody id="curCutBody">

                    </tbody>
                  </table>
              </div>
              <div class="row centered">
                  <p>Avec les coupures deja existantes suivantes</p>
              </div>
              <div class="row centered">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>cutNumber</th>
                        <th>Start</th>
                        <th>end</th>
                      </tr>
                    </thead>
                    <tbody id="cutFusionBody">

                    </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="cutsFusionValid">for now Close</button>
        <button type="button" class="btn" id="cutsFusionCancel">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
//video INIT

(function()
    {
    //initialisation
        var videos=document.getElementsByTagName("video");
        console.log(videos);
        var video=videos[0];
        video.addEventListener('loadedmetadata',function() {
            var allVideoPlayer = document.getElementsByTagName("video");
            var duration=allVideoPlayer[0].duration;
            var firstCut=[0,duration]
            var array=[];
            if (true) {
                //to be fill later when input from already existing cut exist
            }
            initJSON(duration,array,firstCut);
            var json=JSON.parse($("#data").val());
            initSlider(json.duration,json.cutArray,json.curCut);
            setInputsMinMax();
            updateCutTable(json.cutArray);
    //end initialisation
        });
    // $('#myModal').on('shown.bs.modal', function () {
    //     console.log("there");
    //     initJSON(duration,array,firstCut);
    //     var json=JSON.parse($("#data").val());
    //     initSlider(json.duration,json.cutArray,json.curCut);
    //     setInputsMinMax();
    //     updateCutTable(json.cutArray);
    // }),
    $("#cutStart").on('change', function() {
        var start=parseFloat($("#cutStart").val());
        var stop=parseFloat($("#cutStop").val());
        if (!(isNaN(start))&&!(isNaN(stop))) {
            var array=sortInputs(start,stop);
            setInputValue(array);
            setJSONCut(array);
            updateCutSlider(array);
        }else{
            var json=JSON.parse($("#data").val());
            setInputValue(json.curCut);
        }
    });

    $("#cutStop").on('change', function() {
        var start=parseFloat($("#cutStart").val());
        var stop=parseFloat($("#cutStop").val());
        if (!(isNaN(start))&&!(isNaN(stop))) {
            var array=sortInputs(start,stop);
            setInputValue(array);
            setJSONCut(array);
            updateCutSlider(array);
        }else{
            var json=JSON.parse($("#data").val());
            setInputValue(json.curCut);
        }
    });

    $("#btnPlay").on('click', function() {
        var allVideoPlayer = document.getElementsByTagName("video");
        if (allVideoPlayer[0].paused) {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.play();
             }
             $("#btnPlayIcon").attr('class', "glyphicon glyphicon-pause");

        }else {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.pause();
             }
             $("#btnPlayIcon").attr('class', "glyphicon glyphicon-play");
        }
    });

    $("#video_cam").on('timeupdate',function() {
        if (!$("#video_cam")[0].paused) {
            $("#videoSlider").slider('setValue',$("#video_cam")[0].currentTime,true);
        }else {
            if ($("#preview").val()==="1") {
                var json=JSON.parse($("#data").val());
                var allVideoPlayer = document.getElementsByTagName("video");
                for(var i = 0; i < allVideoPlayer.length; i++) {
                    var video = allVideoPlayer[i];
                    video.currentTime=json.curCut[0];
                 }
                 $("#videoSlider").slider('setValue',$("#video_cam")[0].currentTime,true);
                 $("#preview").val("0");
                 console.log("set to 0");
            }
        }
        console.log("preview state = " + $("#preview").val());
        if ($("#preview").val()==="1") {
            var json=JSON.parse($("#data").val());
            if($("#video_cam")[0].currentTime>json.curCut[0]&&$("#video_cam")[0].currentTime<json.curCut[1]){
                var allVideoPlayer = document.getElementsByTagName("video");
                for(var i = 0; i < allVideoPlayer.length; i++) {
                    var video = allVideoPlayer[i];
                    video.currentTime=json.curCut[1];
                 }
            }
            else if ($("#video_cam")[0].currentTime>(json.curCut[1]+10)) {
                var allVideoPlayer = document.getElementsByTagName("video");
                for(var i = 0; i < allVideoPlayer.length; i++) {
                    var video = allVideoPlayer[i];
                    video.pause();
                    video.currentTime=json.curCut[0];
                 }
                 $("#preview").val("0");
                 $("#videoSlider").slider('setValue',$("#video_cam")[0].currentTime,true);
                 console.log("test");
            }
        }
    });
    $("#videoSlider").on('change', function(e)
    {
        var newTime=$("#videoSlider").slider('getValue');
        var allVideoPlayer = document.getElementsByTagName("video");
        if (!allVideoPlayer[0].paused) {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.pause();
             }
             $("#btnPlayIcon").attr('class', "glyphicon glyphicon-play");
        }
        for(var i = 0; i < allVideoPlayer.length; i++) {
            var video = allVideoPlayer[i];
            video.currentTime=newTime;
         }
    });
    $("#cutTable").on('click','.modBtn',function(event) {
        var json=JSON.parse($("#data").val());
        var index=parseInt(this.id.substring(6,7));
        var tArray=json.cutArray;
        console.log("tArray "+tArray[0]);
        json.curCut=json.cutArray[this.id.substring(6,7)];
        tArray.splice(index,1);
        json.cutArray=tArray;
        myJson=JSON.stringify(json);
        $("#data").val(myJson);
        setInputValue(json.curCut);
        $("#cutSlider").slider('destroy');
        initSlider(json.duration,json.cutArray,json.curCut);
        updateCutTable(json.cutArray);

    }).on('click','.delBtn',function(event) {
        var json=JSON.parse($("#data").val());
        var index=parseInt(this.id.substring(6,7));
        var tArray=json.cutArray;
        console.log("tArray "+tArray[0]);
        tArray.splice(index,1);
        json.cutArray=tArray;
        myJson=JSON.stringify(json);
        $("#data").val(myJson);
        setInputValue(json.curCut);
        $("#cutSlider").slider('destroy');
        initSlider(json.duration,json.cutArray,json.curCut);
        updateCutTable(json.cutArray);

    });
    $("#cutPreviewBtn").on('click', function() {
        $("#preview").val("1");
        var json=JSON.parse($("#data").val());
        // var prevTime=$("#video_cam")[0].currentTime;
        var allVideoPlayer = document.getElementsByTagName("video");
        // console.log(allVideoPlayer);
        if (allVideoPlayer[0].paused) {
            var start=(json.curCut[0]-5);
            if (start<0) {
                start=0;
            }
            for(var i = 0; i < allVideoPlayer.length; i++) {

                var video = allVideoPlayer[i];
                console.log(video);
                video.currentTime=start;
                video.play();
             }
        } else {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.pause();

                video.currentTime=json.curCut[0];

             }
             $("#preview").val("0");
        }
    });
    $("#cutsFusionModal").on('shown.bs.modal', function(event) {
        console.log("modal show");
        var json=JSON.parse($("#data").val());
        var fusionJson=JSON.parse($("#fusionValue").val());
        updateFusionTable(json.curCut,fusionJson.cutFusionArray);
    });
    $("#cutValid").on('click', function() {
        console.log("appel");
        var test = false;
        var intersectedCut=[];
        var json=JSON.parse($("#data").val());
        if ((json.curCut[0]!=json.curCut[1])&&!(isNaN(json.curCut[0]))&&!(isNaN(json.curCut[0]))&&(typeof json.curCut[0]!=undefined)&&(typeof json.curCut[1]!=undefined)&&(json.curCut[0]!=null)&&(json.curCut[1]!=null)) {


            var tArray=[];
            for (var i = 0; i < json.cutArray.length; i++) {
                if ((json.curCut[0]>=json.cutArray[i][0]&&json.curCut[0]<=json.cutArray[i][1])||(json.curCut[1]>=json.cutArray[i][0]&&json.curCut[1]<=json.cutArray[i][1])||(json.curCut[0]<=json.cutArray[i][0]&&json.curCut[1]>=json.cutArray[i][1])) {
                    console.log("intersection avec le cut numero "+(i+1));
                    intersectedCut.push(i);
                }
            }
            console.log(intersectedCut);
            if (intersectedCut.length!=0) {
                // for (var i = 0; i < intersectedCut.length; i++) {
                //     tArray.push(json.cutArray[intersectedCut[i]]);
                // }
                // updateFusionTable(json.curCut,tArray);

                var fusionJson=JSON.parse('{"cutFusionArray":[]}');
                for (var i = 0; i < intersectedCut.length; i++) {
                    var curTArray=[intersectedCut[i],json.cutArray[intersectedCut[i]][0],json.cutArray[intersectedCut[i]][1]];
                    fusionJson.cutFusionArray.push(curTArray);

                }
                console.log("json fusion");
                console.log(fusionJson);
                $("#fusionValue").val(JSON.stringify(fusionJson));

                $("#cutsFusionModal").modal();
                // for (var i = 0; i < intersectedCut[0]; i++) {
                //     tArray.push(json.cutArray[i]);
                // }
                // var cutToValid=[];
                // if (json.curCut[0]<json.cutArray[intersectedCut[0]][0]) {
                //     cutToValid.push(json.curCut[0]);
                // }else{
                //     cutToValid.push(json.cutArray[intersectedCut[0]][0]);
                // }
                // if (json.curCut[1]>json.cutArray[intersectedCut[(intersectedCut.length-1)]][1]) {
                //     cutToValid.push(json.curCut[1]);
                // } else {
                //     cutToValid.push(json.cutArray[intersectedCut[(intersectedCut.length-1)]][1]);
                // }
                // tArray.push(cutToValid);
                // for (var i = (intersectedCut[(intersectedCut.length-1)]+1); i < json.cutArray.length; i++) {
                //     tArray.push(json.cutArray[i]);
                // }
                // console.log(tArray);
            }else{
                var inserted = false;
                for (var i = 0; i < json.cutArray.length; i++) {
                    if ((json.curCut[0]<json.cutArray[i][0])&&!inserted) {
                        tArray.push(json.curCut);
                        inserted=true;
                    }
                    tArray.push(json.cutArray[i]);
                }
                if (!inserted) {
                    tArray.push(json.curCut);
                }
                console.log(tArray);
                json.cutArray=tArray;
                json.curCut=[0,json.duration]
                myJson=JSON.stringify(json);
                $("#data").val(myJson);
                setInputValue(json.curCut);
                $("#cutSlider").slider('destroy');
                initSlider(json.duration,json.cutArray,json.curCut);
                updateCutTable(json.cutArray);
            }

        }
    });
    $("#cutSlider-container").on('slide change','#cutSlider', function()
    {
        var allVideoPlayer = document.getElementsByTagName("video");

        if ($("#cutSlider").slider('getValue')[0]!=$("#cutStart").val()) {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.currentTime=$("#cutSlider").slider('getValue')[0];
            }

        }else if ($("#cutSlider").slider('getValue')[1]!=$("#cutStop").val()) {
            for(var i = 0; i < allVideoPlayer.length; i++) {
                var video = allVideoPlayer[i];
                video.currentTime=$("#cutSlider").slider('getValue')[1];
            }
        }
        setInputValue($("#cutSlider").slider('getValue'));
        setJSONCut($("#cutSlider").slider('getValue'));
        $("#videoSlider").slider('setValue',$("#video_cam")[0].currentTime,true);
    });
    $("#testThisShit").on('click', function(event) {
        console.log("right here");
        $("#cutsFusionModal").modal();
    });
    $("#cutsFusionModal").on('click', '.close', function(event) {
        $("#cutsFusionModal").modal('hide');
    }).on('click', '#cutsFusionCancel', function(event) {
        $("#cutsFusionModal").modal('hide');
    }).on('click', '#cutsFusionValid', function(event) {
        var json=JSON.parse($("#data").val());
        var fusionJson=JSON.parse($("#fusionValue").val());
        var tArray=[];
        for (var i = 0; i < fusionJson.cutFusionArray[0][0]; i++) {
            tArray.push(json.cutArray[i]);
        }
        var cutToValid=[];
        if (json.curCut[0]<json.cutArray[fusionJson.cutFusionArray[0][0]][0]) {
            cutToValid.push(json.curCut[0]);
        }else{
            cutToValid.push(json.cutArray[fusionJson.cutFusionArray[0][0]][0]);
        }
        if (json.curCut[1]>json.cutArray[fusionJson.cutFusionArray[(fusionJson.cutFusionArray.length-1)][0]][1]) {
            cutToValid.push(json.curCut[1]);
        } else {
            cutToValid.push(json.cutArray[fusionJson.cutFusionArray[(fusionJson.cutFusionArray.length-1)][0]][1]);
        }
        tArray.push(cutToValid);
        for (var i = (fusionJson.cutFusionArray[(fusionJson.cutFusionArray.length-1)][0]+1); i < json.cutArray.length; i++) {
            tArray.push(json.cutArray[i]);
        }


        console.log(tArray);
        json.cutArray=tArray;
        json.curCut=[0,json.duration]
        myJson=JSON.stringify(json);
        $("#data").val(myJson);
        setInputValue(json.curCut);
        $("#cutSlider").slider('destroy');
        initSlider(json.duration,json.cutArray,json.curCut);
        updateCutTable(json.cutArray);
        $("#cutsFusionModal").modal('hide');
    })

})();




function initJSON(duration,array,curCut)
{
    var json=JSON.parse('{"duration":'+duration+',"cutArray":[],"curCut":['+curCut[0]+','+curCut[1]+']}');
    //test array integration to delete
    for (var i = 0; i < array.length; i++) {
        json.cutArray.push(array[i]);
    }
    myJson=JSON.stringify(json);
    $("#data").val(myJson);
}

function initSlider(duration,array,cut)
{
    //init of the cutSlider
    //console.log({ id: "cutSliderSlider",  min: 0, max: duration, range: true, step: 0.01, value: [cut[0],cut[1]],rangeHighlights: updateCutSliderBackground(array) });
    $("#cutSlider").slider({ id: "cutSliderSlider",  min: 0, max: duration, range: true, step: 0.01, value: [cut[0],cut[1]],rangeHighlights: updateCutSliderBackground(array) });
    $("#videoSlider").slider({ id: "videoSliderSlider", class: "container-grey", min: 0, max: duration, step: 0.01, value: 0});

}

function setInputValue(array)
{
    $("#cutStart").val(array[0]);
    $("#cutStop").val(array[1]);
}

function setInputsMinMax()
{
    var json = JSON.parse($("#data").val());
    $("#cutStart").attr({
       "max" : json.curCut[1],
       "min" : 0
    });
    $("#cutStop").attr({
       "max" : json.duration,
       "min" : json.curCut[0]
    });
}

function sortInputs(start,stop)
{
    if (start<=stop) {
        var array = [start,stop];
    }else {
        var array = [stop,start];
    }
    return array;
}

function setJSONCut(array)
{
    var json=JSON.parse($("#data").val());
    json.curCut[0] = array[0];
    json.curCut[1] = array[1];
    myJson = JSON.stringify(json);
    $("#data").val(myJson);
}

function updateCutSlider(array)
{
    $("#cutSlider").slider('setValue',array,true);
}

function updateCutSliderBackground(array)
{
    var tArray=[];
    for (var i = 0; i < array.length; i++) {
        var json = {
            "start":array[i][0],
            "end":array[i][1]
        };
        tArray.push(json);
    }
    return tArray;
}

function updateCutTable(array,tableField) {
    $("#cutTableBody").empty();
    for(i=0;i<array.length;i++){
      var cutNb=(i+1);
      $("#cutTableBody").append("<tr><td>"+cutNb+"</td><td>"+array[i][0]+"</td><td>"+array[i][1]+"</td><td><button type='button' id='modBtn"+i+"' class='btn modBtn'><i class='glyphicon glyphicon-edit'></i></button></td><td><button type='button' id='delBtn"+i+"' class='btn delBtn'><i class='glyphicon glyphicon-remove-sign'></i></button></td></tr>");

    }
}
function updateFusionTable(curCutArray,cutFusionArray) {
    $("#curCutBody").empty();
    $("#cutFusionBody").empty();
    $("#curCutBody").append("<tr><td>current cut</td><td>"+curCutArray[0]+"</td><td>"+curCutArray[1]+"</td></tr>");
    for(i=0;i<cutFusionArray.length;i++){
        var cutNb=((cutFusionArray[i][0])+1);
        $("#cutFusionBody").append("<tr><td>"+cutNb+"</td><td>"+cutFusionArray[i][1]+"</td><td>"+cutFusionArray[i][2]+"</td></tr>");
    }
}

//test functions
function printJSON() {
}
function testFun() {

    for (var i = 0; i < 11; i++) {
        setTimeout(function () {
            console.log(i);
        }, 1000);
    }

}

</script>
