/**
 * Puzzle Class
 * An OO JavaScript class for managing EightQueens functionality
 * and Users Interface mememory requirements.
 * 
 * @version 1.0.1
 * @since 20180829
 * @property {prototype} gbdataset, defined Map keys for
 * * dataset payload both as request and response.
 * 
 * @property {object} timestamp, instance of Date object called on
 * * new page load.
 * 
 * @property {string} UUID, value of UUID
 */
class Puzzle
{
	
	constructor()
	{
		this.UUID = window.localStorage.getItem('EightQueens');
		this.timestamp = new Date();
		this.gbDataKeys = [
				'queens',
				'spaces',
				'timestamp',
				'interval',
				'trial_count',
				'uuid'
			];
		this.gbLocalStore = new Map();
		this.user = {};
	}
	
	
	/**
	 * initialize the gameboard UI memory management
	 * starting with timestamp and UUID.
	 */
	initGame()
	{
		console.log("initGame started at " + this.timestamp );
		
		if ( this.UUID === null ) {
			console.log( "initGame is creating a new user id." );
			let uuid = this.createNewUuid();
			this.setUuid( uuid );
			
		} else { // check the user for freshness
			console.log( "initGame UUID has value, testing for freshness." );
			let freshness = this.checkUserId( this.UUID, this.timestamp );
			
			if( freshness === true ) {
				console.log( "UUID is fresh, continuing on..." );
			
			} else {
				console.log( "UUID is stale, delete the old and " +
						"create a new one." );
			}
			
		}
		
		return this.timestamp;
	}
		
	
	/**
	 * setUuid
	 * setter method for setting UUID in localStorage
	 * 
	 * @return void, sets UUID property
	 */
	setUuid( newUuid )
	{
		Object.defineProperty( this.user, 'uuid', {
			value: newUuid,
			writable: false
		});
		
		Object.defineProperty( this.user, 'timestamp', {
			value: this.timestamp,
			writable: true
		});
		
		/* assign to gameboard Map and UUID 
		 * to localStorage for easy access */
		this.gbLocalStore.set('EightQueens', this.user);
		window.localStorage.setItem( 
				"EightQueens",
				newUuid
			);
		
		this.UUID = newUuid;
		
	}
	
	
	/**
	 * getUuid, 
	 * getter method for UUID
	 * @return {string} EightQueens, UUID 
	 */
	getUuid() { return this.UUID; }
	
	
	/**
	 * Check if UUID was previously set and still valid.
	 * otherwise we need a new UUID. 
	 * 
	 * @return {boolean} true if UUID is less than 24 old
	 */
	checkUserId( testUuid, uuidSetDate ) 
	{
		var freshness = false;
		var expiration = new Date();
		expiration.setDate(expiration.getDate() - 1);
		
		var timeDiff = uuidSetDate.getTime() - expiration.getTime();
		
		if (timeDiff <= 86400000 ) {
			console.log("checkUserId UUID is less than 24 hours old, return true!")
			freshness = true;
			
		} else {
			console.log( "checkUserId UUID is older than 24 hours, return false." );
			
		}
		
		return freshness;
		
	}
	
	
	/**
	 * Calculates an RFC4122 compliant UUID which is then stored 
	 * in localStorage and also passed to checkSolutions as 
	 * the JSON node 'uuid'.
	 * 
	 * @returns {string} uuidv4, exp 4560b106-879f-4873-b9d6-e9186b5aaf25 
	 */
	createNewUuid()
	{
		var str = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx";
		
		var uuidv4 = str.replace(/[xy]/g, function(c) {
			var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			  });
		
		return uuidv4;
		
	}
	
	
	/**
	 * Gameboard data defined in solve Map
	 * Note order of this.gbdataset, all instance rely on this order.
	 * 
	 * @param {obj reference} solveRef, use get() to assign gameboard data.
	 * @param {int} count, map size
	 * 
	 * @return {string} jstring, valid JSON string
	 */
	mapToJson( solveRef, count ) 
	{
		var i=1;
		var jstring = "[{";
		
		for ( var j=0; j<count; j++ ) {
			
			var key = this.gbDataKeys[j];
			var value = solveRef.get(key);
			var catstr = '"' + key + '":"' + value + '"';
			jstring += catstr;
			
			if(i < count) jstring += ',';
			i++;
			
		}

		jstring += "}]";
		
		return jstring;
		
	}
	
	
	/**
	 * appendHightlight class to captured queens
	 * iterates over the captured map and assigns the 
	 * "hightlight" style class to Queens who are captured.
	 * 
	 * @return void updates DOM elements
	 */
	appendHighlight( captured ) 
	{
		
		for (var key in captured) {
		    if ( captured.hasOwnProperty(key) ) {
		         let goodQueen = $("div#" + key);
		         let evilQueen = $("div#" + captured[key]);
		         goodQueen.addClass('highlight');
		         evilQueen.addClass('highlight');
		    }
		    
		}
		
	}
	
	
	/**
	 * Trial counter accessor function
	 * @return {object} current count trial (heart) count
	 */
	clickCounter() 
	{
		document.getElementById("tt").innerHTML = this.counter(1);
		
	}
	
	
	/**
	 * Trial counter increment
	 * @return {object} the new count 
	 */
	 counter(cur) 
	 {
		 var count = (cur.lenght) ? cur : 0;
		 return count =+ 1;
		 
	 }

}