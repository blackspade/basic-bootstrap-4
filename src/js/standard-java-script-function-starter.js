/* Basic Input Sanitation Function onblur="sanitizeText(event);" */
function sanitizeText(event){
  var str = event.target.value;
  var i = str.replace(/[&\/\\,'"?<>]/g, '');
  event.target.value = i;
}

/* Basic Email Validator */
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

/* Basic AJAX CALL Function */
function ajax_standard(){
  var xhr = new XMLHttpRequest();
  var url = '';
  xhr.open('GET',url, true);
  xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
  xhr.onreadystatechange = function(){
      if (xhr.readyState == 4 && xhr.status == 200) {
            var stream = JSON.parse(xhr.responseText);
			console.log(stream);
    }
  };
  xhr.send();
};

/*Check the Strenght of a Password*/
function passwordScore(pass) {
    var score = 0;
    if (!pass)
        return score;

    var letters = new Object();
    for (var i=0; i<pass.length; i++){
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass),
    }

    variationCount = 0;
    for (var check in variations){
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}