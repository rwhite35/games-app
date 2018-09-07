/**
 * Puzzle Class
 * An OO JavaScript class for managing EightQueens functionality
 * and Users Interface mememory requirements.
 * 
 * @version 1.0.2
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
		// convenient properties for quick UI access
		this.UUID = new String();
		this.CCOUNT = new Number();
		this.GAME = "EightQueens";
				
		// EightQueens object with default values
		this.EightQueensObj = {
				'uuid': null,
				'timestamp': new Date(),
				'trial_count': 0,
		}
		
		// Gameboard JSON schema for backend data
		this.gbDataKeys = [
				'queens',
				'spaces',
				'timestamp',
				'interval',
				'trial_count',
				'uuid'
			];
		
	}
	
	
	/**
	 * initialize the gameboard UI memory management
	 * starting with timestamp and UUID.
	 * 
	 * @return {void} sets values on global objects
	 */
	initGame()
	{
		console.log("initGame starting up." );
		
		let uuid = this.createNewUuid();
		let timestamp = new Date();
		let trial_count = 0;
		
		if ( window.localStorage.getItem( this.GAME ) === null ) {
			
			console.log( "New player! Creating new UUID and timestamp." );
			this.setLocalStore( uuid, timestamp, trial_count );
			
		} else {  // EightQueens obj already stored, check its freshness
			
			let freshness = this.checkUserIdFreshness( this.getUuid(),  this.getTimestamp() );
			
			if( freshness === false ) {
				
				console.log( "Previously stored UUID is older than 24 hours, replacing it!" );
				this.deleteEightQueens( this.GAME );
				this.setLocalStore( uuid, timestamp, trial_count )
				
			}
		}
		
	}
		
	
	/**
	 * setUuid
	 * setter method for setting UUID in localStorage
	 * 
	 * @return void, sets UUID property
	 */
	setLocalStore( newUuid, newTimestamp, newTrial_Count )
	{
		this.EightQueensObj.uuid = newUuid;
		this.EightQueensObj.timestamp = newTimestamp;
		this.EightQueensObj.trial_count = newTrial_Count;
		
		window.localStorage.setItem( this.GAME, JSON.stringify( this.EightQueensObj ) );
		
	}
	
	
	/**
	 * getEightQueens
	 * parse localStore JSON object
	 * @return {object} EightQueens object
	 */
	getEightQueens() {
		return JSON.parse( 
				window.localStorage.getItem( this.GAME ) 
			);
		
	}
	
	
	/**
	 * getUuid, 
	 * getter method for UUID
	 * this.UUID accessed from UI
	 * 
	 * @return {string} EightQueens.uuid 
	 */
	getUuid() 
	{ 
		let LSEQ = this.getEightQueens();
		this.UUID = LSEQ.uuid;
		return this.UUID; 
	
	}
	
	
	/**
	 * getTimestamp
	 * getter method for Timestamp
	 * 
	 * @return {string} EightQueens.timestamp
	 */
	getTimestamp()
	{
		let LSEQ = this.getEightQueens();
		return LSEQ.timestamp;
		
	}
	
	
	/**
	 * getTrialCount
	 * getter method for Trial Count
	 * this.CCOUNT accessed from UI
	 * 
	 * @return {int} EightQueens.trial_count
	 */
	getTrialCount()
	{
		let LSEQ = this.getEightQueens();
		this.CCOUNT = this.LSEQ.timestamp;
		return this.CCOUNT;
	}
	
	
	/**
	 * deleteEightQueens
	 * delete EightQueens from localStore on expired freshness
	 * or when the user closes the EightQueens tab.
	 * 
	 * @param {string} item, name of the items to remove from localStorage
	 * 
	 * @return {bool} true in either case.
	 */
	deleteEightQueens( item )
	{
		if( window.localStorage.hasOwnProperty( item ) ) {
			window.localStorage.removeItem( item );
		}
		
		return true;
	}
	
	
	/**
	 * Check if UUID was previously set and still valid.
	 * otherwise we need a new UUID. 
	 * 
	 * @return {boolean} true if UUID is less than 24 old
	 */
	checkUserIdFreshness( localStoreUuid, localStoreTimestamp ) 
	{
		var freshness = false;
		var lsTimeObj = new Date( localStoreTimestamp );
		var expiration = new Date();
		
		expiration.setDate(expiration.getDate() - 1);
		var timeDiff = lsTimeObj.getTime() - expiration.getTime();
		
		// a negative timeDiff would be older than 24 hours
		if ( timeDiff > 0 ) freshness = true;
			
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
	 * Concats a JSON string for posting to checkSolution endpoint.
	 * 
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
	clickCounter(cnt) 
	{
		// document.getElementById("tt").innerHTML = this.counter(1);
		let newCnt = this.counter(cnt);
		document.getElementById("tt").innerHTML = newCnt;
		
		
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