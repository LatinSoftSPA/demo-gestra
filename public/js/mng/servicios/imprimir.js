$(document).ready(function(){
	$('#btnImprimir').click(function(e){
		printJS({
			printable: 'printElement',
			honorColor: true,
			type: 'html',
			targetStyles: ['*'],
		});
	});
});