// jshint devel:true
var gifColor = "Blue",
    gifPhrase = "Thanks",
    gifStyle = "Sans",
    gifAddy,
    grid,
    textOverlay,
    gifLength,
    textBase;

function callGif() {
  gifAddy = gifPhrase + "_" + gifColor + "_" + gifStyle;
  $("#stagedGif").attr('src', "images/" + gifPhrase + "/" + gifAddy + ".gif");
}

/** Depracated Drop-Down Controls
function colorSwitcher() {
  $("a[data-color]").click(function() {
    gifColor = $(this).data("color");
    $(".colorDD .DDLbl").html(gifColor);
    callGif();
  })
}

function styleSwitcher() {
  $("a[data-style]").click(function() {
    gifStyle = $(this).data("style");
    $(".styleDD .DDLbl").html(gifStyle);
    callGif();
  })
}

function phraseSwitcher() {
  $("a[data-phrase]").click(function() {
    gifPhrase = $(this).data("phrase");
    $(".phraseDD .DDLbl").html(gifPhrase);
    callGif();
  })
}
**/

function dragulize(palette, dropzone, attribute) {
  dragula([document.getElementById(palette), document.getElementById(dropzone)], { copy: true })
  .on('drop', function (el) {
    //gifColor = el.className.replace(" gu-transit", "");
    if(attribute == "gifColor") {
      gifColor = el.id;
    } else if (attribute == "gifPhrase") {
      gifPhrase = el.id;
    } else if (attribute == "gifStyle") {
      gifStyle = el.id;
    }
    $("#" + palette).find("div").removeClass("selectedBlock");
    var testing = el;
    $(testing).addClass("selectedBlock");
    callGif();
  });
}

function paletteClicker(palette, attribute) {
  $(palette + " div").click(function() {
    if(attribute == "gifColor") {
      gifColor = $(this).attr("id");
    } else if (attribute == "gifPhrase") {
      gifPhrase = $(this).attr("id");
    } else if (attribute == "gifStyle") {
      gifStyle = $(this).attr("id");
    }
    var theParental = $(this).parent();
    theParental.find("div").removeClass("selectedBlock");
    $(this).addClass("selectedBlock");
    callGif();
  })
}

// Gif Creator
function gifYourself(textOverlay, gifLength, textBase) {
  console.log(textBase);
  gifshot.createGIF({
    text: textOverlay,
    numFrames: gifLength * 10,
    fontSize: '24px',
    interval: 0.1,
    gifWidth: 400,
    gifHeight: 300,
    textBaseline: textBase
  }, function(obj) {
    if(!obj.error) {
        var image = obj.image,
        animatedImage = document.createElement('img');
        animatedImage.src = image;
        $("#gifself").html(animatedImage);
        $("#saveGif").show();
        $("#saveGif").attr('href', image);
    }
  });
}

$(function() {
  $("#gifshot").click(function(){
    textOverlay = $("#textOverlay").val();
    gifLength = $("#gifLength").val();
    textBase = $("#textBase").val();
    gifYourself(textOverlay, gifLength, textBase);
  });
  paletteClicker("#color-palette", "gifColor");
  paletteClicker("#style-palette", "gifStyle");
  paletteClicker("#phrase-palette", "gifPhrase");
  dragulize("color-palette", "stagedGif", "gifColor");
  dragulize("phrase-palette", "stagedGif", "gifPhrase");
  dragulize("style-palette", "stagedGif", "gifStyle");
});
