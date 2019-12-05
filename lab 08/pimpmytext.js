var pimpcount = 0;

function pimpsize() {
    var size = parseInt(24 + pimpcount*2);
    $("texttopimp").style.fontSize = size + "pt";
    pimpcount++;
}

function pimpin() {
    // if (pimpcount == 0) {
    //     $("texttopimp").style.fontSize = "24pt";
    //     pimpcount++;
    // } else {
    //     var size = parseInt(24 + pimpcount*2);
    //     $("texttopimp").style.fontSize = size + "pt";
    //     pimpcount++;
    // } 
    setInterval(pimpsize, 500);
}

function bling() {
    if ($("blingcheck").checked == true) {
        $("texttopimp").style.fontWeight = "bold";
        $("texttopimp").style.color = "green";
        $("texttopimp").style.textDecoration = "underline";
        $("texttopimp").style.backgroundImage = "url('https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg')";
    } else {
        $("texttopimp").style.removeProperty("font-weight");
        $("texttopimp").style.removeProperty("color");
        $("texttopimp").style.removeProperty("text-decoration");
        $("texttopimp").style.removeProperty("background-image");
    }
}

function snoopify() {
    var textsplit = $("texttopimp").value.split('');
    for (var i=0; i<textsplit.length; i++) {
        textsplit[i] = textsplit[i].toUpperCase();
        if (textsplit[i] == ".") {
            textsplit[i] = "-izzle.";
        }
    }

    var replacedtext = textsplit.join("");
    $("texttopimp").value = replacedtext;
}
