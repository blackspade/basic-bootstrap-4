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