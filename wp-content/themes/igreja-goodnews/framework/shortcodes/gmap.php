<?php

function google_map( $atts ) {
	extract(shortcode_atts(array(
									'lat'   => '0', 
									'lon'    => '0',
									'id' => 'map',
									'z' => '1',
									'w' => '609',
									'h' => '400',
									'maptype' => 'ROADMAP',
									'address' => '',
									'kml' => '',
									'marker' => '',
									'markerimage' => '',
									'traffic' => 'no',
									'infowindow' => ''
											), $atts));
	// default atts
	$id = 'map'.$id ;
	$returnme = '
    <div id="'.$id.'" style="width:' . $w . 'px;height:' . $h . 'px;border:1px solid #dbdbdb;"></div><br>
    <script type="text/javascript">
		var latlng = new google.maps.LatLng(' . $lat . ', ' . $lon . ');
		var myOptions = {
			zoom: ' . $z . ',
			center: latlng,
			mapTypeId: google.maps.MapTypeId.' . $maptype . '
		};
		var ' . $id . ' = new google.maps.Map(document.getElementById("' . $id . '"),
		myOptions);
		';
		//kml
		if($kml!= '') 
		{
			//Wordpress converts "&" into "&#038;", so converting those back
			$thiskml = str_replace("&#038;","&",$kml);		
			$returnme .= '
			var kmllayer = new google.maps.KmlLayer(\'' . $thiskml . '\');
			kmllayer.setMap(' . $id . ');
			';
		}
		//traffic
		if($traffic == 'yes')
		{
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $id . ');
			';
		}
		//address
		if($address != '')
		{
			$returnme .= '
		    var geocoder_' . $id . ' = new google.maps.Geocoder();
			var address = \'' . $address . '\';
			geocoder_' . $id . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $id . '.setCenter(results[0].geometry.location);
					';
					if ($marker !='')
					{
						//add custom image
						if ($markerimage !='')
						{
							$returnme .= 'var image = "'. $markerimage .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . $id . ', 
							';
							if ($markerimage !='')
							{
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . $id . '.getCenter()
						});
						';

						//infowindow
						if($infowindow != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($infowindow);
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $id . ',marker);
							});
					';
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}
		//marker: show if address is not specified
		if ($marker != '' && $address == '')
		{
			//add custom image
			if ($amarkerimage !='')
			{
				$returnme .= 'var image = "'. $markerimage .'";';
			}
			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . $id . ', 
				';
				if ($markerimage !='')
				{
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . $id . '.getCenter()
			});
			';
			//infowindow
			if($infowindow != '') 
			{
				$returnme .= '
				var contentString = \'' . $infowindow . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $id . ',marker);
				});
				';
			}
		}
		$returnme .= '</script>';
		return <<<HTML
[raw]
	{$returnme}
[/raw]
HTML;
}
add_shortcode('map', 'google_map');
?>