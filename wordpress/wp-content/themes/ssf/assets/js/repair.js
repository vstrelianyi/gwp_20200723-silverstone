(function(){
	const $btnRepair = document.querySelector( '[data-tile-id="3"] button');
	const $modal = document.querySelector( '#modal-id-1' );
	const $btn_modalClose = document.querySelector( '.modal-close' );
	// console.log( $modal );
	$btnRepair.addEventListener( 'click', ( e )=>{
		$modal.classList.add( 'active' );
		// console.log( e.target );
	} );
	$btn_modalClose.addEventListener( 'click', ( e )=>{
		const $targetModalId = e.target.getAttribute( 'data-target-modal-id' );
		document.querySelector( `#modal-id-${ $targetModalId }` ).classList.remove( 'active' );
		// console.log( targetModal );
		// $modal.classList.add( 'active' );
		// console.log( e.target );
	} );
})();