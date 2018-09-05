<?php
/* bootstap games application */
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Controller\BoardController;

$boardController = new BoardController();
$boardMatrix = $boardController->boardAction();

// @TODO Remove before push to webserver, temp for dev only!!!!
$tempDir = "../../robohabilis";

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 
        The above 3 meta tags *must* come first in the head; 
        any other head content must come *after* these tags 
    -->
	<title>Eight Queens</title>	

    <!-- Bootstrap (using robo install) and Style CSS -->
    <!--  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo $tempDir?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Robohabilis specific style -->
    <!--  <link href="../../carousel.css" rel="stylesheet"> -->
    <link href="<?php echo $tempDir?>/carousel.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- 
        load JavaScript resources and Puzzle class 
        initialize the gameboard JS resources
    -->
	<script type="text/javascript" src="js/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="js/Puzzle.js"></script>
	<script>
		const puzzleControls = new Puzzle();
		puzzleControls.initGame();
	</script>
	
	<!-- 
	   Define inline style for content that didnt exist on initial page load
	   mainly the gameboard is dynamically generated on each page load.
	   this saves having to append styles after the fact. 
	-->
	<style type="text/css">
        .tray { background-image: url("img/tray_sm.png") }
        .Atile { background-image: url("img/btile_sm.png") }
        .hearts { background-image: url("img/hearts.png"); background-size: 57px; }
        .spades { background-image: url("img/spades.png"); background-size: 57px; }
        .Btile { background-color: #eceaea }
        .clock { 
            padding-top:4px;
            width:140px;
            text-align:center;
            border:1pt solid grey; 
            border-radius:3px;
            background-color:#D3EBED 
         }
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

<!-- NAVBAR ==============================================//-->

	<div class="navbar-wrapper">
		<div class="container">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
				<div class="navbar-header">
					<button type="button" 
						class="navbar-toggle collapsed" 
						data-toggle="collapse" 
						data-target="#navbar" 
						aria-expanded="false" 
						aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">robohabilis</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="http://robohabilis.com">home</a></li>
						<li><a href="../../about/">about</a></li>
						<li><a href="../../contact/">contact</a></li>
					</ul>
				</div>
				</div>
			</nav>
		</div>
	</div>
	
<!-- Main Content Wrapper ================================//-->
	
	<div class="container wrapper">
	
		<!-- Mast Head -->
		<div class="row featurette">
			<div class="gameboard col-md-3"></div>
			<div class="gameboard col-md-8">
				<h3 style="padding-left:70px">
					<img src="img/clubs.png" alt="Clubs" height=25px>
					Solve the Eight Queens Puzzle
					<img src="img/diamonds.png" alt="Diamonds" height=25px>
				</h3>
				<p>Place each Queen on gameboard so they are not captured by another Queen.<br>
				A Queen moves in all directions including diagonal to capture her enemies.
				</p>
			</div>
			<div class="gameboard col-md-1"></div>
		</div>
		
		<!-- Gameboard -->
		<div class="row featurette">
			<div class="gameboard col-md-3 timer-box">
				<div class="timer_btn">
					<h2 id="timer" class="clock"><time>00:00:00</time></h2>
					<button id="start">start</button>
					<button id="stop">stop</button>
					<button id="clear">clear</button>
				</div>
			</div>
			<div class="gameboard col-md-8">
				<?php include 'module/EightQueens/view/gameboard/board.php'?>
			</div>
			
			<div id="result"><span class="message"></span></div>
			<div class="gameboard col-md-1"></div>
		</div>
		
		<!-- Button Controls -->
		<div class="row featurette">
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-8">
				<div class="stats">
					<button class="btn_submit box" type="submit" id="submit">&nbsp;</button>
					<div class="hearts box"><span id="tt" class="snum">0</span></div>
					<div class="spades box"><span id="ss" class="snum" style="color:#ffffff">0</span></div>
					<button class="btn_tryagain box" type="reset" id="reset">&nbsp;</button>
				</div>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
		
	  	<!-- footer elements -->
		<footer>
        	<p>&copy; 2016 - <script>document.write(new Date().getFullYear())</script> 
        		robohabilis.com &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        		<div id="uuid", style="visibility:hidden">&nbsp;<div>
        	
        	</p>
  		</footer>
  	
  	<!-- 
		  Close Main Content Wrapper 
    --> 
  	</div>
  </body>
</html>

<!-- Inline JavaScript ===================================//-->
<!-- 
    Bootstrap JS, Instance Time object and handle AJAX Request/Response
-->
<script>
	const dragQueen = new Object();
	
	/* set up this users gameboard instance */
	function setupNewPuzzle()
	{
		if ( puzzleControls.UUID.length ) {
			var el = document.getElementById("uuid");
			el.setAttribute( "data-uuid", puzzleControls.getUuid() );
			
		}
		
	}
	
	
	/* 
	 * enable drap and drop functionality */
	function allowDrop(ev) {
		ev.preventDefault(); // limit to gameboard only
		
	}
	
	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	
	}
	
	function drop(ev) {
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		ev.target.appendChild(document.getElementById(data));
			
		// start timer first time drop is fired	
		if ( !dragQueen.hasOwnProperty('first') ) {
			$("#start").trigger("click"); // starts timer
			Object.defineProperty( dragQueen, 'first', {
				value: data,
				writable: false,
			});
		}
		
	}
</script>
<!--  <script type="text/javascript" src="../../dist/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo $tempDir?>/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Timer.js"></script>
<script>
  $(document).ready(function () {
	  
  	const solve = new Map();	// requires ES6
  	
  	/* stop timer on initial page load */
  	$("#stop").trigger("click");
  	$("#clear").trigger("click");
	
	/* 
	 * on submit, collect gameboard data and 
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
	 * * Also note order [ "queens", "spaces", "timestamp", "trial", "uuid" ]
	 */
	function getTableData() {
		var skeys = puzzleControls.gbDataKeys;
		var td 			= $('tbody tr').find('td');
		
		var queens 		= [];
		var spaces 		= [];	
		var timestamp	= puzzleControls.timestamp;
		var interval 	= $('h2#timer').text();
		var trial_count	= $('span#tt').text();
		var uuid		= $('div#uuid').data('uuid');
		
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
		solve.set( skeys[2], timestamp );	// initialized at...
		solve.set( skeys[3], interval );	// timer "00:01:30"
		solve.set( skeys[4], trial_count );	// num if trials "2"
		solve.set( skeys[5], uuid );		// UUID "4560b...aaf25"
	}
	
});
</script>