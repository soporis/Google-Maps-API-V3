<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
$(function(){
	var latlng = new google.maps.LatLng(
		<?php echo isset($this->data['Event']['lat']) ? $this->data['Event']['lat'] : '43.57317363820925'; ?>,
		<?php echo isset($this->data['Event']['lng']) ? $this->data['Event']['lng'] : '3.863909667968759'; ?>
	);
	var map = new google.maps.Map(document.getElementById('gmap'),{
		zoom : 8,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var marker = new google.maps.Marker({
		position : latlng,
		map : map,
		title : 'Bougez ce curseur',
		draggable : true
	});
	var geocoder = new google.maps.Geocoder();

	google.maps.event.addListener(marker,'drag',function(){
		setPosition(marker); 	
	});

	$('#EventAdresse').keypress(function(e){
		if(e.keyCode==13){
			var request = {
				address : $(this).val()
			}
			geocoder.geocode(request,function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					var pos = results[0].geometry.location; 
					map.setCenter(pos);
					marker.setPosition(pos);
					setPosition(marker); 
				}
			});
			return false;
		}
	});

});
	
function setPosition(marker){
	var pos = marker.getPosition();
	$('#EventLat').val(pos.lat());
	$('#EventLng').val(pos.lng()); 
}
</script>
<div class="events form">
<?php echo $this->Form->create('Event');?>
	<fieldset>
 		<legend><?php __('Admin Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('lat');
		echo $this->Form->input('lng');
		echo $this->Form->input('Adresse');
	?>
	<div id="gmap" style="width:100%; height:350px;"></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Event.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Event.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Events', true), array('action' => 'index'));?></li>
	</ul>
</div>