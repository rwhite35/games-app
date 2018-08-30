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
				/* set a new timestamp */
				if ( !puzzleControls.hasOwnProperty('timerstart') )
					Object.defineProperty( puzzleControls, 'timerstart', {
						value: puzzleControls.loadedOn(),
						writable: true,
					});
				
				/* handle UUID */
				if ( puzzleControls.hasOwnProperty('uuid') ) {
					
					// stubbed for freshness check and validation
					
				} else { // new player, set UUID
					puzzleControls.checkUserId()
					Object.defineProperty( puzzleControls, 'uuid', {
						value: puzzleControls.getUuid(),
						writable: false,
					} );	
				}	
			}
			
			/* enable drap and drop functionality */
			function allowDrop(ev) {
		    	ev.preventDefault();
		    	
			}

			function drag(ev) {
		    	ev.dataTransfer.setData("text", ev.target.id);
		    	
			}
			
			/* starts timer on first queen dropped */
			function drop(ev) {
		    	ev.preventDefault();
		    	var data = ev.dataTransfer.getData("text");
		    	ev.target.appendChild(document.getElementById(data));
		    	
		    	if ( !dragQueen.hasOwnProperty('first') ) {
		    		$("#start").trigger("click"); // starts timer
		    		
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
<!-- 
    instantiate Timer object 
-->
<script type="text/javascript" src="js/Timer.js"></script>

<!-- 
    process puzzle solution 
-->
<script>
$(document).ready(function () {
 	
  	const solve = new Map();	// requires ES6
  	
  	/* stop timer on initial page load */
  	$("#stop").trigger("click");
  	$("#clear").trigger("click");
	
	/* on submit, collect gameboard data and 
	 * pass JSON to checkSolution endpoint */
	$('#submit').on("click", function(event) {
		
		/* stop Timer on submit */
		$("#stop").trigger("click");
		
		getTableData();
		puzzleControls.clickCounter();
		
		var jsonStr = puzzleControls.mapToJson(solve, solve.size);
		
		if( jsonStr.length > 0 ) {
			$.ajax({
				url: "checkSolution.php",
				method: "get",
				dataType: "json",
				data: {Trial:jsonStr},
				
				success: function(results) {
					alert(results.response.message);
					
					if( results.response.hasOwnProperty('captured') ) {
						puzzleControls.appendHighlight(
			    	  			results.response.captured
			    	  		);
			    	  }
			    },
			    error: function() {
			        console.log('Cannot retrieve data.');
			        
			    }
			});
			
		} else {
			console.log( "Error: jsonStr had no length or was null!" );
			
		}
	
	});
	
	
	/*
	 * getTableData
	 * collect gameboard data for testing the submitted solution.
	 * uses puzzleControls.gbdataset prototype
	 * * which defines solve map key string. 
	 * * Also note order [ "queens", "spaces", "time", "trial", "uuid" ]
	 */
	function getTableData() {
		var queens = [];
		var spaces = [];
		var skeys = puzzleControls.gbdataset;
			
		var trial = $('span#tt').text();
		var time = $('h2#timer').text();
		var td = $('tbody tr').find('td');
		var uuid = window.localStorage.getItem('EightQueens');
		
		td.each(function() {
			var hasImg = $('img',this).length > 0;
			if(hasImg) {
				queens.push( $('img',this).attr('id') );
				spaces.push( $(this).data('title') );
			}
		});
		
		// assign arrays to solve Map, note the order
		solve.set( skeys[0], queens );		// queens ids "Q101,Q102,..Q108"
		solve.set( skeys[1], spaces );		// occupied spaces "A,J...BE"
		solve.set( skeys[2], time );		// timer "00:01:30"
		solve.set( skeys[3], trial );		// num if trials "2"
		solve.set( skeys[4], uuid );		// UUID "4560b...aaf25"
	}
	
});
</script>