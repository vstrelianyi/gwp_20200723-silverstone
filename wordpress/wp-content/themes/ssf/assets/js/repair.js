(function(){
	const $btnRepair = document.querySelector( '[data-tile-id="1"]');
	$btnRepair.addEventListener( 'click', ( e )=>{
		console.log( e.target );
	} );
})();