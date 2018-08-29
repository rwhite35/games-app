<?php
/* bootstap games application */
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Module;
use EightQueens\Gameboard\Controller\BoardController;

$boardObj = new Module();
$configs = $boardObj->getConfig();
$routes = $configs['router']['routes'];

$boardController = new BoardController();
$boardMatrix = $boardController->boardAction();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Eight Queens</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery/dist/jquery.js"></script>
		<!-- instantiate Puzzle class -->
		<script type="text/javascript" src="js/Puzzle.js"></script>
		
		<script>
			const dragQueen = new Object();
			const puzzleControls = new Puzzle();
			
			function setupNewPuzzle()
			{
				// new instance of the timer
				if ( !puzzleControls.hasOwnProperty('timerstart') )
					Object.defineProperty( puzzleControls, 'timerstart', {
						value: puzzleControls.loadedOn(),
						writable: true,
					});
				
				// instance of UUID
				if ( puzzleControls.hasOwnProperty('uuid') ) {
					
				} else {
					puzzleControls.checkUserId()
					Object.defineProperty( puzzleControls, 'uuid', {
						value: puzzleControls.getUuid(),
						writable: false,
					} );	
				}
				
			}
			
			
			function allowDrop(ev) {
		    	ev.preventDefault();
		    	
			}

			function drag(ev) {
		    	ev.dataTransfer.setData("text", ev.target.id);
		    	
			}

			function drop(ev) {
		    	ev.preventDefault();
		    	var data = ev.dataTransfer.getData("text");
		    	ev.target.appendChild(document.getElementById(data));
		    	
		    	if ( !dragQueen.hasOwnProperty('first') ) {
		    		// start the timer
		    		$("#start").trigger("click");
		    		
		    		// set the first queen
		    		Object.defineProperty( dragQueen, 'first', {
		    			value: data,
		    			writable: false,
					});
		    	}
		    	
			}
			
		</script>
		
		<style type="text/css">
		  .tray { background-image: url("img/tray_sm.png") }
		  .Atile { background-image: url("img/btile_sm.png") }
		  .hearts { background-image: url("img/hearts.png"); background-size: 57px; }
		  .spades { background-image: url("img/spades.png"); background-size: 57px; }
		  .Btile { background-color: #eceaea }
		  #result { margin-left:10% }
		  .btn_submit { 
		      border:none;
		      width:80px;
		      height:80px;
		      background-image: url("img/Submit_Green_Btn.png"); 
		      background-size: 79px; 
		  }
		  .btn_tryagain { 
		      border:none;
		      width:80px;
		      height:80px;
		      background-image: url("img/Try_Again_Btn.png"); 
		      background-size: 79px; 
		  }
		</style>
		
	</head>
	<body onload="setupNewPuzzle()">
	
		<header>
			<div style="padding-left:30px">
				<h3><img src="img/clubs.png" alt="Clubs" height=25px>
				Solve the Eight Queens Puzzle
				<img src="img/diamonds.png" alt="Diamonds" height=25px></h3>
			</div>
			<p>Place each Queen on gameboard so they are not captured by another Queen.<br>
				A Queen moves in all directions including diagonal to capture her enemies.<br>
				
				<!--
				<span class="hint"><a href="#" id="4hint">Need A Hint?</a></span>
				<span style="visibility:hidden">Each row and column would only have one Queen.</span>
				-->
				
			</p>
		</header>
		
		<div class="container">
				<?php include 'module/EightQueens/view/gameboard/board.php'?>
		</div>
		
		<div id="result"><span class="message"></span></div>
		
		<footer>
			<div class="stats">
				<button class="btn_submit box" type="submit" id="submit">&nbsp;</button>
				<div class="hearts box"><span id="tt" class="snum">0</span></div>
				<div class="spades box"><span id="ss" class="snum" style="color:#ffffff">0</span></div>
				<button class="btn_tryagain box" type="reset" id="reset">&nbsp;</button>
			</div>
			<div>
				<h2 id="timer"><time>00:00:00</time></h2>
				<button id="start">start</button>
				<button id="stop">stop</button>
				<button id="clear">clear</button>
			</div>
		</footer>
	</body>
</html>
<!-- instantiate Timer class -->
<script type="text/javascript" src="js/Timer.js"></script>
<!-- process puzzle solution -->
<script>
  	$(document).ready(function () {
 	
  	/* stop timer on initial page load */
  	$("#stop").trigger("click");
  	$("#clear").trigger("click");
	
	/* ES6 Map (similar to Java) */
	const solve = new Map();
	
	// delegate click event
	$('#submit').on("click", function(event) {
		
		// stop Timer on submit click
		$("#stop").trigger("click");
		
		getTableData();
		clickCounter();
		
		var jsonStr = mapToJson(solve, solve.size);
		
		if( jsonStr.length > 0 ) {
			$.ajax({
				url: "checkSolution.php",
				method: "get",
				dataType: "json",
				data: {Trial:jsonStr},
				
				success: function(results) {
					alert(results.response.message);
					if( results.response.hasOwnProperty('captured') ) {
			    	  	appendHighlight(results.response.captured);
			    	  }
			    },
			    error: function() {
			        console.log('Cannot retrieve data.');
			    }
			});
			
		} else {
				console.log( "json had no length or was null" );
		}
	
	});
	
	
	/*
	 * getTableData
	 * eval each gameboard td for a queen and assign 
	 * the queens id and space id to the solve Map.
	 * @return void
	 */
	function getTableData() {
		var queens = [];
		var spaces = [];
		var trial = $('span#tt').text();
		var time = $('h2#timer').text();
		var td = $('tbody tr').find('td');
		var uuid = localStorage.getItem('EightQueens');
		
		td.each(function() {
			var hasImg = $('img',this).length > 0;
			if(hasImg) {
				queens.push( $('img',this).attr('id') );
				spaces.push( $(this).data('title') );
			}
		});
		
		// assign arrays to solve Map
		solve.set( 'queens', queens );
		solve.set( 'spaces', spaces );
		solve.set( 'time', time );
		solve.set( 'trial', trial );
		solve.set( 'uuid', uuid );
	}
	
	
	/*
	* mapToJson
	* convert Map object to JSON string
	* @return string
	*/
	function mapToJson(map, count) {
		var jstring = "[{";
		// var jstring = "";
		var i=1;
		
		map.forEach( (value, key) => {
			jstring += `"${key}":"${value}"`;
			
			if(i < count) jstring += ",";
			i++;
		});
		jstring += "}]";
		return jstring;
	}
	
	/*
	 * appendHighlight
	 * key:value pairs represents the captured "good Queen":"evil Queen".
	 * param captured = {"Q103":"Q107","Q107":"Q103","Q102":"Q106"}
	 */
	 function appendHighlight(captured) {
		for (var key in captured) {
		    if ( captured.hasOwnProperty(key) ) {
		         let goodQueen = $("div#" + key); // block scoped
		         let evilQueen = $("div#" + captured[key]); // block scoped
		         console.log( "Good Queen ID " + goodQueen.val() + 
		        		 ", Evil Queen ID " + evilQueen.val() );
		         
		         goodQueen.addClass('highlight');
		         evilQueen.addClass('highlight');
		    }
		}
	}
	
	
	/*
	 * increment trials by adding one for each try
	 */
	function clickCounter() {
		document.getElementById("tt").innerHTML = counter();
		
	}
	
	
	/*
	 * increment counter
	 */
	 var counter = ( function() {
		 var count = 0;
		 return function() { return count =+ 1; }
		 
	 })();
	
  });
 </script>