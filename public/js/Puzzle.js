/**
 * An OOJS class for managing EightQueens game setup
 * controls and request/response handling.
 */
class Puzzle
{
	
	constructor()
	{
		this.UUID = this.getUuid(); 	// default to null on initial load.
		this.timestamp = new Date();	// default to current data/time
	}
	
	/**
	 * if UUID was previously set and still valid, return false.
	 * otherwise its a new user, create a UUID and return true.
	 * 
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
		
		// if validation is required, add it here.
		
		return created;
		
	}
	
	
	/**
	 * check the freshness of the UUID
	 */
	checkUuidFreshness(timestamp)
	{
		console.log( "The current date/timestamp is " + timestamp );
	}
	
	
	/**
	 * RFC4122 compliant UUID 
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
	
	
	getUuid()
	{
		return window.localStorage.getItem('EightQueens');
		
	}
	
	
	loadedOn()
	{
		console.log("The timer started on page load at " + this.timestamp );
		return this.timestamp;
	}

}