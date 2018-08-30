/**
 * Timer Prototype
 * @version 1.0.1
 * @since 20180829
 * Defines the timer functionality. Timer starts when a 
 * user drags the first queen on to the game board and stops
 * when the user submits their solution. The time interval 
 * is captured and stored with the solutions dataset.
 * 
 * Alternatively the user can start/stop/clear the timer also.
 * 
 * Refactored from Danial Hug JSFiddle
 * @url https://jsfiddle.net/Daniel_Hug/pvk6p/
 * 
 */
var h2 = document.getElementsByTagName('h2')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;

/**
 * add time function
 * calculates the hours:minutes:seconds starting from
 * the h2#timer text content.  If the content is not reset 
 * to zero, the next start/stop will continue calculating 
 * from the previous. Useful as a running clock.
 * 
 * @return void
 */
function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    // modifies the text content of the target element.
    h2.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + 
    	":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + 
    	":" + (seconds > 9 ? seconds : "0" + seconds);
    
    timer();
}

/**
 * constructor
 * instantitates a new instance of t
 */
function timer() {
    t = setTimeout(add, 1000);
}
timer();


/**
 * Start button binder 
 * click event either triggered automatically
 * or when a user clicks the button.
 * @return {object} t, an instance of the timer
 */
start.onclick = timer;


/**
 * Stop function called from button Stop 
 * button click. Clear out timer object.
 * @return void
 */
function stoptimer() {
	console.log("Timer stopped called.");
	clearTimeout(t);
}
stop.onclick = stoptimer;


/**
 * Clear button triggers function on click
 * Resets the text content of h2 to 00:00:00
 */
clear.onclick = function() {
	console.log("Timer clear called.");
    h2.textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}
