<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
$(function(){
    var latlng = new google.maps.LatLng(43.57317363820925,3.863909667968759);
    var map = new google.maps.Map(document.getElementById('gmap'),{
            zoom : 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var positions = [];
    var iterator = 0; 
    <?php foreach($events as $e): $e = $e['Event']; ?>
    positions.push({
        idEvent : <?php echo $e['id']; ?>,
        lat : <?php echo $e['lat']; ?>,
        lng : <?php echo $e['lng']; ?>
    });
    <?php endforeach; ?>
    for(var i=0;i<positions.length;i++){
        setTimeout(addMarker,(i+1)*300);
    }
    
    
    function addMarker(){
        var marker = new google.maps.Marker({
            position : new google.maps.LatLng(positions[iterator].lat,positions[iterator].lng),
            map : map,
            draggable : false,
            animation : google.maps.Animation.DROP
        });
        var idEvent = positions[iterator].idEvent;
	google.maps.event.addListener(marker,'click',function(){
		$('.event').hide();
                $('.event'+idEvent).slideDown(); 
	});
        iterator++;
    }

});
</script>

<div id="gmap" style="width:940px; height:490px; margin:0 auto; "></div>
<?php foreach($events as $e): $e = $e['Event']; ?>
<div class="event event<?php echo $e['id']; ?>">
    <h1><?php echo $e['name']; ?></h1>
</div>
<?php endforeach; ?>