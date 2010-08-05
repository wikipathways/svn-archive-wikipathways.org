import com.adobe.serialization.json.JSON;

function getSpecies():void
{
	//Create the URLLOader instance
	var myLoader:URLLoader = new URLLoader()
		
	myLoader.load(new URLRequest(appRoot + "?action=species"))
		
	myLoader.addEventListener(Event.COMPLETE, function(event:Event):void{
		var loader:URLLoader = URLLoader(event.target);
		speciesList = JSON.decode(loader.data) as Array;
	});	
}	

	

	
