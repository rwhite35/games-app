/**
 * Puzzle Class
 * An OO JavaScript class for managing EightQueens functionality.
 * This abstracts out elements (like UUID, buttons, etc) so 
 * it can be extended from other games with similar requirements.
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
		this.gbdataset = [
				'queens',
				'spaces',
				'time',
				'trial',
				'uuid'
			];
	}
	
	/**
	 * getUuid, 
	 * getter method for UUID
	 * @return {string} EightQueens, UUID 
	 */
	getUuid()
	{
		return this.UUID;
		
	}
	
	
	/**
	 * initial the gameboard timestamp for checking UUID freshness
	 * and other time aware functions.
	 */
	loadedOn()
	{
		console.log("The timer started on page load at " + this.timestamp );
		return this.timestamp;
	}
	
	
	/**
	 * Check if UUID was previously set and still valid.
	 * otherwise its a new user, create a UUID and return true.
	 * 
	 * @todo 20180829 will work with checkUuidFreshness
	 * 
	 * @return {boolean} true when already created
	 */
	checkUserId() 
	{
		var created = false;
		
		if( this.UUID == null ) {
			window.localStorage.setItem(
				'EightQueens',
				this.createNewUuid()
			);
			
			created = true;
		}
		
		// additional validation here.
		
		return created;
		
	}
	
	
	/**
	 * check UUID freshness, if stale, create a new one
	 * @todo 20180829 needs body defined with validation logic
	 */
	checkUuidFreshness(timestamp)
	{
		// stubbed for later development
		console.log( "The current date/timestamp is " + timestamp );
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
			
			var key = this.gbdataset[j];
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