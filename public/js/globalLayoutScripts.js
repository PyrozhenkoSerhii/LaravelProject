function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }

    return text;
}

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


function translate(text) {
    $.ajax({
        type:'POST',
        url:'http://whatshappened/public/post/translate',
        data: {text:text,_token: CSRF_TOKEN},
        dataType: 'json',
        success:function(data) {

            document.getElementById("translatedContent").innerHTML  = "<h4>"+data.text.result;
            $("#robinzon").show();
            setTimeout('$("#robinzon").fadeOut("slow")', 2000);
        }
    });
}

function createDiv() {
    $('body').append("" +
        "<div id='robinzon'>" +

        "<div style='display:block;height:100%;'>" +
        "<button id='addWordButton' class='btn-warning' style='border-radius: 60%; opacity: 50%;' onclick='addWord()'><h5>+</h5></button>"+
        "<div id='translatedContent' style='display:table-cell;vertical-align:middle;width:150px;'></div>" +

        "</div>" +


        "</div>");
    $("#robinzon").css({"width": "150px",
        "height": "150px",
        "background": "none repeat scroll 0% 0% rgba(0, 0, 0, 0.5)",
        "position": "fixed",
        "display":"none",
        "top": "45%",
        "left": "45%",
        "z-index": "999",
        "text-align": "center",
        "color": "white",
        "font-family": "Segoe Ui",
        "font-size": "25px",
        "font-weight": "100",
        "padding":"10px",
        "border-radius": "85px"});
}


$(".container").mousedown(function () {
    $(".container").mouseup(function () {

        if (document.getElementById("robinzon") == null) {
            createDiv();
        }
        var textToTranslate = getSelectionText();
        document.getElementById("addWordButton").innerHTML = '+';
        document.getElementById("selectedText").innerHTML = textToTranslate;

        if (textToTranslate != "") {
            translate(textToTranslate);
        }
    });
});

$(".container").dblclick(function () {

    if (document.getElementById("robinzon") == null) {
        createDiv();
    }
    var textToTranslate = getSelectionText();
    document.getElementById("addWordButton").innerHTML = '+';
    document.getElementById("selectedText").innerHTML = textToTranslate;

    if (textToTranslate != "") {
        translate(textToTranslate);
    }
});


function addWord() {
    var word = document.getElementById("selectedText").textContent;
    var translation = document.getElementById("translatedContent").textContent;

    $.ajax({
        type:'POST',
        url:'http://whatshappened/public/dictionary/storeFromArticle',
        data: {word:word,translation:translation,_token: CSRF_TOKEN},
        dataType: 'json',
        success:function(data) {
            document.getElementById("addWordButton").innerHTML = '✓';
        }
    });


}


function addToFavorite(post_id) {

    var button = document.getElementById("favoriteButton");
    if (button.textContent == '☆') {
        button.textContent = '★';


        $.ajax({
            type:'POST',
            url:'http://whatshappened/public/post/addToFavorite',
            data: {post_id:post_id,_token: CSRF_TOKEN},
            dataType: 'json',
            success:function(data) {

            }
        });

    }else{
        button.textContent = '☆';

        $.ajax({
            type:'POST',
            url:'http://whatshappened/public/post/deleteFromFavorite',
            data: {post_id:post_id,_token: CSRF_TOKEN},
            dataType: 'json',
            success:function(data) {

            }
        });
    }
}

function showFavorite(post_id) {
    var button = document.getElementById("favoriteButton");
    $.ajax({
        type: 'POST',
        url: 'http://whatshappened/public/post/getFavorite',
        data: {post_id: post_id, _token: CSRF_TOKEN},
        dataType: 'json',
        success: function (data) {

            if (data.text == 'true') {
                button.textContent = '★';
            } else {
                button.textContent = '☆';
            }
        }
    });
}