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
		
		<script>
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
			}
			
		</script>
		
		<style type="text/css">
		  .tray { background-image: url("img/tray_sm.png") }
		  .Atile { background-image: url("img/btile_sm.png") }
		  .hearts { background-image: url("img/hearts.png"); background-size: 57px; }
		  .spades { background-image: url("img/spades.png"); background-size: 57px; }
		  .Btile { background-color: #eceaea }
		</style>
		
	</head>
	<body>
	
		<header>
			<div style="padding-left:30px">
				<h3><img src="img/clubs.png" alt="Clubs" height=25px>
				Solve the Eight Queens Puzzle
				<img src="img/diamonds.png" alt="Diamonds" height=25px></h3>
			</div>
			<p>Place each Queen on gameboard so they are not captured by another Queen.<br>
				A Queen moves in all directions including diagonal to capture her enemies.<br>
				<span class="hint"><a href="#" id="4hint">Need A Hint?</a></span>
				<span style="visibility:hidden">Each row and column would only have one Queen.</span>
			</p>
		</header>
		
		<div id="result"></div>
		
		<div class="container">
				<?php include 'module/EightQueens/view/gameboard/board.php'?>
		</div>
		
		<footer>
			<div class="stats">
				<div class="hearts box"><span class="snum">3</span></div>
				<div class="spades box"><span class="snum" style="color:#ffffff">1</span></div>
			</div>
			<button class="btn_submit" id="submit">Check Solution</button>&nbsp;&nbsp;
			<button class="btn_clear" id="clear">Try Again</button>
		</footer>
	</body>
</html>

<script>
  	$(document).ready(function () {
	
	/* ES6 Map (similar to Java) */
	const solve = new Map();
	
	// delegate click event
	$('#submit').on("click", function(event) {
		// event.preventDefault;
		getTableData();
		
		var jsonStr = mapToJson(solve, solve.size);
		console.log("board solution: " + jsonStr);
		
		if( jsonStr.length > 0 ) {
			$.ajax({
				url: "checkSolution.php",
				// url: "/solution",
				method: "get",
				dataType: "json",
				data: {Trial:jsonStr},
				
				success: function(results) {
			        var posts = JSON.parse(results);
			        console.log(results);
			        $.each(posts, function() {
			            $('#result').append( $('<option></option>').text(this.name).val(this.id) );
			        });
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
		var td = $('tbody tr').find('td');
		
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
	
  	});
 </script>