<?php
$rooms = [
    1 => ['capacity' => '50', 'amenities' => 'Projector, Whiteboard'],
    2 => ['capacity' => '30', 'amenities' => 'TV, Sound System'],
    3 => ['capacity' => '20', 'amenities' => 'Whiteboard']
];
?>

<select id="event-room" name="event-room">
    <option value="">-- Select a Room --</option>
    <?php foreach ($rooms as $id => $data): ?>
        <option value="<?= $id ?>"><?= "Room " . chr(64 + $id) ?></option>
    <?php endforeach; ?>
</select>

<p id="capacity">Room capacity will be displayed here</p>
<div id="amenities-checkboxes">
    <p>Amenities will be displayed here</p>
</div>

<script>
    const roomData = <?= json_encode($rooms) ?>;

    document.getElementById('event-room').addEventListener('change', function() {
        const roomId = this.value;
        const amenitiesList = document.getElementById('amenities-checkboxes');

        // Clear existing content
        amenitiesList.innerHTML = "";

        if (roomData[roomId]) {
            // Update capacity
            document.getElementById('capacity').textContent = `Capacity: ${roomData[roomId].capacity} people`;

            // Generate checkboxes for amenities
            const amenitiesArray = roomData[roomId].amenities.split(', ');
            amenitiesArray.forEach(amenity => {
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'amenities[]';
                checkbox.value = amenity;
                checkbox.id = `amenity-${amenity}`;

                const label = document.createElement('label');
                label.htmlFor = `amenity-${amenity}`;
                label.textContent = amenity;

                const container = document.createElement('div');
                container.appendChild(checkbox);
                container.appendChild(label);

                amenitiesList.appendChild(container);
            });
        } else {
            // Default message when no room is selected
            document.getElementById('capacity').textContent = 'Room capacity will be displayed here';
            amenitiesList.innerHTML = "<p>Amenities will be displayed here</p>";
        }
    });
</script>