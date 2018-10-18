<?php
/* bootstap games application */
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Controller\BoardController;

$boardController = new BoardController();
$boardMatrix = $boardController->boardAction();

$URL        = $_SERVER['HTTP_HOST'];
$server     = $_SERVER['SERVER_NAME'];
$tempDir    = ( $server == 'localhost' ) ? "../../robohabilis/" : "../../";

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
    <link href="<?php echo $tempDir?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Robohabilis specific style -->
    <link href="<?php echo $tempDir?>carousel.css" rel="stylesheet">
    
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
		if ( typeof puzzleControls == "undefined" ) {
			var puzzleControls = new Puzzle();
			puzzleControls.initGame();
		}
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
						<li class="active"><a href="http://<?php echo $URL?>">home</a></li>
						<li><a href="http://<?php echo $URL?>/about/">about</a></li>
						<li><a href="http://<?php echo $URL?>/contact/">contact</a></li>
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
				<p>Click & drag Queens onto the gameboard so that no Queen is captured.<br>
				Two Queens occuping the same row, column or diagonal are captured!
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
				<hr>
				<div>
					<p>&quot;Constraint Satisfaction&quot; problems feature conditions that must 
					be met in order to solve the problem.  Similar to Sudoku, Eight Queens 
					requires each Queen to be placed on the gameboard without infringing on 
					another Queens position.  When two Queens occupy the same row, column or diagonal
					the solution fails to meet the constraints.</p>
					<p><a href="http://<?php echo $URL?>/contact/">Request</a> an email link to 
					receive a free PDF about the programming challenges for this game and 
					how we solved them.</p>      
				</div>
			</div>
			<div id="board" class="gameboard col-md-8">
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
					<button class="btn_tryagain box" id="reset">&nbsp;</button>
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
	
	/* set this users gameboard UUID */
	function setupNewPuzzle()
	{
		if ( puzzleControls.UUID != null ) {
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
<script type="text/javascript" src="<?php echo $tempDir?>dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Timer.js"></script>
<script>
  $(document).ready(function () {
	  
	/* stores gameboard data */
	const solve = new Map();
  	
  	/* stop timer on initial page load */
  	$("#stop").trigger("click");
  	$("#clear").trigger("click");
  	
  	/* set trial count on page load */
	document.getElementById("tt").innerHTML = puzzleControls.getTrialCount();
	document.getElementById("ss").innerHTML = puzzleControls.getSolveCount();
	
	/* 
	 * ON SUBMIT, 
	 * collect data and pass JSON to checkSolution endpoint */
	$('#submit').on("click", function(event) {
		
		/* stop the timer */
		$("#stop").trigger("click");
		
		/* increment trial count on submit */
		puzzleControls.incrementCounter( 
				$('span#tt').text(),
				$('span#ss').text(),
				"trial"
			);
		
		/* update solve object with new gameboard data */
		getTableData();
		
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
						
			    	} else {	// success! increment solve
			    		puzzleControls.incrementCounter( 
			    				$('span#tt').text(),
			    				$('span#ss').text(),
			    				"solve"
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
	 * ON RESET
	 * reload the gameboard and UI data */
	 $("#reset").on("click", function(event) {
		 
		 $("#clear").trigger("click");
		 location.reload(true);
		 
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
		var timestamp	= puzzleControls.getTimestamp();
		let interval 	= $('h2#timer').text();
		let trial_count	= $('span#tt').text();
		let solve_count = $('span#ss').text();
		let uuid		= $('div#uuid').data('uuid');
		
		td.each(function() {
			let hasImg = $('img',this).length > 0;
			if(hasImg) {
				queens.push( $('img',this).attr('id') );
				spaces.push( $(this).data('title') );
			}
		});
		
		/* assign values to solve Map 
		 * for checking solution, note the order */
		solve.set( skeys[0], queens );		// queens ids "Q101,Q102,..Q108"
		solve.set( skeys[1], spaces );		// occupied spaces "A,J...BE"
		solve.set( skeys[2], timestamp );	// initialized at...
		solve.set( skeys[3], interval );	// timer "00:01:30"
		solve.set( skeys[4], trial_count );	// num of trials submitted (in this session)
		solve.set( skeys[5], solve_count ); // num of succuessful solutions
		solve.set( skeys[6], uuid );		// UUID "4560b...aaf25"
		
	}
	
});
</script>