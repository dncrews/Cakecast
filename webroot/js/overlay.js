
var outerDiv = document.getElementById('overlay');
var innerDiv = document.getElementById('subscribeInformation');
var newX = document.getElementById('x');

function openUp() {
    outerDiv.style.display = 'block';
    return false;
}

function closeUp() {
    outerDiv.style.display = 'none';
}

function dontClose(event) {

	if (!event) var event = window.event;
	event.cancelBubble = true;

    if (event.stopPropagation)
        event.stopPropagation();
}

    var e = (!window.innerHeight) ? outerDiv.attachEvent('onclick', closeUp) : outerDiv.addEventListener('click', closeUp, false);
    var f = (!window.innerHeight) ? innerDiv.attachEvent('onclick', dontClose) : innerDiv.addEventListener('click', dontClose, false);
    var g = (!window.innerHeight) ? newX.attachEvent('onclick', closeUp) : newX.addEventListener('click', closeUp, false);
    
    
